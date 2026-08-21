# TaskPilot — Intentionally Vulnerable Laravel Lab

TaskPilot is a small full-stack project-management app built with Laravel 13, Blade, SQLite and plain CSS. It was created for a YouTube security review: **“AI built this website — then I hacked it.”**

> **Safety:** This application is intentionally insecure. Run it only on your own computer. The Docker configuration binds to `127.0.0.1`; do not change it to a public interface and never deploy this project.

## Fastest start (Docker)

Requirements: Docker Desktop with Compose.

```bash
docker compose up --build
```

Open <http://localhost:8000>. The database is reset and seeded whenever the container starts.

Demo member account:

```text
Email: reza@taskpilot.test
Password: Password123!
```

Demo admin account:

```text
Email: admin@taskpilot.test
Password: Admin123!
```

Stop it with:

```bash
docker compose down
```

## Run without Docker

Requires PHP 8.3+, Composer, PDO SQLite and SQLite.

```bash
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

No Node.js build is needed; the Blade UI uses a static stylesheet.

## What the app contains

- Registration and session authentication
- Dashboard and project creation
- Project search
- Notes and file attachments
- Profile editing
- Team administration screen
- Seeded users and private-looking—but entirely fake—data

For a blind review, stop reading here and audit the application yourself. After recording the discovery portion, open [`CREATOR_GUIDE.md`](CREATOR_GUIDE.md) for the challenge map, safe payloads and fixes.

## Reset the lab

Docker: restart the container. Local installation:

```bash
php artisan migrate:fresh --seed
```

## Scope

All names, passwords, tokens and business data are fictional. Test only this local lab. Nothing in this package authorizes testing any third-party system.
