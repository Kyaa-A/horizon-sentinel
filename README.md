# Pahinga

**Personnel Absence & Holiday Integrated Notification Gateway Application**

*"Pahinga" (Filipino) - Rest, Break*

Built with Laravel 12, Livewire 3, Tailwind CSS 4, and PostgreSQL.

---

## Overview

Pahinga is a modern leave management system designed for organizations that need:
- **Employees** to submit and track time-off requests effortlessly
- **Managers** to review requests with conflict awareness before approving
- **HR Admins** to manage company-wide leave policies, balances, and holidays
- **Teams** to maintain visibility into scheduled absences

**Current Status:** Production Ready - All core features implemented and tested

---

## Features

### Employee Portal
- Submit leave requests (Vacation, Sick Leave, PTO, Unpaid Leave)
- Track request status with real-time notifications
- Cancel pending or approved requests
- View complete request history with audit trail
- See remaining leave balances

### Manager Dashboard
- Review pending requests with team calendar context
- Approve/deny with optional notes
- **Conflict Detection** with severity levels:
  - Overlapping team member leaves
  - Team availability warnings (< 30%)
  - Sequential leave pattern detection
- Team availability calendar
- Manager delegation for temporary absence

### HR Admin Console
- User management (create, edit, assign roles/managers)
- Leave balance management and adjustments
- Company holiday configuration
- Company-wide reports with yearly trends
- Leave type distribution analytics
- Department breakdown statistics

### System Features
- **Role-Based Access Control** - Employee, Manager, HR Admin
- **Dark Mode** - Full dark mode support throughout
- **Toast Notifications** - Real-time feedback with auto-dismiss
- **PHP Enums** - Type-safe leave types, statuses, and roles
- **Livewire 3** - Dynamic components for seamless UX
- **Responsive Design** - Mobile-friendly interface

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 12 (PHP 8.2+) |
| Database | PostgreSQL (Supabase) |
| Frontend | Blade, Livewire 3, Alpine.js |
| Styling | Tailwind CSS 4 |
| Build | Vite |
| Auth | Laravel Breeze |

---

## Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & pnpm (or npm)
- PostgreSQL database (Supabase recommended)

### Installation

```bash
# Clone repository
git clone <repository-url>
cd pahinga

# Install dependencies
composer install
pnpm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Update .env with database credentials
# DB_CONNECTION=pgsql
# DB_HOST=your-host
# DB_PORT=6543
# DB_DATABASE=postgres
# DB_USERNAME=your-username
# DB_PASSWORD=your-password

# Run migrations with seed data
./migrate.sh --seed

# Start development server
./start-dev.sh
```

Visit http://127.0.0.1:8000

### Test Accounts (after seeding)

| Role | Email | Password |
|------|-------|----------|
| Employee | emily.chen@horizondynamics.com | password |
| Manager | michael.rodriguez@horizondynamics.com | password |
| HR Admin | patricia.williams@horizondynamics.com | password |

---

## Development Commands

```bash
# Start development environment
./start-dev.sh

# Run migrations
./migrate.sh

# Run migrations with fresh seed
./migrate.sh --seed

# Run any artisan command
./artisan.sh [command]

# Run tests
php artisan test

# Format code
./vendor/bin/pint
```

---

## Project Structure

```
pahinga/
├── app/
│   ├── Enums/              # PHP 8.1 Backed Enums
│   ├── Http/
│   │   ├── Controllers/    # Request handlers
│   │   └── Middleware/     # Role-based middleware
│   ├── Livewire/           # Livewire 3 components
│   ├── Models/             # Eloquent models
│   ├── Notifications/      # Email/database notifications
│   └── Services/           # Business logic services
├── database/
│   ├── migrations/         # Database schema
│   ├── seeders/            # Test data
│   └── factories/          # Model factories
├── resources/
│   ├── views/
│   │   ├── components/     # Blade components
│   │   ├── hr-admin/       # HR Admin views
│   │   ├── manager/        # Manager views
│   │   ├── leave-requests/ # Employee views
│   │   └── livewire/       # Livewire components
│   ├── css/                # Tailwind styles
│   └── js/                 # Alpine.js & frontend
├── routes/
│   └── web.php             # Application routes
├── tests/
│   ├── Feature/            # Feature tests
│   └── Unit/               # Unit tests
├── start-dev.sh            # Development server
├── migrate.sh              # Migration helper
└── artisan.sh              # Artisan wrapper
```

---

## Key Technical Implementations

### PHP Enums
```php
// app/Enums/LeaveType.php
enum LeaveType: string {
    case VACATION = 'vacation';
    case SICK_LEAVE = 'sick_leave';
    case PAID_TIME_OFF = 'paid_time_off';
    case UNPAID_LEAVE = 'unpaid_leave';

    public function label(): string { ... }
}
```

### Role-Based Middleware
```php
// Routes protected by role
Route::middleware(['auth', 'role:manager'])->group(fn() => ...);
Route::middleware(['auth', 'role:hr_admin'])->group(fn() => ...);
```

### Conflict Detection Service
```php
// Automatic conflict analysis
$conflicts = $conflictService->analyzeTeamConflicts($managerId, $startDate, $endDate);
// Returns: severity, overlapping leaves, availability percentage
```

---

## Documentation

| File | Description |
|------|-------------|
| [COMMANDS.md](COMMANDS.md) | Complete command reference |
| [ROADMAP.md](ROADMAP.md) | Development phases |
| [CLAUDE.md](CLAUDE.md) | Technical architecture |
| [CHANGELOG.md](CHANGELOG.md) | Version history |

---

## Database Configuration

This project uses **PostgreSQL** with Supabase:

- **Pooled Connection (Port 6543):** Web requests (default)
- **Direct Connection (Port 5432):** Migrations

Helper scripts automatically manage connection types.

---

## Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/LeaveRequestTest.php

# Run with coverage
php artisan test --coverage
```

Test coverage includes:
- Authentication flows
- Leave request CRUD operations
- Manager approval workflows
- HR Admin management features
- Conflict detection algorithms
- Model relationships

---

## Security

- CSRF protection on all forms
- XSS prevention via Blade escaping
- SQL injection protection via Eloquent
- Authorization policies per resource
- Role-based access control
- Input validation on client and server

---

## Contributing

1. Check [ROADMAP.md](ROADMAP.md) for current priorities
2. Follow PSR-12 coding standards
3. Run `./vendor/bin/pint` before committing
4. Add tests for new features
5. Update documentation as needed

---

## License

Private - Internal Project

---

## Need Help?

| I want to... | Do this |
|--------------|---------|
| Start the app | `./start-dev.sh` → http://127.0.0.1:8000 |
| Learn commands | Read [COMMANDS.md](COMMANDS.md) |
| See the plan | Check [ROADMAP.md](ROADMAP.md) |
| Fix problems | [COMMANDS.md](COMMANDS.md) → Troubleshooting |
