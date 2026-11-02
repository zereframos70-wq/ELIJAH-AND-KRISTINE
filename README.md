# Portfolio Management

A Laravel application for managing projects displayed on the Ramos and Fabia portfolio sites. Authorized users can create, edit, and order projects, and choose whether each project appears on one or both portfolios.

## Requirements

- PHP 8.3 or later
- Composer
- Node.js and npm

## Setup

From the project directory, install dependencies, create the application key, migrate the SQLite database, and build the frontend:

```bash
composer run setup
```

The setup script creates `.env` from `.env.example` if needed. Before starting the app, edit `.env` and set unique values for `RAMOS_PORTFOLIO_PASSWORD` and `FABIA_PORTFOLIO_PASSWORD`. These are the credentials used by the two portfolio accounts. Keep `.env` private; it is excluded from version control.

## Run locally

Start the Laravel server, queue worker, and Vite development server together:

```bash
composer run dev
```

Open [http://localhost:8000](http://localhost:8000).

## Useful commands

```bash
# Run the test suite
php artisan test --compact

# Check frontend lint, formatting, and TypeScript
npm run lint:check
npm run format:check
npm run types:check

# Build production frontend assets
npm run build
```

## Tech stack

- Laravel 13 and PHP 8.3+
- React 19, TypeScript, and Inertia.js 3
- Vite 8 and Tailwind CSS 4
- SQLite by default
