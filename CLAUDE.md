# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel Vue Starter Kit that combines Laravel 12 (PHP 8.2+) with Vue.js 3 + TypeScript, using Inertia.js for seamless SPA navigation. It features a comprehensive UI component system built with TailwindCSS 4 and Shadcn/ui components via Reka UI.

## Development Commands

### Starting Development Environment
- `composer dev` - Starts complete development environment (server, queue, logs, Vite HMR)
- `composer dev:ssr` - Development with Server-Side Rendering enabled
- `npm run dev` - Vite development server only

### Building for Production
- `npm run build` - Production build of frontend assets
- `npm run build:ssr` - SSR production build

### Testing
- `composer test` - Run Laravel/Pest tests (clears config first)
- `./vendor/bin/pest` - Run Pest tests directly

### Code Quality
- `vendor/bin/pint` - Laravel Pint code formatting (PHP)
- `npm run format` - Prettier formatting (TypeScript/Vue)
- `npm run format:check` - Check formatting without changes
- `npm run lint` - ESLint with auto-fix

## Architecture Overview

### Backend (Laravel)
- **Routes**: Organized in `routes/` with dedicated files (`auth.php`, `settings.php`, `web.php`)
- **Controllers**: Feature-based organization (`Auth/`, `Settings/`)
- **Models**: Standard Eloquent models in `app/Models/`
- **Middleware**: Custom Inertia handling and appearance management
- **Testing**: Pest framework with Feature and Unit tests

### Frontend (Vue.js + TypeScript)
- **Entry Points**: 
  - `resources/js/app.ts` - Main application
  - `resources/js/ssr.ts` - Server-side rendering
- **Pages**: Inertia.js pages in `resources/js/pages/` (mirrors Laravel routes)
- **Layouts**: Hierarchical system in `resources/js/layouts/`
  - `AppLayout.vue` - Base layout
  - `AppSidebarLayout.vue` - Main app with sidebar navigation
  - `AuthLayout.vue` - Authentication pages
- **Components**: Comprehensive UI library in `resources/js/components/ui/`
- **Composables**: Shared logic in `resources/js/composables/` (`useAppearance`, `useInitials`)

### Key Features
- **Authentication System**: Complete Laravel Breeze-style auth with email verification
- **Appearance Management**: Dark/light mode with system preference detection
- **Sidebar Navigation**: Professional layout with breadcrumb navigation
- **Type Safety**: Strict TypeScript configuration with global type definitions
- **SSR Support**: Built-in server-side rendering capability

## File Structure Conventions

### Laravel Conventions
- Controllers: Plural resource names (`PostsController`)
- Routes: kebab-case URLs (`/user-settings`), camelCase names (`userSettings`)
- Config: snake_case keys, kebab-case files

### Vue/TypeScript Conventions
- Components: PascalCase (`AppSidebar.vue`)
- Composables: camelCase with `use` prefix (`useAppearance.ts`)
- Types: Defined in `resources/js/types/`
- Pages: Mirror Laravel route structure

## Development Workflow

1. **Starting Development**: Use `composer dev` for full environment
2. **Code Changes**: 
   - Backend: Follow Laravel conventions, use Pest for testing
   - Frontend: TypeScript strict mode, use existing UI components
3. **Before Committing**:
   - Run `vendor/bin/pint` for PHP formatting
   - Run `npm run format` and `npm run lint` for frontend
   - Run `composer test` to ensure tests pass

## Testing Strategy

- **Backend**: Pest tests in `tests/Feature/` and `tests/Unit/`
- **Authentication**: Complete test coverage for auth flows
- **Settings**: User profile and password management tests
- **CI/CD**: GitHub Actions for tests and linting on `main`/`develop` branches

## Component System

The project uses a comprehensive UI component library based on Shadcn/ui patterns:
- **Base Components**: Button, Input, Card, Dialog, etc. in `resources/js/components/ui/`
- **App Components**: Custom components in `resources/js/components/`
- **Styling**: TailwindCSS 4 with custom utilities and animations
- **Icons**: Lucide Vue icons throughout the application

## Important Notes

- **Database**: SQLite for development (configured in `.env`)
- **SSR**: Optional but configured - use `composer dev:ssr` for SSR development
- **Ziggy**: Laravel routes available in JavaScript - regenerate with `php artisan ziggy:generate`
- **Vite Config**: Configured for Laravel integration with HMR and asset handling
- **TypeScript**: Strict mode enabled - maintain type safety across the application