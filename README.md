# Horizon Sentinel

**A Digital Leave Request and Conflict Avoidance System for Horizon Dynamics**

Built with Laravel 12, Tailwind CSS 4, and Supabase PostgreSQL.

---

## 📖 Overview

Horizon Sentinel is a modern leave management system that helps:
- **Employees** submit and track time-off requests
- **Managers** review requests and avoid staffing conflicts
- **Teams** maintain visibility into scheduled absences

**Current Status:** 🎉 **MVP COMPLETE** - All core features implemented and tested

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
php artisan test                             # Run test suite
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

### Phase 1 & 2: Foundation (COMPLETE ✅)
- ✅ Laravel 12 installed and configured
- ✅ Supabase PostgreSQL connected (pooled + direct connections)
- ✅ Laravel Breeze authentication (login, register, password reset)
- ✅ Tailwind CSS 4 with Vite
- ✅ Helper scripts for environment management
- ✅ Development workflow optimized

### Phase 3: Core Data Model (COMPLETE ✅)
- ✅ User roles (Employee/Manager) with RBAC
- ✅ Manager-employee relationships
- ✅ Leave request model and migrations
- ✅ Leave types (PTO, Sick, Vacation, Unpaid)
- ✅ Request history/audit trail
- ✅ Database seeders with test data

### Phase 4: Employee Interface (COMPLETE ✅)
- ✅ Submit new leave requests
- ✅ View all personal leave requests
- ✅ Cancel pending/approved requests
- ✅ View request details and history
- ✅ Form validation and error handling
- ✅ Authorization policies

### Phase 5: Manager Interface (COMPLETE ✅)
- ✅ Manager dashboard with statistics
- ✅ Pending requests review queue
- ✅ Approve/deny leave requests
- ✅ Team calendar view
- ✅ Conflict detection warnings
- ✅ Role-based access control

### Phase 6: Advanced Conflict Detection (COMPLETE ✅)
- ✅ ConflictDetectionService with severity levels
- ✅ Team availability percentage tracking
- ✅ Overlapping leave detection
- ✅ Sequential leave pattern detection
- ✅ Daily availability breakdowns
- ✅ Conflict summary dashboard widgets

### Phase 7: Testing & Polish (COMPLETE ✅)
- ✅ Comprehensive test suite (83 tests)
  - Feature tests for authentication
  - Feature tests for leave requests
  - Feature tests for manager actions
  - Unit tests for models
  - Unit tests for ConflictDetectionService
- ✅ Security audit (CSRF, XSS, SQL injection, authorization)
- ✅ Query optimization review (eager loading, N+1 prevention)
- ✅ Production-ready codebase

---

## 🌟 Key Features

### For Employees
- **Submit Leave Requests** - Request time off with notes and date ranges
- **Track Request Status** - View all requests (pending, approved, denied, cancelled)
- **Cancel Requests** - Cancel pending or approved requests anytime
- **View History** - See complete audit trail of all request actions

### For Managers
- **Review Dashboard** - See pending requests, team statistics, and availability
- **Approve/Deny Requests** - Review with optional notes and conflict warnings
- **Team Calendar** - Visual calendar showing all team leaves
- **Conflict Detection** - Automatic warnings about:
  - Overlapping team member leaves
  - Team availability falling below 30%
  - Sequential leave patterns
  - Severity levels (Critical, High, Medium, Low)
- **Team Availability Tracking** - Real-time percentage of available team members

### Security & Quality
- **Role-Based Access Control** - Employees and managers have appropriate permissions
- **Authorization Policies** - Users can only access their own data or their team's data
- **Input Validation** - All forms validated on client and server side
- **Audit Trail** - Complete history of all request changes
- **Responsive Design** - Works on desktop, tablet, and mobile
- **Dark Mode Support** - Full dark mode throughout the application

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
