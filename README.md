# Birrama HRMS - Phase 1

Birrama HRMS is a secure and centralized Human Resource Management System designed to reduce paperwork, track employee lifecycle, and automate core HR workflows.

## Features

- **RBAC (Role-Based Access Control)**: Secure login system with roles including Super Admin, HR Admin, HR Officer, Manager, and Employee.
- **Employee Management**: Comprehensive profiles, employment history, secure data encryption, and supervisor hierarchy.
- **Organizational Structure**: Dynamic management of departments and positions with reporting lines.
- **Document Management**: Secure storage for contracts, IDs, and certificates outside the public folder with expiry tracking.
- **Leave Management**: Full request/approval workflow with balance calculations and calendar views.
- **Benefits & Allowances**: Tracking of employee benefits and historical summaries.
- **Payroll & Tax**: Ethiopian tax computation, pension deductions, and payslip generation.
- **Performance & Recruitment**: Performance cycles, goal setting, job openings, and applicant tracking.
- **Audit Logs**: Detailed tracking of all important system actions and status changes.

## Tech Stack

- **Backend**: Laravel 11.x
- **Database**: SQLite (local) / MySQL (production)
- **Styling**: Tailwind CSS
- **Authentication**: Laravel Breeze
- **Reporting**: Laravel Excel & DomPDF (Planned)

## Local Setup

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd hrms
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**:
   ```bash
   touch database/database.sqlite
   php artisan migrate:fresh --seed
   ```

5. **Start the Application**:
   ```bash
   php artisan serve
   ```

## Demo Credentials

- **Admin**: `admin@birrama.com` / `password`
- **Employee**: `abebe@birrama.com` / `password`

## Security Notes

- All sensitive employee data (Basic Salary, Bank Details, TIN, Pension Number) is encrypted at rest using Laravel's `HasEncryptedAttributes`.
- Employee documents are stored in `storage/app/private` and are not directly accessible via the web.
- Role-based middleware enforces permission checks on all sensitive routes.
