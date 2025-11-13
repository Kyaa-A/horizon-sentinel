# Command Reference Guide

Complete guide to all commands available in Horizon Sentinel with explanations of what they do.

---

## 🚀 Essential Commands (Use These Every Day)

### Start the Development Server

```bash
./start-dev.sh
```

**What it does:**
- Starts the Laravel web server on http://127.0.0.1:8000
- Starts Vite dev server on http://localhost:5173 (hot reload for CSS/JS)
- Starts the queue worker (processes background jobs)
- Starts the log viewer (shows real-time logs)

**When to use it:**
- Every time you want to work on the project
- When you want to see your website in the browser

**To view your website:**
1. Run `./start-dev.sh`
2. Open your browser
3. Go to: **http://127.0.0.1:8000** or **http://localhost:8000**

**To stop it:**
- Press `Ctrl+C` in the terminal

---

### Run Database Migrations

```bash
./migrate.sh
```

**What it does:**
- Creates/updates database tables based on migration files
- Uses the direct connection (more reliable for schema changes)
- Automatically handles environment variables

**When to use it:**
- After pulling new code that has new migrations
- After creating a new migration file
- When setting up the project for the first time

**Common variations:**
```bash
./migrate.sh                    # Run new migrations
./migrate.sh --seed             # Run migrations + seed test data
./migrate.sh --rollback         # Undo the last migration
./migrate.sh --fresh --seed     # Drop all tables, recreate, and seed
```

---

### Run Artisan Commands

```bash
./artisan.sh [command]
```

**What it does:**
- Runs any Laravel artisan command with clean environment
- Automatically clears conflicting environment variables

**Common examples:**

#### Create New Model
```bash
./artisan.sh make:model LeaveRequest -mfc
```
- Creates a Model file
- `-m` = creates migration file
- `-f` = creates factory file
- `-c` = creates controller file

#### Create New Controller
```bash
./artisan.sh make:controller LeaveRequestController
```
- Creates a controller file in `app/Http/Controllers/`

#### Create New Migration
```bash
./artisan.sh make:migration create_leave_requests_table
```
- Creates a migration file in `database/migrations/`

#### View Database Info
```bash
./artisan.sh db:show
```
- Shows database connection details
- Lists all tables and their sizes
- Useful for verifying connection

#### Clear Caches
```bash
./artisan.sh cache:clear       # Clear application cache
./artisan.sh config:clear      # Clear configuration cache
./artisan.sh route:clear       # Clear route cache
./artisan.sh view:clear        # Clear compiled views
```

#### Interactive Shell (Tinker)
```bash
./artisan.sh tinker
```
- Opens an interactive PHP shell
- Test code and query database
- Type `exit` to quit

#### List All Routes
```bash
./artisan.sh route:list
```
- Shows all available routes in your application

---

## 📦 Package Management

### Install PHP Dependencies

```bash
composer install
```

**What it does:**
- Installs all PHP packages listed in `composer.json`
- Creates/updates `vendor/` directory

**When to use it:**
- First time setting up the project
- After pulling code with new dependencies

---

### Install JavaScript Dependencies

```bash
pnpm install
```

**What it does:**
- Installs all JavaScript packages listed in `package.json`
- Creates/updates `node_modules/` directory
- Includes things like Alpine.js, Tailwind, Vite

**When to use it:**
- First time setting up the project
- After pulling code with new dependencies
- If you see "module not found" errors

**Note:** Must be run from Windows terminal if using WSL, not from within WSL terminal.

---

### Update Dependencies

```bash
composer update              # Update PHP packages
pnpm update                 # Update JavaScript packages
```

---

## 🏗️ Building Assets

### Development Build (with hot reload)

```bash
npm run dev
# or
pnpm dev
```

**What it does:**
- Compiles CSS and JavaScript files
- Watches for changes and auto-reloads
- Already included in `./start-dev.sh`

---

### Production Build

```bash
npm run build
# or
pnpm build
```

**What it does:**
- Compiles and minifies CSS/JS for production
- Optimizes file sizes
- Creates files in `public/build/`

**When to use it:**
- Before deploying to production
- To test production build locally

---

## 🗄️ Database Commands

### View Database Status

```bash
./artisan.sh db:show
```

**Shows:**
- Database type (PostgreSQL)
- Connection details
- Number of tables
- Database size
- List of all tables

---

### Run Specific Migration

```bash
./artisan.sh migrate --path=database/migrations/2024_11_13_create_leave_requests_table.php
```

**What it does:**
- Runs only the specified migration file

---

### Check Migration Status

```bash
./artisan.sh migrate:status
```

**What it does:**
- Shows which migrations have been run
- Shows which are pending

---

### Fresh Database (WARNING: Deletes all data)

```bash
./migrate.sh --fresh --seed
```

**What it does:**
- Drops ALL tables
- Recreates all tables
- Seeds with test data

**Use with caution:** This deletes everything!

---

### Seed Database

```bash
./artisan.sh db:seed
```

**What it does:**
- Runs all seeders in `database/seeders/`
- Adds test data to database

**Specific seeder:**
```bash
./artisan.sh db:seed --class=UserSeeder
```

---

## 🧪 Testing Commands

### Run All Tests

```bash
composer test
# or
./artisan.sh test
```

**What it does:**
- Runs all tests in `tests/` directory
- Shows pass/fail results

---

### Run Specific Test File

```bash
./artisan.sh test tests/Feature/LeaveRequestTest.php
```

---

### Run Tests with Coverage

```bash
./artisan.sh test --coverage
```

**What it does:**
- Runs tests and shows code coverage percentage

---

## 🎨 Code Quality

### Format Code (Laravel Pint)

```bash
./vendor/bin/pint
```

**What it does:**
- Automatically formats PHP code
- Follows Laravel coding standards
- Fixes spacing, indentation, etc.

---

### Check Code Without Fixing

```bash
./vendor/bin/pint --test
```

**What it does:**
- Shows what would be changed
- Doesn't actually modify files

---

## 🔧 Utility Commands

### Generate Application Key

```bash
./artisan.sh key:generate
```

**What it does:**
- Creates a new APP_KEY in `.env`
- Required for encryption

**When to use it:**
- First time setup
- If APP_KEY is empty

---

### Create Storage Link

```bash
./artisan.sh storage:link
```

**What it does:**
- Creates symbolic link from `public/storage` to `storage/app/public`
- Needed for file uploads to be publicly accessible

---

### Clear All Caches

```bash
./artisan.sh optimize:clear
```

**What it does:**
- Clears all caches (config, routes, views, etc.)

---

### Optimize for Production

```bash
./artisan.sh optimize
```

**What it does:**
- Caches config, routes, and views
- Makes app faster in production

---

## 🔍 Debugging Commands

### Tail Logs in Real-time

```bash
./artisan.sh pail
```

**What it does:**
- Shows logs as they happen
- Already included in `./start-dev.sh`

**Options:**
```bash
./artisan.sh pail -v        # Verbose mode
./artisan.sh pail -vv       # Very verbose mode
```

---

### View Last Log Entries

```bash
tail -f storage/logs/laravel.log
```

**What it does:**
- Shows the last entries in the log file
- Updates in real-time

---

### Interactive Shell (Tinker)

```bash
./artisan.sh tinker
```

**What it does:**
- Opens interactive PHP shell
- Test queries, models, etc.

**Examples in Tinker:**
```php
// Get all users
User::all()

// Create a user
User::create(['name' => 'John', 'email' => 'john@example.com', 'password' => bcrypt('password')])

// Query database
DB::table('users')->count()

// Exit
exit
```

---

## 📊 Information Commands

### List All Artisan Commands

```bash
./artisan.sh list
```

**What it does:**
- Shows every available artisan command

---

### Get Help for a Command

```bash
./artisan.sh help migrate
```

**What it does:**
- Shows detailed help for a specific command

---

### Show Laravel Version

```bash
./artisan.sh --version
```

---

### Show PHP Version

```bash
php --version
```

---

### Show Composer Version

```bash
composer --version
```

---

## 🎯 Quick Reference

### Daily Workflow
```bash
./start-dev.sh              # Start everything
# Make code changes
./artisan.sh test           # Run tests
./vendor/bin/pint           # Format code
# Commit changes
```

### Creating New Feature
```bash
# 1. Create model, migration, controller
./artisan.sh make:model Post -mfc

# 2. Edit migration file in database/migrations/

# 3. Run migration
./migrate.sh

# 4. Edit model, controller, views

# 5. Test it
./start-dev.sh
# Visit http://127.0.0.1:8000
```

### After Pulling Code
```bash
composer install            # Update PHP packages
pnpm install               # Update JS packages
./migrate.sh               # Run new migrations
./artisan.sh optimize:clear # Clear caches
./start-dev.sh             # Start development
```

---

## ❓ Troubleshooting

### "Command not found" Error
```bash
# Make sure script is executable
chmod +x start-dev.sh migrate.sh artisan.sh
```

### Database Connection Issues
```bash
# Check connection
./artisan.sh db:show

# Clear config cache
./artisan.sh config:clear
```

### Vite/Asset Issues
```bash
# Reinstall node modules
rm -rf node_modules
pnpm install

# Rebuild assets
pnpm build
```

### Cache Issues
```bash
# Clear everything
./artisan.sh optimize:clear
./artisan.sh config:clear
./artisan.sh cache:clear
./artisan.sh view:clear
./artisan.sh route:clear
```

---

## 🔗 See Also

- [README.md](README.md) - Project overview
- [ROADMAP.md](ROADMAP.md) - Development progress
- [CLAUDE.md](CLAUDE.md) - Technical documentation
