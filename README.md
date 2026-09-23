# 9.7 Practical — Run the pipeline both ways (DevConnect + DevCommand)

Local practice site `task-9.local` (Local by Flywheel), WordPress + ACF Pro, custom classic theme **vineyard**.
Every WordPress change was made through DevConnect abilities via the DevCommand plugin in Claude Code.

## Loom videos

1. https://www.loom.com/share/868b4f6c0de0464d9e2761e00ed98179
2. https://www.loom.com/share/d3121f27ec2a41a09321ae9d8fabedf1
3. https://www.loom.com/share/741a0a4a747649779ebce1f483cc632a

Covered: the pipeline running, an editor changing content in wp-admin, a global value updating in two places, and the rollback working.

## Written notes

**[notes/devconnect-exercise.md](notes/devconnect-exercise.md)** has everything in one file:

- ability notes and schemas (Part A)
- the HTML review (Part B)
- what went wrong in the conversion and how I fixed it
- the global settings proof (Part C)
- the safety drill evidence (Part D)

## Repository contents

| Path | What it is |
|---|---|
| `notes/devconnect-exercise.md` | The submission notes, Parts A to D. |
| `notes/part-b/vineyard-home.html` | The HTML generated from the Figma design, reviewed before the ACF conversion. |
| `notes/part-c/` | Before and after screenshots of one global colour changing Home and Our Story. |
| `notes/part-d/` | Safety drill evidence: before, broken, restored and pixel-diff screenshots, section JSON before and after, and the audit log extract. |
| `theme/vineyard/` | The theme: templates for the 7 Flexible Content layouts, Site Settings (header, footer, colours, typography), responsive CSS and icons. |
| `acf-json/` | ACF field group exports. **Page Sections** holds the Flexible Content with 7 layouts; **Site Settings** is the global options page. |
| `qa/home/` | The Figma reference and the built page at 1440px, plus the maint-qa intent and **PASS** verdict. |
| `qa/our-story/` | Both safety drill runs: intent files, **PASS** verdicts, and the restored page screenshot. |
| `project/` | The DevCommand `project-config.json` and design-system registries. |

## Flows

- **Flow A, Figma to an editable page:**
  1. Figma to reviewed HTML.
  2. HTML to ACF Flexible Content layouts, created with `dev/acf-manage-field-groups`.
  3. Templates pushed with `dev/update-theme-file`.
  4. Images imported with `dev/upload-media`.
  5. Content written with `dev/acf-read-write-values`.
  6. Text and images edited in wp-admin to prove the page is editable.
- **Flow B, global settings:** the header, footer, colours and typography come from one Site Settings options page and are output as CSS variables. Changing Primary updates every page.
- **Safety drill:**
  1. Wipe the sections with `dev/acf-read-write-values`.
  2. Find the automatic backup with `dev/list-backups`.
  3. Restore it with `dev/rollback-db`.
  4. Protect the page with `dev/protect-post`; the next write is refused with `403 dev_post_protected`.
  5. Check the audit log with `dev/get-audit-log`.

## Not included

- WordPress core, plugins (ACF Pro is licensed), uploads and the database.
- Credentials: no application passwords or tokens are committed.
