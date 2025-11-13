# Horizon Sentinel

**A Digital Leave Request and Conflict Avoidance System for Horizon Dynamics**

Built with Laravel 12, Tailwind CSS 4, and Supabase PostgreSQL.

---

## 📖 Overview

Horizon Sentinel is a modern leave management system that helps:
- **Employees** submit and track time-off requests
- **Managers** review requests and avoid staffing conflicts
- **Teams** maintain visibility into scheduled absences

**Current Status:** Foundation Complete - Connected to Supabase - Ready for Feature Development

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & pnpm
- Supabase account (PostgreSQL database)

### Installation

1. **Clone and install dependencies:**
```bash
git clone <repository-url>
cd horizon-sentinel
composer install
pnpm install
```

2. **Configure environment:**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Update `.env` with your Supabase credentials:**
```env
DB_CONNECTION=pgsql
DB_HOST=aws-1-ap-southeast-2.pooler.supabase.com
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.YOUR_PROJECT_REF
DB_PASSWORD=your_password
```

4. **Run migrations:**
```bash
./migrate.sh
```

5. **Start development server:**
```bash
./start-dev.sh
```

Visit http://127.0.0.1:8000

---

## 🛠️ Development Commands

### Most Used Commands

#### View Your Website
```bash
./start-dev.sh
# Then open browser to: http://127.0.0.1:8000
# Press Ctrl+C to stop
```

#### Update Database Tables
```bash
./migrate.sh
```

#### Run Any Laravel Command
```bash
./artisan.sh [command]
```

### Common Examples
```bash
./artisan.sh make:model LeaveRequest -mfc    # Create model + migration + controller
./artisan.sh db:show                         # View database info
./artisan.sh tinker                          # Interactive shell
./migrate.sh --seed                          # Run migrations with test data
./vendor/bin/pint                            # Format code
```

### 📖 For Complete Command Reference

See **[COMMANDS.md](COMMANDS.md)** for:
- Detailed explanation of what each command does
- When to use each command
- Common troubleshooting solutions
- Quick reference guides

---

## 📚 Documentation

- **[COMMANDS.md](COMMANDS.md)** - Complete command reference with explanations
- **[ROADMAP.md](ROADMAP.md)** - Development phases and progress tracking
- **[CLAUDE.md](CLAUDE.md)** - Technical documentation and architecture
- **[CHANGELOG.md](CHANGELOG.md)** - Version history and changes
- **[docs/](docs/)** - Phase-specific implementation guides

---

## 🏗️ Tech Stack

- **Backend:** Laravel 12
- **Database:** PostgreSQL (Supabase)
- **Frontend:** Blade Templates, Tailwind CSS 4, Alpine.js
- **Build Tool:** Vite
- **Authentication:** Laravel Breeze

---

## ✅ What's Built

### Phase 1 & 2: Foundation (COMPLETE)
- ✅ Laravel 12 installed and configured
- ✅ Supabase PostgreSQL connected (pooled + direct connections)
- ✅ Laravel Breeze authentication (login, register, password reset)
- ✅ Tailwind CSS 4 with Vite
- ✅ Helper scripts for environment management
- ✅ Development workflow optimized

### Phase 3: Core Data Model (NEXT)
- User roles (Employee/Manager)
- Leave request model and migrations
- Leave types and validation

---

## 🗄️ Database Configuration

This project uses **Supabase PostgreSQL** with two connection types:

- **Pooled Connection (Default - Port 6543):** Used for web requests, optimal for production
- **Direct Connection (Port 5432):** Used for migrations, more reliable for schema changes

The helper scripts (`./start-dev.sh`, `./migrate.sh`, `./artisan.sh`) automatically handle environment variable conflicts and use the correct connection type.

---

## 📋 Project Structure

```
horizon-sentinel/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/
│   │   └── Controllers/ # Request handlers
│   └── ...
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Test data
├── resources/
│   ├── views/           # Blade templates
│   ├── css/             # Tailwind styles
│   └── js/              # Alpine.js & frontend
├── routes/
│   └── web.php          # Application routes
├── docs/
│   └── phases/          # Phase implementation guides
├── start-dev.sh         # Start development environment
├── migrate.sh           # Run migrations
└── artisan.sh           # Run artisan commands
```

---

## 🤝 Contributing

This is a private project for Horizon Dynamics. For development workflow:

1. Check [ROADMAP.md](ROADMAP.md) for current phase
2. Read phase-specific docs in `docs/phases/`
3. Follow the task list in `.cursor/.rules/process-task-list.md`
4. Use helper scripts for all operations

---

## 📄 License

Private - Horizon Dynamics Internal Project

---

## 🆘 Need Help?

### I want to...

**See my website in the browser**
- Run: `./start-dev.sh`
- Open: http://127.0.0.1:8000

**Learn what a command does**
- Read: [COMMANDS.md](COMMANDS.md) - Every command explained

**See the development plan**
- Check: [ROADMAP.md](ROADMAP.md) - What's done, what's next

**Understand the technical setup**
- Review: [CLAUDE.md](CLAUDE.md) - Architecture & configuration

**See what changed recently**
- View: [CHANGELOG.md](CHANGELOG.md) - Version history

**Fix a problem**
- Check: [COMMANDS.md](COMMANDS.md) → Troubleshooting section
