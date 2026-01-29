
Data Center Resource Management System
A robust Laravel-based web application designed to manage data center resources, handle reservations, and facilitate communication between administrators, technical managers, and internal users.
---
# 📺 Demo Video
https://github.com/user-attachments/assets/8468f656-2869-457d-81d9-5698ea731617

https://github.com/user-attachments/assets/161f62e2-1c1f-416e-93b5-803f8db10990
---
🚀 Features
👤 User Roles & Permissions
Administrator: Full system oversight, including user management and resource monitoring.

Technical Manager (Responsable Technique): Manages resource inventory, updates hardware status (Maintenance/Active), and approves or rejects reservation requests.

Internal User (Utilisateur Interne): Views available resources, submits reservation requests, and reports technical issues.

🛠 Core Functionalities
Resource Management: CRUD operations for data center hardware and status tracking.

Reservation System: Automated workflow for requesting and approving resource usage.

Reporting System: Internal users can signal technical problems directly through the platform.

Authentication: Secure login, registration, and role-based middleware protection.

💻 Tech Stack
Framework: Laravel 12.x

Language: PHP 8.2+

Frontend: Blade Templates, CSS, and JavaScript

Database: Eloquent ORM with migration support

📥 Installation
Clone the repository:

Bash
git clone [your-repository-url]
cd Data_Center_Project
Run the Setup Script: The project includes a built-in setup command to handle dependencies, environment files, and migrations:

Bash
composer run setup
Start the Development Server: To run the server, queue listener, and Vite simultaneously:

Bash
composer run dev
🛣 Main Routes
Public Access
/ : The landing interface displaying available resources.

/login : Access the authentication portal.

/register : Create a new user account.

Restricted Access (Authenticated)
/Admin: /admin/dashboard, /admin/users, /admin/ressources.

/Technical Manager: /responsable/dashboard, /responsable/ressource/store.

/Internal User: /utilisateur/dashboard, /reservation/store.

📄 License
This project is open-sourced software licensed under the MIT license.
