# Changelog

All notable changes to the Horizon Sentinel project will be documented in this file.

## [Unreleased]

### Added - 2025-11-13

#### Supabase Integration
- Connected project to Supabase PostgreSQL database
- Configured dual connection setup:
  - Pooled connection (port 6543) for web requests
  - Direct connection (port 5432) for migrations
- Added connection configuration to `config/database.php`

#### Helper Scripts
- **start-dev.sh** - Starts complete development environment (server, queue, vite, logs)
- **migrate.sh** - Runs migrations using direct connection for reliability
- **artisan.sh** - Wrapper for artisan commands with clean environment

#### Documentation
- Consolidated documentation from 8 files to 3 essential files:
  - **README.md** - Main project documentation and quick start
  - **ROADMAP.md** - Development phases and progress tracking
  - **CLAUDE.md** - Technical documentation for AI assistant
- Removed duplicate files: QUICKSTART.md, QUICK_START.md, NEXT_STEPS.md, PROJECT_STATUS.md, README_HORIZON.md
- Updated .env.example with Supabase configuration template

#### Environment Configuration
- Resolved environment variable conflicts (system vars overriding .env)
- Added environment variable clearing to ~/.bashrc
- Configured cache and session to use database
- Set queue driver to database

### Changed - 2025-11-13
- Updated ROADMAP.md to reflect Supabase setup completion
- Enhanced Phase 1 & 2 completion status with detailed deliverables
- Improved README.md with comprehensive setup instructions
- Updated CLAUDE.md with Supabase connection documentation

### Fixed - 2025-11-13
- Fixed environment variable override issues preventing .env from loading
- Fixed Alpine.js missing dependency (pnpm install)
- Fixed database connection using system variables instead of .env values
- Generated missing APP_KEY

## [0.2.0] - 2025-11-13 (Phase 2 Complete)

### Added
- Laravel Breeze authentication system
- User registration and login functionality
- Password reset functionality
- Profile management pages
- Tailwind CSS 4 configuration
- Alpine.js integration
- Vite build system with hot reload

## [0.1.0] - 2025-11-07 (Phase 1 Complete)

### Added
- Laravel 12 framework installation
- Initial project structure
- Database configuration (initially SQLite)
- Basic migrations (users, cache, jobs tables)
- Development environment setup
- Composer and npm scripts

---

## Version History

- **0.2.0** - Authentication Complete
- **0.1.0** - Foundation Setup
- **Unreleased** - Supabase Integration & Workflow Optimization
