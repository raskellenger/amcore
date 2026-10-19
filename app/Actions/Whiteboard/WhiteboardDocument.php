<?php

declare(strict_types=1);

namespace App\Actions\Whiteboard;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;

final readonly class WhiteboardDocument
{
    private const string PLACEHOLDER = "(Write on the board. Real-world stuff we'd never think of goes here.)";

    /**
     * @var array<string, array{heading: string, label: string, style: string}>
     */
    private const array LANES = [
        'ideas' => [
            'heading' => 'Ideas: David / Alexander',
            'label' => 'your notes',
            'style' => 'david',
        ],
        'questions' => [
            'heading' => 'Open questions (David / Alexander)',
            'label' => 'open questions',
            'style' => 'check',
        ],
        'decisions' => [
            'heading' => 'Decisions made',
            'label' => 'decisions',
            'style' => 'plain',
        ],
        'next' => [
            'heading' => 'Next up',
            'label' => 'next up',
            'style' => 'check',
        ],
    ];

    private function __construct(private string $path) {}

    public static function fromConfig(): self
    {
        $path = config('amcore.whiteboard_path');

        if (! is_string($path) || $path === '') {
            throw new RuntimeException('Whiteboard path is not configured.');
        }

        return new self($path);
    }

    /**
     * @return array{
     *     intro: list<string>,
     *     sections: list<array{
     *         heading: string,
     *         items: list<array{kind: string, checked: bool|null, text: string, raw: string}>
     *     }>
     * }
     */
    public function read(): array
    {
        $this->guard();

        $lines = $this->lines($this->contents());
        $intro = [];
        $sections = [];
        $current = null;

        foreach ($lines as $line) {
            if (preg_match('/^## (.+)$/', $line, $matches) === 1) {
                if (is_array($current)) {
                    $sections[] = $current;
                }

                $current = ['heading' => $matches[1], 'items' => []];

                continue;
            }

            if (! is_array($current)) {
                $trimmed = trim($line);

                if ($trimmed !== '' && ! str_starts_with($trimmed, '#')) {
                    $intro[] = $trimmed;
                }

                continue;
            }

            if (trim($line) === '') {
                continue;
            }

            $current['items'][] = $this->item($line);
        }

        if (is_array($current)) {
            $sections[] = $current;
        }

        return ['intro' => $intro, 'sections' => $sections];
    }

    public function append(string $note, string $lane, string $author): string
    {
        $this->guard();

        $clean = $this->clean($note);
        $lane = $this->lane($lane);
        $prefix = $this->prefix($author);

        $label = $lane['label'];

        $this->change(function (array $lines) use ($clean, $lane, $prefix, &$label): array {
            $start = $this->headingIndex($lines, $lane['heading']);

            if ($start === null) {
                throw ValidationException::withMessages([
                    'lane' => 'That column is not on the board.',
                ]);
            }

            $end = $this->nextHeading($lines, $start);
            $body = [];

            for ($index = $start + 1; $index < $end; $index++) {
                if ($lane['style'] === 'david' && trim($lines[$index]) === self::PLACEHOLDER) {
                    continue;
                }

                $body[] = $lines[$index];
            }

            while ($body !== [] && trim($body[array_key_last($body)]) === '') {
                array_pop($body);
            }

            $bullet = $this->bullet($lane['style'], $prefix, $clean, $body);

            if (preg_match('/^- \[[ x]\] ([DA]\d+)\. /', $bullet, $matches) === 1) {
                $label = $matches[1];
            }

            $body[] = $bullet;

            return array_merge(
                array_slice($lines, 0, $start + 1),
                $body,
                [''],
                array_slice($lines, $end),
            );
        });

        return $label;
    }

    public function toggle(string $heading, string $rawLine): void
    {
        $this->guard();

        if (preg_match('/^- \[[ xX]\] /', $rawLine) !== 1) {
            throw ValidationException::withMessages([
                'board' => 'That line is not a checkbox on this board.',
            ]);
        }

        $this->change(function (array $lines) use ($heading, $rawLine): array {
            $start = $this->headingIndex($lines, $heading);

            if ($start === null) {
                throw ValidationException::withMessages([
                    'board' => 'That line is not a checkbox on this board.',
                ]);
            }

            $end = $this->nextHeading($lines, $start);

            for ($index = $start + 1; $index < $end; $index++) {
                if ($lines[$index] !== $rawLine) {
                    continue;
                }

                $lines[$index] = preg_replace_callback(
                    '/^- \[([ xX])\]/',
                    fn (array $matches): string => strtolower($matches[1]) === 'x' ? '- [ ]' : '- [x]',
                    $lines[$index],
                    1,
                ) ?? $lines[$index];

                return $lines;
            }

            throw ValidationException::withMessages([
                'board' => 'That line is not a checkbox on this board.',
            ]);
        });
    }

    private function guard(): void
    {
        abort_unless(app()->environment(['local', 'testing']), 404);
    }

    private function contents(): string
    {
        if (! is_file($this->path)) {
            throw new RuntimeException('Whiteboard file is missing.');
        }

        $contents = file_get_contents($this->path);

        if ($contents === false) {
            throw new RuntimeException('Could not read the whiteboard.');
        }

        return $contents;
    }

    /**
     * @param  callable(list<string>): list<string>  $rewrite
     */
    private function change(callable $rewrite): void
    {
        $handle = fopen($this->path, 'c+');

        if ($handle === false) {
            throw new RuntimeException('Could not open the whiteboard.');
        }

        try {
            if (! flock($handle, \LOCK_EX)) {
                throw new RuntimeException('Could not lock the whiteboard.');
            }

            $contents = stream_get_contents($handle);

            if ($contents === false) {
                throw new RuntimeException('Could not read the whiteboard.');
            }

            $newline = str_contains($contents, "\r\n") ? "\r\n" : "\n";
            $updated = $rewrite($this->lines($contents));
            $joined = implode($newline, $updated);

            if (! str_ends_with($joined, "\n")) {
                $joined .= $newline;
            }

            rewind($handle);
            ftruncate($handle, 0);
            fwrite($handle, $joined);
            fflush($handle);
        } finally {
            flock($handle, \LOCK_UN);
            fclose($handle);
        }
    }

    /**
     * @return list<string>
     */
    private function lines(string $contents): array
    {
        $lines = preg_split("/\r\n|\n|\r/", $contents);

        return $lines === false ? [] : $lines;
    }

    /**
     * @param  list<string>  $lines
     */
    private function headingIndex(array $lines, string $heading): ?int
    {
        foreach ($lines as $index => $line) {
            if ($line === '## '.$heading) {
                return $index;
            }
        }

        return null;
    }

    /**
     * @param  list<string>  $lines
     */
    private function nextHeading(array $lines, int $start): int
    {
        $count = count($lines);

        for ($index = $start + 1; $index < $count; $index++) {
            if (str_starts_with($lines[$index], '## ')) {
                return $index;
            }
        }

        return $count;
    }

    /**
     * @return array{kind: string, checked: bool|null, text: string, raw: string}
     */
    private function item(string $line): array
    {
        if (preg_match('/^- \[([ xX])\] (.+)$/', $line, $matches) === 1) {
            return [
                'kind' => 'check',
                'checked' => strtolower($matches[1]) === 'x',
                'text' => $matches[2],
                'raw' => $line,
            ];
        }

        if (preg_match('/^- (.+)$/', $line, $matches) === 1) {
            return [
                'kind' => 'note',
                'checked' => null,
                'text' => $matches[1],
                'raw' => $line,
            ];
        }

        return [
            'kind' => 'prose',
            'checked' => null,
            'text' => trim($line),
            'raw' => $line,
        ];
    }

    private function clean(string $note): string
    {
        $clean = Str::squish($note);
        $clean = preg_replace('/^(?:[-*]\s+)?(?:[DA]\d+\.\s+)?/u', '', $clean) ?? $clean;
        $clean = trim($clean);

        if ($clean === '' || str_starts_with($clean, '#')) {
            throw ValidationException::withMessages([
                'note' => 'Write a note before adding it to the board.',
            ]);
        }

        if (Str::length($clean) > 500) {
            throw ValidationException::withMessages([
                'note' => 'Keep a note to 500 characters.',
            ]);
        }

        return $clean;
    }

    /**
     * @return array{heading: string, label: string, style: string}
     */
    private function lane(string $lane): array
    {
        if (! isset(self::LANES[$lane])) {
            throw ValidationException::withMessages([
                'lane' => 'Pick a column on the board.',
            ]);
        }

        return self::LANES[$lane];
    }

    private function prefix(string $author): string
    {
        return match ($author) {
            'david' => 'D',
            'alexander' => 'A',
            default => throw ValidationException::withMessages([
                'author' => 'Pick David or Alexander.',
            ]),
        };
    }

    /**
     * @param  list<string>  $body
     */
    private function bullet(string $style, string $prefix, string $clean, array $body): string
    {
        if ($style !== 'david') {
            return $style === 'check' ? '- [ ] '.$clean : '- '.$clean;
        }

        $max = 0;

        foreach ($body as $line) {
            if (preg_match('/^- (?:\[[ xX]\] )?'.$prefix.'(\d+)\. /', $line, $matches) === 1) {
                $max = max($max, (int) $matches[1]);
            }
        }

        return '- [ ] '.$prefix.($max + 1).'. '.$clean;
    }
}
