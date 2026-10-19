# AmCore Systems — Reference

Quick-reference tables and the single consolidated placeholder list. Update this file whenever a placeholder gets resolved.

## Brand tokens

| Token | Value | Use |
|---|---|---|
| `--color-charcoal` | `#292929` | Primary (black, matches the logo wordmark) — headings, footer background |
| `--color-brick` | `#A6372F` | Accent (red, matches the logo) — CTAs, links on hover |
| `--color-cream` | `#F3ECDD` | Page background |
| `--color-ink` | near-black | Body text |
| Heading font | Fraunces | Self-hosted via bunny fonts (Vite) |
| Body font | IBM Plex Sans, 16px minimum | Self-hosted via bunny fonts (Vite) |

Defined in `resources/css/app.css` (`@theme` block) and mirrored in `CLAUDE.md`.

## Lead form option lists (source of truth: `App\Models\Lead` constants)

- **Trade:** Plumbing · HVAC · Electrical · Painting & Drywall · Roofing · Other
- **Crew size:** 1-4 · 5-14 · 15-49 · 50+
- **Preferred contact method:** Phone · Email · Text

## Consolidated placeholder list

| Placeholder | Where it shows up | Notes |
|---|---|---|
| Product name | Site-wide copy | **Decided:** "the AmCore Operating System." AsPerPlan is dropped. |
| Values statement | About page | Not yet provided. |
| Founder bios and photos | About page | Not yet provided — will never be AI-generated (real people). |
| Approved uptime % and critical response time | Operating Systems, FAQ | Claims rules forbid any number until approved. |
| Contact-form response-time commitment | Contact page success message | e.g. "within 1 business day" — needs a real number. |
| Phone number / email for click-to-call | Contact page | Not yet provided. |
| Domain name | Site-wide (canonical URLs, SES identity, structured data) | To be registered at Namesilo. |
| GitHub org/repo name | Infra | User confirmed: private repo, AmCore's own org, name TBD. |
| Favicon / OG image | Done (`public/images/brand/`) | Cropped from the real logo via `sips` (no vector source yet) — usable but not pixel-perfect. Revisit once the Logo Segments zip is accessible. |
| Hero / section photography | Home, About, Operating Systems, How We Work | Generator prompts delivered to user in chat; peopleless/faceless-enough by design. Real photos preferred when available. |
| Case studies content | Case Studies page | Page built, unlinked/unindexed until a client approves sharing their story. |
| Privacy Policy / Terms of Use | Legal pages | Plain-language drafts only — marked "DRAFT — attorney review required." |
| Analytics provider | Site-wide `<head>` | Wiring is done (`config('services.analytics.*')`, `ANALYTICS_SCRIPT_URL`/`ANALYTICS_DOMAIN` in `.env`) and inert until a provider is picked — no vendor chosen or invented. |
| SES sending domain verification | Production mail | AmCore's own verified identity, not a hub relay (this app is independent). |
| Sentry DSN | `config/sentry.php` / `.env` | Required before first production deploy. |
| Laravel Cloud account | Deploy | AmCore's own account. Hibernation OFF (public marketing site). Deploy only when explicitly asked. |
| UptimeRobot monitor | Post-launch | Add once the domain is live. |

## Brand assets received

- **Final logo (chosen 2026-10-12):** solid brick-red "A" with a white four-point star cut out, beside the AmCore wordmark (red "AM", charcoal "CORE"). Source: `resources/brand-source/amcore-logo-star-a-original.webp` (raster, 2464px). Transparent cutouts: `amcore-logo-final.png`, `amcore-mark-final.png`. In use: `public/images/brand/amcore-mark.png` + `amcore-wordmark.png` (nav and footer), favicons, and `og-image.png`, all cut from that raster. **Open item:** no vector (SVG) exists yet. Get a clean SVG before any print or truck use. Earlier shield-and-weave logo (`amcore-logo-final-original.webp`) and the navy house-and-windows files are superseded, kept for reference only.
- `resources/brand-source/amcore-logo-navy-transparent.png` — superseded old logo (navy wordmark, brick-red window, bronze rule), RGBA, in use in the nav/footer.
- `resources/brand-source/amcore-logo-navy-cream-bg.jpeg` — same design, flattened background, reference only.
- `resources/brand-source/amcore-mark-alt-wave-concept.jpeg`, `amcore-wordmark-alt-gray-concept.jpeg` — earlier/alternate concepts, not in use. Flag if either of these was actually meant to be final.
- Not yet accessible: `~/Documents/AmCore/Digital Assets/` (logo videos, "Logo Segments (Final).zip") — macOS blocked terminal read access; user is moving the folder into the repo.
