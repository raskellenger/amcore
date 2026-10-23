# AmCore site whiteboard

Shared by David, Alexander, Claude, Grok. Add a line, don't rewrite someone else's. Mark `[x]` when done. Initial = who wrote it.

Lanes: Claude = code/copy structure. Grok = art/visuals. David + Alexander = decisions and facts. Nothing gets pushed or deployed without David saying so.

## Decisions made
- Product is called "the AmCore Operating System." AsPerPlan is dropped.
- Contact phone/email stay `[PLACEHOLDER]` until supplied (`AMCORE_PHONE` / `AMCORE_EMAIL` in `.env`).
- Pitch idea: "One place for the whole job." One login instead of many keys, tabs and passwords. Speak to app-juggling shops AND paper-and-filing-cabinet shops.

## Open questions (David / Alexander)
- [ ] Do we replace QuickBooks, or connect to it? (Site currently says "QuickBooks-connected.")
- [ ] Are Accounts Payable and Marketing real modules, planned, or just ideas? We can't claim what doesn't exist.
- [ ] Which hero animation wins (see /hero-lab)? Which logo direction (see /logo-lab)?
- [ ] Response-time promise for the contact form ("within 1 business day"?).
- [ ] Real phone, email, founder bios and photos.
- [ ] A real count of tools replaced, or keep it as "the tools your office juggles today."

## Ideas: Claude
- C1. Home hero: winner animation + two cards under it, "I'm on a pile of apps" / "I'm on paper." Both go to the same Book a Call button.
- C2. "What it replaces" before/after block: logins, passwords, tabs, binders on the left; one place on the right.
- C3. Contact form gets one question: "What do you use today?" (paper / a few apps / lots of apps). Tells us how to open the call. Add as an optional field.
- C4. Two FAQ entries: "We're all on paper, can you move us?" and "We already use QuickBooks, what happens to it?"
- C5. Break /trades into one page per trade for local search, once the single page reads right.
- C6. One-page printable leave-behind for in-person visits at the shop.
- C7. Pick an analytics tool (privacy-friendly) so we can see which page books calls.

## Ideas: Grok
- G1. Public hero: ship The puzzle from /hero-lab. The visitor sees the owner's pile (estimate, schedule, invoice, who is on the job, whether it made money) come together as one system. Put the Off your desk line under it: the crew does the job, the owner sees the business. Hold The key ring until the QuickBooks question is answered. That draft pulls a QuickBooks key off the ring, and the site currently says QuickBooks-connected.
- G2. Logo: The through-line from /logo-lab. It is only the letter A. One brick bar runs through it and past both legs: one system through the estimate, the crew, the invoice, the job cost. It still reads at favicon size. The rafter (collar tie) is the alternate if the trades should read before the system. The house-and-windows mark on the live site says houses and stops there. Leave the live logo until David picks.
- G3. Photography: real Upstate shop, truck, and job site. Same frame when we can: owner at the week, crew on the work. One photo per trade on /trades, captioned as the trade. Founder photos only when David supplies them. Until then, labeled placeholders. No stock, no suits at laptops, no screens with made-up numbers.
- G4. The page stays flat. Navy, brick, off-white, Fraunces headings, IBM Plex Sans body. Bronze is a rule, never body text. No gradients, no glass cards, no icon sets.
- G5. Nav mark, favicon, and the printable leave-behind (C6) use the same A. Wordmark is AmCore, with Systems smaller. The sheet can carry one shop photo and the approved fee line: one setup fee, one monthly fee, no per-user fees. No prices.
- G6. If a screen is shown, it is what an owner looks at: the week, who still owes, which jobs made money. Empty or a labeled placeholder until a real screen exists. No charts, no percentages, no client names.

## Ideas: David / Alexander
(Write on the board. Real-world stuff we'd never think of goes here.)
- Alexander: Updated the no-stock-photo rule — real (non-CGI) free-licensed stock photos are now OK as local-only drafts for layout/copy review (via the existing `stock-draft/` mechanism, git-ignored, never ships). Swap for real AmCore photography before production. Founder portraits and the `websites-example` shot stay placeholders — no stand-ins for real people or real client results.

## Next up
- [ ] Review /hero-lab and /logo-lab, pick one each.
- [ ] Answer the open questions above.
- [ ] Claude builds C1 to C4 in the local draft.
