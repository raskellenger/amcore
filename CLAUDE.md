# AmCore Systems LLC — Marketing Website

Laravel Boost's framework/package guidelines live in `AGENTS.md` (auto-generated, refresh with `php artisan boost:install` after major dependency changes). This file holds the project-specific rules Boost doesn't know about.

## What this app is

A marketing website for AmCore Systems LLC, a Greenville, SC company that builds business operating systems for local trades businesses (plumbing, HVAC, electrical, painting/drywall, roofing). Goal: book discovery calls. **Independent app — no hub, no login, no accounts, no multi-tenancy, no billing.** Not a satellite of anything.

## Engineering rules (RhynoDesigns standard, applied to this independent app)

- Strict TDD with Pest, functional style (`test()`/`it()`) — never class-based PHPUnit.
- Quality loop every task, in this order: failing test → implement → `composer rector-dry` → `composer rector` → `./vendor/bin/pint` → `PAO_DISABLE=1 ./vendor/bin/phpstan analyse` → verify in browser at `amcore.test` → commit → update plan/docs. Rector before Pint — order is load-bearing.
- Logic lives in `app/Actions/{Domain}/`, named VerbNoun (e.g. `SubmitDiscoveryRequest`). Sync `::run()`; queued work is `ShouldQueue` + `::dispatch()`. **No `app/Jobs/`, no service classes** unless a genuine multi-method external connector shows up.
- `declare(strict_types=1);` in every new file under Actions/Models/Http — never in Volt blades.
- Inject `LoggerInterface`; never use the `Log` facade.
- No numeric/public-facing IDs for anything a stranger could guess. The `Lead` model uses `HasUlids`. No route ever exposes a lead publicly (there isn't supposed to be one — leads are write-only from the contact form).
- Livewire + Volt (single-file components) + Flux UI (free tier — no license/`flux:activate`) + Tailwind v4. No SPA.
- Conventional commits. Branch `feat/[name]` for non-trivial work, merge to local `main`. **Never push unless explicitly asked** — this workspace's convention is push = production deploy on Laravel Cloud.
- Docs (`docs/*.md`) follow ASD-STE100 + Zinsser: short sentences, no unexplained jargon. Marketing copy on the site itself is exempt from this — it uses the trades voice described below.

## Mail, queues, error tracking

- Contact-form notification email is sent via a **queued Laravel Action**, using Amazon SES from **AmCore's own verified SES identity** — not a hub relay (this app has no hub). Production queue connection is Laravel Cloud's managed queue.
- **Never ship `MAIL_MAILER=log` to production.** Verify the real mailer before the first production deploy.
- Sentry is required before first production deploy. `config/sentry.php` is published; `SENTRY_LARAVEL_DSN` is a placeholder until a real Sentry project exists for AmCore.
- Save every contact-form submission to the database *before* attempting to send mail, so a mail failure never loses a lead.

## Security

- CSRF on all forms (Laravel default). Server-side validation on every field.
- Honeypot field + rate limiting on the contact form.
- Never collect or store SSNs, license numbers, or payment information.

## Content rules — never invent facts

Do not create testimonials, client logos, statistics, awards, certifications, team members, or case studies. Anything not supplied by the user is a visible `[PLACEHOLDER: description]`, consolidated in `docs/reference.md` (or wherever the current placeholder list lives).

### Voice
Plain, direct, confident, short sentences. Trade vocabulary (jobs, crews, work orders, T&M, callbacks, the shop, the truck). Banned words: SaaS, digital transformation, synergy, leverage, revolutionize, cutting-edge, seamless, game-changer, AI-powered.

### Claims rules (mandatory — see full list in the intake, summarized here)
May say: SOC 2 Type II attestation *of the hosting infrastructure* (never of AmCore itself), encrypted at rest/in transit/backups, WAF, daily off-site backups, crews only see assigned work, Face ID/fingerprint sign-in, an uptime commitment with bill credits, offline-and-syncs-later, "you own your data, export any time, we never sell or share it", no per-user fees.
Never say: "AmCore is SOC 2 compliant/certified", any compliance certification (HIPAA/ISO 27001/etc.), "bank-level"/"military-grade"/"unhackable", "99.99%" or "never goes down", that AmCore covers lost business, any specific uptime/response number that isn't an approved placeholder, vendor names as promises.

### Pricing
Never publish prices. Use: "One setup fee. One monthly fee. No per-user fees." Every pricing mention links to "Book a discovery call."

### Brand
Colors as Tailwind v4 theme tokens: charcoal `#292929` (primary), brick red `#A6372F` (accent), cream `#F3ECDD` (background), near-black text `#191A1C`. Three colors only: black, red, cream. No navy, no bronze. Headings: Fraunces (serif). Body: IBM Plex Sans, minimum 16px. No gradients, emoji, or glassmorphism. Real trades imagery only (labeled placeholders until real photos exist) — no stock photos of people in suits at laptops.

## Where things are

- Spec/overview/reference docs: `docs/spec.md`, `docs/overview.md`, `docs/reference.md`.
- Project plan: `~/.claude/plans/` (this workspace tracks plans as a single markdown file per plan — there is no `plans.db` on this machine yet, despite the RhynoDesigns playbook describing one).
- GitHub repo: pending — user confirmed private, under AmCore's own GitHub org, but the org/repo name is still a placeholder.
- Domain: pending purchase at Namesilo — placeholder.
- Laravel Cloud: deploy only when the user explicitly asks. Use AmCore's own Cloud account, hibernation OFF (public marketing site).
