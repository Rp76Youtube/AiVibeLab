# Creator Guide — spoilers

This file reveals every planted issue. Do not show it until the discovery section of the video is complete.

## Suggested filming flow

1. Present TaskPilot as a small app produced by an AI coding workflow.
2. Browse normally as the member account.
3. Inspect the application from the outside before opening the source.
4. Demonstrate each issue only against `http://localhost:8000`.
5. Explain the vulnerable code, impact, and corrected Laravel pattern.
6. End by separating “AI-generated” from “safe and reviewed.”

## Challenge map

### 1. Broken object-level authorization (IDOR)

- Location: `ProjectController::show`, `addNote`, and `upload`.
- Observation: route-model binding loads any project without checking its owner.
- Safe demo: sign in as Reza, open `/projects/2` or `/projects/3`, then compare with the projects visible on Reza's dashboard.
- Impact: another authenticated user can read private project details and may attach notes/files.
- Fix: add a `ProjectPolicy`, call `$this->authorize(...)`, and scope route binding to the authenticated owner where appropriate.

### 2. SQL injection in project search

- Location: `ProjectController::search`.
- Cause: user input is concatenated into a raw SQL string.
- Safe local payload: enter `' OR 1=1 -- ` in the project search field.
- Impact: the ownership condition can be bypassed and all projects returned.
- Fix: use Eloquent (`where('name', 'like', "%{$query}%")`) or parameter binding.

### 3. Stored XSS in project notes

- Location: note output in `resources/views/projects/show.blade.php`.
- Cause: `{!! $note->body !!}` renders stored HTML without escaping.
- Safe local payload: `<img src=x onerror="document.body.dataset.lab='xss';alert('TaskPilot local XSS')">`
- Impact: script executes for anyone viewing the project.
- Fix: render with `{{ $note->body }}`. If rich text is required, sanitize it with a proven allow-list sanitizer.

### 4. Mass-assignment privilege escalation

- Locations: `User` fillable attributes and `ProfileController::update`.
- Cause: the controller passes `$request->all()` and `role` is mass assignable.
- Safe demo: intercept the profile PATCH request and add `role=admin`, then reload the profile.
- Impact: a member can turn their own account into an administrator.
- Fix: update only validated fields (`$request->safe()->only(['name','bio'])`) and never make authorization attributes user-fillable.

### 5. Authorization bypass via query parameter

- Location: `ProfileController::team`.
- Safe demo: as a member, open `/team?preview_admin=1`.
- Impact: member records are exposed without the required role.
- Fix: remove the preview shortcut and protect the action with a Gate, Policy or role middleware.

### 6. Unrestricted upload to the public web root

- Location: `ProjectController::upload`.
- Cause: there is no extension/MIME allow-list and the original filename becomes part of a publicly served path.
- Safe demo: upload a harmless `.html` file containing a visible “local lab upload” message, then open its link.
- Impact: active content can be hosted under the trusted origin; configurations that execute uploaded scripts could make the impact worse.
- Fix: store outside `public`, generate a random filename, enforce allowed MIME types/extensions, and serve through an authorized download controller.

### 7. Configuration and secret disclosure

- Location: public `/api/status` route and `DashboardController::status`.
- Safe demo: open `/api/status` while logged out.
- Impact: environment details and a fake integration key are exposed.
- Fix: never return secrets or environment configuration; remove the endpoint or require strict authorization. Keep production debug mode disabled.

## Recommended reveal order

Use IDOR first because it is visual, SQL injection second, XSS third, privilege escalation fourth, then upload and configuration disclosure. This makes the video progress from simple URL manipulation to source-level review.

## Important wording for the video

- Say the target is an intentionally vulnerable local lab.
- Do not imply these payloads are permitted against public services.
- The presence of a bug is not proof that all AI-generated code is insecure; the lesson is that generated code still requires threat modeling, review and testing.
