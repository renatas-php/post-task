⚙️ Requirements

PHP >= 8.1

Composer

Node.js >= 16 + npm or yarn

MySQL / PostgreSQL (or any Laravel-supported database)

Git



🚀 Installation

Clone the repository:

git clone https://github.com/your-username/your-project.git
cd your-project

1️⃣ Backend (Laravel)

Install dependencies:

composer install


Copy .env.example to .env and update your environment variables:

cp .env.example .env


Generate the application key:

php artisan key:generate


Run migrations and seeders:

php artisan migrate --seed


2️⃣ Frontend (Vue.js)

Install dependencies:

npm install


Build assets for development:

npm run dev


Or for production:

npm run build

🌱 Database Seeding

This project uses Laravel seeders to populate the database with demo data.

To run seeders:

php artisan db:seed


Or refresh the database with fresh seed data:

php artisan migrate:fresh --seed



🖥️ Running the App

Start the Laravel development server:

php artisan serve


Visit the app at:

http://localhost:8000



📦 Useful Commands

Run tests:

php artisan test


Clear cache:

php artisan optimize:clear


Run queue worker:

php artisan queue:work



🛠️ Tech Stack

Backend: Laravel 10+

Frontend: Vue.js 3 + Vite

Database: MySQL / PostgreSQL

Authentication: Laravel Breeze / Jetstream (if enabled)

Seeding: Laravel Seeders & Factories



📜 License

This project is open-source and available under the MIT license
.
