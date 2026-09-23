Loom videos
1. https://www.loom.com/share/868b4f6c0de0464d9e2761e00ed98179
2. https://www.loom.com/share/d3121f27ec2a41a09321ae9d8fabedf1
3. https://www.loom.com/share/741a0a4a747649779ebce1f483cc632a



Part A — Learn the Tool
1. Discover abilities

DevConnect has 159 abilities.

The workflow is:

Discover → Inspect → Dispatch

Discover → see available abilities
Inspect → see an ability's input schema
Dispatch → run the ability
2. Five abilities
Ability	Why I need it
dev/get-site-context	Check WordPress version, theme and post types
dev/detect-page-builder	Check which builder a page uses
dev/convert-html	Convert HTML into a builder tree
dev/extract-content	Extract a page as a tree
dev/get-safety-status	Check the safety status before changes
3. Three inspected schemas
detect-page-builder → post_id required
extract-content → post_id required, builder optional
convert-html → html required, builder optional
4. Three read-only calls
Site context: WordPress 7.1.2, PHP 8.2, Twenty Twenty-Five
Builder detection: Sample Page uses Gutenberg and a block theme
Page tree: The page is represented as nested elements

Tree structure:
The tree contains elements in page order. Each element has an id, kind, type, settings, and children. children represents elements nested inside a parent.

Problems found
DevConnect 0.2.6 caused a WordPress admin crash because wp_rand() was called too early.
Empty {} parameters caused a dispatch error.
convert-html converts content inside <div>/<section> into raw HTML, making it less editable.



Part B — Figma to Editable Page
Result

Built the full Figma homepage (Home, post 25) with 7 ACF Flexible Content layouts:

Hero
Image + Text
Product Cards (repeater)
Cards Grid (repeater)
Image + List (repeater)
Features (repeater, icon select)
Newsletter

Matches the Figma at 1440px (sections within ~5–7px). Responsive with a mobile menu.
maint-qa verdict: PASS.


Process

Figma → HTML → ACF → WordPress

Used DevConnect for:

Theme files
ACF fields
Images
Page creation
Page content
Menus
HTML changes
Replaced absolute positioning with flexbox
Reduced unnecessary <div> elements
Added semantic HTML
Added mobile styling
Added alt text
Replaced commercial fonts
Made mixed text editable through separate fields
Problems and fixes
Figma access/limit → duplicated the file
write-file path problem → patched filesystem helper
PHP couldn't be written with write-file → used update-theme-file
No theme activation ability → activated manually
ACF fields weren't saving correctly → used add_field and update_field
Verification

Changed the heading and image from wp-admin.

Result: changes appeared on the live page.




Part C — Global Settings

Created a Site Settings screen for:

Logo
Header/footer
Colours
Typography
Menus

The theme uses CSS variables, so pages share the same settings.

Proof

Changed the primary colour:

#105742 → #7b1e3c

The change appeared on both Home and Our Story pages.

Then changed it back.

Problems
Options page didn't save → registered it in theme code
PHP error caused site downtime → fixed the PHP
DevConnect went down after a theme fatal error
PHP validation skipped → checked syntax locally before pushing
SVG upload blocked → converted logo to PNG




Part D — Safety Drill
1. Snapshot and rollback

Used Our Story page (ID 49).

Snapshot
   ↓
Break the page
   ↓
Rollback
   ↓
Verify

The page was restored successfully.

QA result: PASS

Re-run for the Loom: wiped field_vy_sections → dev/list-backups found
backup 1790172752-c8iTpWuW → dev/rollback-db restored 26 rows → QA PASS.

2. Protected page

Protected page 49.

Tried:

Update page
Delete page
Remove ACF content

All were rejected with:

403 dev_post_protected

The page remained unchanged.

3. Audit log

Checked the DevConnect audit log.

355 entries
Included successful, failed and refused DevConnect calls
Changes made outside DevConnect were not logged
Safety Issues Found
Site Settings changes are not backed up.
A PHP error can take DevConnect down with the site.
Audit logs don't show the actual written values, only a hash.
Final Result

The exercise demonstrated:

Discover → Inspect → Dispatch → Build → Verify → Protect → Rollback → Audit.