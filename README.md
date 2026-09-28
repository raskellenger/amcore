# AmCore Systems — Marketing Website

Marketing site for AmCore Systems LLC. See `docs/overview.md` for what this is, `docs/spec.md` for the technical spec, `docs/reference.md` for brand tokens and the placeholder list, and `CLAUDE.md` for the full standing engineering/content rules.

## Local setup

```bash
composer install
npm install
cp .env.example .env   # already done for local dev — .env is gitignored
php artisan key:generate
php artisan migrate
npm run build           # or `npm run dev` while actively editing styles
herd secure amcore       # trusted local SSL, only needed once
```

Visit `https://amcore.test`.

## Editing page copy

Each sitemap page is a Volt single-file component under `resources/views/livewire/pages/*.blade.php`. Edit the Blade markup directly — the `title()`/`layout()` calls at the top of each file set the page `<title>` and wire it to the shared layout at `resources/views/components/layouts/app.blade.php`.

After any Blade/CSS change:

```bash
npm run build
```

(or leave `npm run dev` running while you work — it hot-reloads).

Brand colors, fonts, and copy rules (banned words, claims rules, no invented facts) are documented in `CLAUDE.md` and `docs/reference.md` — read those before rewriting any page.

## Running the quality gate

Every change should pass this before committing:

```bash
composer rector-dry   # preview Rector's suggested changes
composer rector       # apply them
composer pint         # code style
composer stan         # Larastan static analysis
./vendor/bin/pest     # full test suite
```

## The one interactive feature

The contact form (`/contact`) saves a `Lead` and queues a notification email via `App\Actions\Leads\SubmitDiscoveryRequest`. It's honeypot-protected and rate-limited (5 submissions/minute per IP) at the Action level — see `docs/spec.md` for why that's implemented there instead of as route middleware.

## Deploying

**This app deploys only when explicitly asked to.** Laravel Cloud is not configured yet — deployment is a `[PLACEHOLDER]` step, tracked in the project plan (`~/.claude/plans/amcore-marketing-site.md`), gated on:

- A real domain (Namesilo) and DNS cutover
- A verified Amazon SES sending identity for AmCore's own domain (never `MAIL_MAILER=log` in production)
- A real Sentry DSN
- AmCore's own Laravel Cloud account, with hibernation **off** (this is a public marketing site, not a low-traffic internal tool)

Once those are in place: commit to `main` locally as usual, then `git push` — on Laravel Cloud, **push is a production deploy**, so only push when you actually mean to ship.
