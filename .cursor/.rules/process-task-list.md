# Horizon Sentinel - Development Task List

This document serves as the central hub for tracking all development tasks for the Horizon Sentinel project. Each task is generated based on the PRD and detailed in accordance with the `generate-task.md` guide.

---

## Current Sprint/Focus: Initial Setup & Authentication

### 1. Project Setup
*   **Task ID:** HS-SETUP-001
*   **Description:** Initialize Laravel project and configure environment.
*   **Acceptance Criteria:** Laravel project created, `.env` file configured for basic app name/key.
*   **Status:** DONE
*   **Estimated Effort:** 0.5 hours

*   **Task ID:** HS-SETUP-002
*   **Description:** Create initial documentation files (`create-prd.md`, `generate-task.md`, `process-task-list.md`).
*   **Acceptance Criteria:** All three `.md` files exist in the project root.
*   **Status:** DONE
*   **Estimated Effort:** 0.25 hours

*   **Task ID:** HS-SETUP-003
*   **Description:** Populate `create-prd.md` with initial project requirements.
*   **Acceptance Criteria:** PRD document contains detailed sections on introduction, goals, problem, solution, features, non-functional requirements, tech stack, and success metrics.
*   **Status:** DONE (initial version)
*   **Estimated Effort:** 1 hour

### 2. Database & Environment Configuration
*   **Task ID:** HS-DB-001
*   **Description:** Configure database connection in `.env` and `config/database.php`.
*   **Acceptance Criteria:** Application can connect to a local MySQL database.
*   **Status:** PENDING
*   **Estimated Effort:** 0.5 hours

*   **Task ID:** HS-DB-002
*   **Description:** Run initial database migrations (`php artisan migrate`).
*   **Acceptance Criteria:** `users` table (and others from framework) exist in the database.
*   **Status:** PENDING
*   **Estimated Effort:** 0.25 hours

### 3. User Authentication
*   **Task ID:** HS-AUTH-001
*   **Description:** Install Laravel Breeze (or Jetstream) for authentication scaffolding.
*   **Acceptance Criteria:** Breeze installed, views published, `npm install && npm run dev` successful.
*   **Status:** PENDING
*   **Estimated Effort:** 1 hour

*   **Task ID:** HS-AUTH-002
*   **Description:** Implement user registration and login functionality.
*   **Acceptance Criteria:** Users can register an account, log in, and log out successfully.
*   **Status:** PENDING
*   **Estimated Effort:** 0.5 hours
*   **Dependencies:** HS-AUTH-001

*   **Task ID:** HS-AUTH-003
*   **Description:** Add 'role' column to the `users` table and update registration.
*   **Acceptance Criteria:** `users` table has a `role` column (e.g., 'employee', 'manager'), and new users can be assigned a default role.
*   **Status:** PENDING
*   **Estimated Effort:** 1 hour
*   **Dependencies:** HS-DB-002

---

## Next Up: Core Data Model & Employee Interface

*(This section will be populated as we complete the initial tasks and generate more detailed tasks for the core features.)*

---

## Completed Tasks

*(Once tasks are completed, they will be moved here for historical tracking, or their status will be updated to 'DONE' in the active list.)*