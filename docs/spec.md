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
- `App\Mail\DiscoveryRequestReceived` — plain `Mailable` (deliberately **not** `ShouldQueue` — the Action above is the single queued unit; a queued Mailable on top of a queued Action double-hops and silently defers the actual send). Plain HTML view at `resources/views/mail/discovery-request-received.blade.php` — not the markdown `<x-mail::message>` component, whose `mail::` namespace didn't resolve reliably in an isolated `queue:work` process. Verified end-to-end locally (tinker dispatch → `queue:work` → real rendered email confirmed in `storage/logs/laravel.log` with `MAIL_MAILER=log`), not just via `Mail::fake()`.

Rate limiting is enforced **inside** `SubmitDiscoveryRequest::handle()` (5 attempts/minute per IP, via `RateLimiter::tooManyAttempts()`/`hit()`), not via route/`throttle:` middleware — Livewire component actions all funnel through the single `/livewire/update` endpoint regardless of which page they originate from, so route-level throttling on `/contact` would not actually cover form submissions. Throws `App\Exceptions\TooManyDiscoveryRequestsException` when exceeded. CSRF is Laravel's default; the honeypot check is covered above.

## Security headers & accessibility

`App\Http\Middleware\AddSecurityHeaders` (appended to the `web` group in `bootstrap/app.php`) sets `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy`. A CSP is not yet set (needs the real domain/asset hosts confirmed first — premature to lock down before launch).

All body-text color choices are contrast-checked against our actual brand colors (computed with the real WCAG relative-luminance formula, not eyeballed): `text-ink/50` and `text-ink/60` both fail the 4.5:1 AA minimum on our off-white background and must never be used — `tests/Feature/AccessibilityTest.php` enforces this as a regression test, along with banning `text-bronze` as a text color entirely (brand rule: bronze is rules/details only).

The mobile nav (below `lg`) is a real Alpine-driven hamburger menu, not a missing feature — the header previously had `hidden ... lg:flex` with no fallback at all. The honeypot field is a zero-size clipped box (`h-0 w-0 overflow-hidden`), not the more common `-left-[9999px]` offset technique, which risks horizontal page overflow with no clipping ancestor.

The contact form: every field's error message is linked to its input via `aria-describedby` + `aria-invalid="true"` (WCAG 1.3.1/3.3.1); the success and rate-limit banners carry `role="status"`/`role="alert"` so screen readers are notified without a focus change (WCAG 4.1.3); the 7 genuinely-required fields (everything but `company`) carry a native `required` attribute plus a visible `aria-hidden` asterisk.

## Tests

- `tests/Feature/Actions/SubmitDiscoveryRequestTest.php` — persistence, validation (missing fields, bad email, invalid trade), honeypot silent-drop, queued dispatch.
- `tests/Feature/Actions/SendDiscoveryRequestNotificationTest.php` — mail queued for the correct lead.
- `tests/Feature/MarketingPagesTest.php` — every route returns 200 and contains its expected title fragment.
- `tests/Feature/Pages/HomePageTest.php` — home page's hero, pain points, pillars, and modules all render.
- `tests/Feature/Pages/ContactPageTest.php` — full Volt component coverage via `Volt::test()`: successful submission, validation errors, honeypot silent-success, rate-limit message.
- `tests/Feature/LaunchReadinessTest.php` — 404 page, robots.txt, sitemap.xml, favicon/OG tags, structured data, security headers, no lead-exposing route exists.
- `tests/Feature/AccessibilityTest.php` — no page uses a sub-AA-contrast text class (contrast only).
- `RefreshDatabase` is enabled workspace-wide via `tests/Pest.php`.

Quality gate (must be clean before every commit): `composer rector-dry` → `composer rector` → `composer pint` → `composer stan` (Larastan, `--memory-limit=1G`) → `./vendor/bin/pest` → verify in browser.

## ⚠️ Pre-deploy trap: `TrustProxies`

No `TrustProxies` configuration exists (Laravel's default: trust no proxies). That's correct and safe for local dev. **It will silently break rate limiting in production**: `SubmitDiscoveryRequest` keys its rate limit on `request()->ip()`, and behind Laravel Cloud's load balancer, every visitor's request arrives at the app via the LB — without an explicit trusted-proxy configuration, `request()->ip()` returns the *load balancer's* IP for every single visitor, not the real client's. Concretely: the 6th legitimate visitor in a minute (from any IP) gets falsely rate-limited, because the app thinks all 6 came from the same address.

Before the first production deploy: configure `Illuminate\Http\Middleware\TrustProxies` (via `bootstrap/app.php`'s `withMiddleware(...)->trustProxies(...)`) to trust Laravel Cloud's actual proxy setup — check Cloud's own deploy docs for the specific configuration they document (this is a per-platform detail, deliberately not guessed at here). Add an end-to-end test post-deploy: two rapid-fire submissions from genuinely different source IPs should never both get rate-limited together.

## Known gaps / not yet built

- Case Studies real content — intentionally deferred until a client approves sharing their story.
- GitHub remote, domain, Sentry DSN, SES verified identity, Laravel Cloud — all placeholders, see `docs/reference.md`.
- Real photography to replace the generator-prompt placeholders (hero, trades strip, etc.) — no images are embedded on any page yet, only copy.
