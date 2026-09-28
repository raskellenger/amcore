# AmCore Systems — Marketing Website: Overview

## What this is

A marketing website for AmCore Systems LLC, a Greenville, South Carolina company. AmCore builds and runs a business operating system for local trades businesses — plumbing, HVAC, electrical, painting and drywall, roofing. The site's one job: get an owner or office manager to book a discovery call.

AmCore also builds websites for trades businesses as a second, smaller service line.

## Who it's for

Owners and operators of trades businesses in the Upstate, typically 5-50 people, running today on paper work orders, spreadsheets, texts, email, and QuickBooks. A secondary audience is office managers who handle intake, scheduling, and billing.

## What this app is not

- Not a satellite of any hub. There is no login, no user account, no multi-tenancy, no billing inside this app.
- Not the AmCore operating system product itself — this is the site that sells it.
- Not connected to Preboarding, hub-sdk, or any other AmCore Systems internal tooling.

## The nine pages

1. **Home** — hero, pain points, five value pillars, eight module tiles, how-it-works timeline, "built by people from the trades" strip, websites cross-sell, final CTA.
2. **Operating Systems** — the eight modules in depth, offline/voice/QuickBooks callouts, what the monthly service includes.
3. **Websites** — the secondary website-building service, simple process, request-a-quote CTA.
4. **How We Work** — expanded delivery timeline, what AmCore needs from the client, training, ongoing support.
5. **About** — trades background, Greenville focus, values (placeholder), founder bios and photos (placeholder).
6. **FAQ** — 12 questions covering offline behavior, data ownership, business-continuity, security claims, pricing, scope, and trades served.
7. **Contact / Book a Discovery Call** — the one interactive feature on the site: a validated, honeypot-protected, rate-limited form (built, live) that saves a `Lead` and queues a notification email.
8. **Case Studies** — built, not linked or indexed, until a client approves sharing their story.
9. **Privacy Policy & Terms of Use** — plain-language drafts, marked "DRAFT — attorney review required."

## The one feature: discovery-call requests

A visitor fills out the contact form. The system:

1. Rejects spam via a honeypot field (silently — no error shown to the bot).
2. Validates every field server-side.
3. Saves the submission as a `Lead` **before** attempting to send any mail, so a mail failure never loses a lead.
4. Queues a notification email (Amazon SES, AmCore's own verified sending domain) to the discovery-request recipient.

No lead is ever exposed through a public URL. There is no way for a site visitor to view, edit, or list leads.

## Brand

Navy `#1F2A44`, brick red `#9B2C2C` (accent), bronze `#A07C3B` (rules/details only), warm off-white background, near-black text. Fraunces for headings, IBM Plex Sans for body (16px minimum). No gradients, emoji, or glassmorphism. Real trades imagery only — labeled placeholders until real photos exist.

## Where things live

- App: `~/Herd/amcore`, served at `https://amcore.test`.
- Copy draft and approval: see the published copy-review artifact (link in project history) and `docs/reference.md` for the placeholder list.
- Plan: `~/.claude/plans/` (see the AmCore plan file).
- Engineering standards and content rules: `CLAUDE.md` in the repo root.
