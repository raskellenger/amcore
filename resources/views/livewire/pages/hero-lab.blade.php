<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Hero Lab — AmCore Systems');

view()->share('description', 'Internal sandbox for hero animation ideas. Not linked, not indexed.');

?>

<div class="mx-auto max-w-5xl px-6 py-16">
    <h1 class="font-heading text-3xl font-medium text-cream">Hero lab</h1>
    <p class="mt-3 max-w-2xl text-lg text-cream/80">Four ways to show an owner who we are, and why the problem is theirs to stop carrying.</p>
    <p class="mt-6 font-heading text-3xl font-medium text-cream sm:text-4xl">Run the business, not the job.</p>
    <p class="mt-4 max-w-2xl text-lg text-cream/80">
        The crews do the work. You should be able to see the company. AmCore is that operating system, built in Greenville by people who did the trade and the paperwork.
    </p>
    <p class="mt-3 max-w-2xl text-slate">Internal only. Not linked. Not indexed. Click each one, then tell me which belongs on the home page.</p>

    <div class="mt-12 space-y-10">

        {{-- 1. Puzzle --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8"
            x-data="{
                solved: false,
                tiles: [
                    { mess: 'Napkin estimate', system: 'Estimates', r: -8, tx: -14, ty: 12 },
                    { mess: 'Who is on the job?', system: 'Work orders', r: 7, tx: 16, ty: -10 },
                    { mess: 'Invoice not sent', system: 'Invoicing', r: -6, tx: 10, ty: 14 },
                    { mess: 'Parts in a text', system: 'Inventory', r: 11, tx: -18, ty: -8 },
                    { mess: 'Whiteboard schedule', system: 'Scheduling', r: -12, tx: 8, ty: 12 },
                    { mess: 'Did it make money?', system: 'Job costing', r: 6, tx: -10, ty: -16 },
                ]
            }">
            <h2 class="font-heading text-2xl font-medium text-cream">1. The puzzle</h2>
            <p class="mt-2 max-w-2xl text-cream/80">The things only you are holding, loose on the bench. They lock into one system, and that system is how you run the company.</p>

            <div class="mt-5 overflow-hidden rounded bg-carbon p-4 sm:p-6">
                <div class="flex flex-wrap items-baseline justify-between gap-2">
                    <p class="font-heading text-lg font-medium text-cream" x-text="solved ? 'AmCore' : 'Loose pieces'">Loose pieces</p>
                    <p class="text-slate" x-text="solved ? 'One system. You run the business.' : 'Not a system yet.'">Not a system yet.</p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3"
                    :class="solved ? 'rounded border-2 border-steel bg-graphite p-2' : ''">
                    <template x-for="(t, i) in tiles" :key="t.system">
                        <div class="relative z-0 flex min-h-28 items-center justify-center rounded border border-brick/40 bg-graphite px-3 py-4 text-center text-base font-semibold leading-tight text-cream transition-all duration-700 ease-out motion-reduce:transition-none before:absolute before:left-1/2 before:top-0 before:size-4 before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full before:border before:border-brick/40 before:bg-graphite before:opacity-100 before:transition-opacity before:duration-300"
                            :class="solved ? '!z-10 !border-steel !bg-graphite !text-cream !shadow-none before:!opacity-0' : ''"
                            :style="`transform: rotate(${solved ? 0 : t.r}deg) translate(${solved ? 0 : t.tx}px, ${solved ? 0 : t.ty}px); transition-delay:${solved ? i * 50 : 0}ms`">
                            <span class="transition-opacity duration-300" :class="solved ? 'opacity-0' : 'opacity-100'" x-text="t.mess"></span>
                            <span class="absolute inset-0 flex items-center justify-center px-3 text-center transition-opacity duration-500" :class="solved ? 'opacity-100' : 'opacity-0'" x-text="t.system"></span>
                        </div>
                    </template>
                </div>
            </div>

            <p class="mt-4 text-cream/80" aria-live="polite" x-text="solved ? 'The pieces are AmCore. You run the business from here.' : 'Six things only you are holding.'">Six things only you are holding.</p>
            <button type="button" @click="solved = !solved"
                class="mt-4 rounded bg-brick px-5 py-3 text-base font-semibold text-cream hover:bg-brick/90"
                x-text="solved ? 'Start over' : 'Solve the problem'">Solve the problem</button>
        </section>

        {{-- 2. Key ring --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8"
            x-data="{
                dropping: false,
                keys: [
                    { n: 'QuickBooks', gone: false },
                    { n: 'Spreadsheet', gone: false },
                    { n: 'Texts', gone: false },
                    { n: 'Whiteboard', gone: false },
                    { n: 'Email', gone: false },
                ],
                get clear() { return this.keys.every(k => k.gone) },
                take(k) { this.dropping = false; k.gone = true },
                pull() { this.dropping = true; this.keys.forEach(k => k.gone = true) },
                reset() { this.dropping = false; this.keys.forEach(k => k.gone = false) }
            }">
            <h2 class="font-heading text-2xl font-medium text-cream">2. The key ring</h2>
            <p class="mt-2 max-w-2xl text-cream/80">A key for every place the business lives. Take the extras off. One login is how you run it, and we keep that system running for you.</p>

            <div class="relative mt-5 overflow-hidden rounded bg-carbon px-3 pb-6 pt-4 sm:h-[24rem] sm:px-6">
                <div class="pointer-events-none absolute left-1/2 top-5 hidden h-16 w-[40rem] max-w-[calc(100%-3rem)] -translate-x-1/2 rounded-[50%] border-[6px] border-steel sm:block" aria-hidden="true"></div>

                <div class="relative z-10 mx-auto flex w-full flex-wrap items-start justify-center gap-x-2 gap-y-6 pt-2 sm:w-[40rem] sm:max-w-full sm:flex-nowrap sm:justify-between sm:pt-9">
                    <template x-for="(k, i) in keys" :key="k.n">
                        <button type="button" @click="take(k)" :aria-label="'Take ' + k.n + ' off the ring'"
                            class="flex w-[46%] max-w-40 shrink-0 flex-col items-center opacity-100 transition-all duration-700 ease-in motion-reduce:transition-none sm:w-32"
                            :class="k.gone ? '!pointer-events-none !translate-y-[30rem] !rotate-6 !opacity-0 sm:!translate-y-64' : ''"
                            :style="(k.gone && dropping) ? `transition-delay:${i * 110}ms` : 'transition-delay:0ms'">
                            <span class="relative h-24 w-10" aria-hidden="true">
                                <span class="absolute left-1/2 top-0 size-9 -translate-x-1/2 rounded-full border-4 border-slate bg-carbon"></span>
                                <span class="absolute left-1/2 top-7 h-14 w-2 -translate-x-1/2 bg-slate"></span>
                                <span class="absolute left-1/2 top-[4.35rem] h-1.5 w-3.5 bg-slate"></span>
                                <span class="absolute left-1/2 top-[5rem] h-1.5 w-2.5 bg-slate"></span>
                            </span>
                            <span class="mt-1 text-center text-base font-semibold leading-tight text-cream" x-text="k.n"></span>
                        </button>
                    </template>
                </div>

                <div class="pointer-events-none absolute left-1/2 top-24 z-20 flex -translate-x-1/2 translate-y-8 flex-col items-center opacity-0 transition-all duration-700 motion-reduce:transition-none"
                    :class="clear ? '!translate-y-0 !opacity-100' : ''"
                    :style="clear ? 'transition-delay:480ms' : 'transition-delay:0ms'"
                    :aria-hidden="clear ? 'false' : 'true'">
                    <span class="relative h-28 w-12" aria-hidden="true">
                        <span class="absolute left-1/2 top-0 size-11 -translate-x-1/2 rounded-full border-4 border-brick bg-carbon"></span>
                        <span class="absolute left-1/2 top-8 h-16 w-2.5 -translate-x-1/2 bg-brick"></span>
                        <span class="absolute left-1/2 top-[5rem] h-2 w-4 bg-brick"></span>
                        <span class="absolute left-1/2 top-[5.7rem] h-2 w-3 bg-brick"></span>
                    </span>
                    <p class="mt-2 font-heading text-xl font-medium text-cream">AmCore</p>
                    <p class="text-center text-cream">One place to run the business.</p>
                </div>
            </div>

            <p class="mt-4 text-cream/80" aria-live="polite" x-text="clear ? 'One key left. You run the business from one place.' : 'Click a key to take it off, or pull them all.'">Click a key to take it off, or pull them all.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <button type="button" @click="pull()" x-show="!clear"
                    class="rounded bg-brick px-5 py-3 text-base font-semibold text-cream hover:bg-brick/90">Pull the extra keys</button>
                <button type="button" @click="reset()"
                    class="rounded border border-steel px-5 py-3 text-base font-semibold text-cream hover:border-brick">Start over</button>
            </div>
        </section>

        {{-- 3. Off your desk --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8" x-data="{ out: false }">
            <h2 class="font-heading text-2xl font-medium text-cream">3. Off your desk</h2>
            <p class="mt-2 max-w-2xl text-cream/80">Your desk is the job. Move that off it. What stays with you is running the company. The work does not disappear. It stops being the only thing you do.</p>

            <div class="mt-5 grid gap-4 rounded bg-carbon p-4 sm:grid-cols-2 sm:p-6">
                <div class="rounded border border-steel bg-graphite p-4">
                    <p class="font-heading text-lg font-medium text-cream" x-text="out ? 'You, running the business' : 'You, doing the job'">You, doing the job</p>
                    <div class="relative mt-4">
                        <ul class="space-y-2 opacity-100 transition-all duration-700 motion-reduce:transition-none" :class="out ? '!-translate-x-4 !opacity-0' : ''">
                            @foreach (['Drive the estimate', 'Pick up the part', 'Crawl the attic', 'Write the invoice', 'Answer the text'] as $job)
                                <li class="rounded border border-brick/40 px-3 py-2 text-signal">{{ $job }}</li>
                            @endforeach
                        </ul>
                        <ul class="absolute inset-x-0 top-0 translate-x-4 space-y-2 opacity-0 transition-all duration-700 motion-reduce:transition-none" :class="out ? '!translate-x-0 !opacity-100' : ''" :aria-hidden="out ? 'false' : 'true'">
                            @foreach (['Which jobs made money', 'Who still owes you', 'Who is out tomorrow', 'Whether to hire'] as $item)
                                <li class="rounded bg-graphite px-3 py-2 text-cream">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="rounded border border-slate bg-graphite p-4">
                    <p class="font-heading text-lg font-medium text-cream">Handled without you in the truck</p>
                    <p class="mt-4 text-cream/80" x-show="!out" x-cloak>Nothing. If you do not do it, it sits.</p>
                    <ul class="mt-4 space-y-2" x-show="out" x-cloak>
                        @foreach (['Drive the estimate', 'Pick up the part', 'Crawl the attic', 'Write the invoice', 'Answer the text'] as $job)
                            <li class="rounded border border-steel px-3 py-2 text-cream">{{ $job }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <p class="mt-4 text-cream/80" aria-live="polite" x-text="out ? 'The crew and the system take the job. You keep the decisions.' : 'If you stop, the job stops.'">If you stop, the job stops.</p>
            <button type="button" @click="out = !out"
                class="mt-4 rounded bg-brick px-5 py-3 text-base font-semibold text-cream hover:bg-brick/90"
                x-text="out ? 'Start over' : 'Get out of the job'">Get out of the job</button>
        </section>

        {{-- 4. Your week --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8" x-data="{ running: false }">
            <h2 class="font-heading text-2xl font-medium text-cream">4. Your week</h2>
            <p class="mt-2 max-w-2xl text-cream/80">Right now you are every day. Open the week and the work still happens. You are the one looking at the business, not the one doing all of it.</p>

            <div class="mt-5 grid grid-cols-2 gap-3 rounded bg-carbon p-4 sm:grid-cols-3 lg:grid-cols-5 sm:p-6">
                @foreach ([
                    ['Mon', 'Crews dispatched'],
                    ['Tue', 'Bills out today'],
                    ['Wed', 'Who paid'],
                    ['Thu', 'What the job cost'],
                    ['Fri', 'Your next call'],
                ] as [$day, $line])
                    <div class="flex h-56 flex-col overflow-hidden rounded border border-steel bg-graphite p-2">
                        <p class="text-center font-heading font-medium text-cream">{{ $day }}</p>
                        <div class="mt-2 flex min-h-0 flex-1 items-center justify-center rounded bg-brick px-2 text-center text-base font-semibold text-cream transition-all duration-700 ease-out motion-reduce:transition-none"
                            :class="running ? '!h-10 !flex-none shrink-0' : ''">
                            <span x-text="running ? 'You see it' : 'You do it'">You do it</span>
                        </div>
                        <div class="mt-0 flex h-0 min-h-0 flex-none items-center justify-center overflow-hidden rounded bg-graphite px-2 text-center text-base font-semibold text-cream opacity-0 transition-all duration-700 ease-out motion-reduce:transition-none"
                            :class="running ? '!mt-2 !h-auto !min-h-0 !flex-1 !opacity-100' : ''"
                            :aria-hidden="running ? 'false' : 'true'">
                            {{ $line }}
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="mt-4 text-cream/80" aria-live="polite" x-text="running ? 'The week runs. You see the business.' : 'Right now you do every day yourself.'">Right now you do every day yourself.</p>
            <button type="button" @click="running = !running"
                class="mt-4 rounded bg-brick px-5 py-3 text-base font-semibold text-cream hover:bg-brick/90"
                x-text="running ? 'Start over' : 'See the business'">See the business</button>
        </section>
    </div>

    <p class="mt-12 max-w-2xl text-slate">These stay off the home page until you pick one. The public hero is unchanged.</p>
</div>
