# AmCore Systems — Technical Spec

Generated from the live codebase as of the initial scaffold. Refresh this file (don't trust it blindly) whenever routes, models, or Actions change materially.

## Stack

- Laravel 13 (PHP 8.4), served locally via Laravel Herd at `https://amcore.test`.
- Livewire 4 + Volt (single-file components) + Flux UI (free tier) + Tailwind CSS v4.
- Pest 4 (functional `test()`/`it()` style), Pint, Rector (+ `driftingly/rector-laravel`), Larastan (`larastan/larastan`).
- `lorisleiva/laravel-actions` for all business logic — no `app/Jobs/`, no service classes.
- `sentry/sentry-laravel` (config published, DSN placeholder).
- `aws/aws-sdk-php` for Amazon SES transactional mail.
- Laravel Boost (`laravel/boost`) installed — see `AGENTS.md` for framework-level guidelines and `.claude/skills/` for Boost-synced skills (fluxui-development, laravel-best-practices, livewire-development, tailwindcss-development, testing-best-practices, volt-development, deploying-to-cloud, infer-conventions).

## Routes

All routes are `Volt::route()` full-page components, defined in `routes/web.php`:

| Route | Name | Component |
|---|---|---|
| `/` | `home` | `pages.home` |
| `/operating-systems` | `operating-systems` | `pages.operating-systems` |
| `/websites` | `websites` | `pages.websites` |
| `/how-we-work` | `how-we-work` | `pages.how-we-work` |
| `/about` | `about` | `pages.about` |
| `/faq` | `faq` | `pages.faq` |
| `/contact` | `contact` | `pages.contact` |
| `/case-studies` | `case-studies` | `pages.case-studies` |
| `/privacy` | `privacy` | `pages.privacy` |
| `/terms` | `terms` | `pages.terms` |

All nine sitemap pages render real, approved copy (`resources/views/livewire/pages/*.blade.php`) except `case-studies`, which is an intentional placeholder per the brief (unlinked, unindexed until a client approves sharing their story — `noindex, nofollow`, excluded from `/sitemap.xml` and disallowed in `/robots.txt`). Home uses headline option A ("Operating systems for the trades.") by default. No auth, no admin routes, no lead-listing routes exist or are planned.

`/robots.txt` and `/sitemap.xml` are plain closures in `routes/web.php` (not static `public/` files), so the host always matches `APP_URL` in every environment. `resources/views/errors/404.blade.php` is a branded 404 reusing the marketing layout.

## Layout

`resources/views/components/layouts/app.blade.php` — single marketing layout (nav, footer, Flux appearance/scripts). No secondary "app shell" layout exists; this is not a satellite and has no authenticated area.

## Data model

### `leads` table (`database/migrations/2026_09_28_195028_create_leads_table.php`)

ULID primary key. Columns: `name`, `company` (nullable), `trade`, `crew_size`, `phone`, `email`, `headache` (text), `preferred_contact_method`, timestamps.

`App\Models\Lead` (`app/Models/Lead.php`) uses `HasUlids`. Option lists live as model constants — the single source of truth for both validation and any future select inputs:

- `Lead::TRADES` — plumbing, hvac, electrical, painting_drywall, roofing, other
- `Lead::CREW_SIZES` — 1_4, 5_14, 15_49, 50_plus
- `Lead::CONTACT_METHODS` — phone, email, text

## Business logic (Actions)

- `App\Actions\Leads\SubmitDiscoveryRequest` — validates input (rules sourced from `Lead` constants), silently drops honeypot-flagged submissions (no persistence, no mail, no error), persists a `Lead`, dispatches the notification action. Injects `LoggerInterface` (never the `Log` facade).
- `App\Actions\Leads\SendDiscoveryRequestNotification` — `ShouldQueue` Action. Sends `App\Mail\DiscoveryRequestReceived` to `config('mail.discovery_request_recipient')` (env `MAIL_DISCOVERY_REQUEST_RECIPIENT`, placeholder default).
- `App\Mail\DiscoveryRequestReceived` — `ShouldQueue` Mailable, markdown view `resources/views/mail/discovery-request-received.blade.php`.

Rate limiting is enforced **inside** `SubmitDiscoveryRequest::handle()` (5 attempts/minute per IP, via `RateLimiter::tooManyAttempts()`/`hit()`), not via route/`throttle:` middleware — Livewire component actions all funnel through the single `/livewire/update` endpoint regardless of which page they originate from, so route-level throttling on `/contact` would not actually cover form submissions. Throws `App\Exceptions\TooManyDiscoveryRequestsException` when exceeded. CSRF is Laravel's default; the honeypot check is covered above.

## Tests

- `tests/Feature/Actions/SubmitDiscoveryRequestTest.php` — persistence, validation (missing fields, bad email, invalid trade), honeypot silent-drop, queued dispatch.
- `tests/Feature/Actions/SendDiscoveryRequestNotificationTest.php` — mail queued for the correct lead.
- `tests/Feature/MarketingPagesTest.php` — every route returns 200 and contains its expected title fragment.
- `tests/Feature/Pages/HomePageTest.php` — home page's hero, pain points, pillars, modules, and timeline all render.
- `tests/Feature/Pages/ContactPageTest.php` — full Volt component coverage via `Volt::test()`: successful submission, validation errors, honeypot silent-success, rate-limit message.
- `tests/Feature/LaunchReadinessTest.php` — 404 page, robots.txt, sitemap.xml, favicon/OG tags, structured data.
- `RefreshDatabase` is enabled workspace-wide via `tests/Pest.php`.

Quality gate (must be clean before every commit): `composer rector-dry` → `composer rector` → `composer pint` → `composer stan` (Larastan, `--memory-limit=1G`) → `./vendor/bin/pest` → verify in browser.

## Known gaps / not yet built

- Unique per-page meta descriptions (every page currently shares the layout's default description).
- Case Studies real content — intentionally deferred until a client approves sharing their story.
- GitHub remote, domain, Sentry DSN, SES verified identity, Laravel Cloud — all placeholders, see `docs/reference.md`.
- Real photography to replace the generator-prompt placeholders (hero, trades strip, etc.) — no images are embedded on any page yet, only copy.
