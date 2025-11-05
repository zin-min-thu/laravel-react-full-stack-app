# 🚀 Laravel 12 + React + TypeScript + Inertia + SSR + Role & Permission

A modern full-stack web application built using **Laravel 12**, **React**, **TypeScript**, **Inertia.js**, and **TailwindCSS**, featuring **Server-Side Rendering (SSR)** and a complete **Role & Permission** system.

---

## 🧱 Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** React + TypeScript + Inertia.js
- **Styling:** TailwindCSS
- **Authentication:** Laravel Breeze / Fortify / Jetstream (depending on setup)
- **Authorization:** Spatie Laravel Permission
- **Build Tool:** Vite
- **SSR:** Inertia SSR (Node.js)
- **Database:** MySQL / PostgreSQL (configurable)

---

## 📦 Installation Guide

### 1️⃣ Clone the Repository
*Clone with HTTPS*
```
git clone https://github.com/zin-min-thu/laravel-react-full-stack-app.git
```
*Clone with SSH*
```
git clone git@github.com:zin-min-thu/laravel-react-full-stack-app.git
```
*Note: Prefer to use SSH. Ask your project maintainer if you need to submit your public key.*
Then
```
cd laravel-react-full-stack-app
```

### 2️⃣ Install PHP Dependencies
Make sure you have Composer installed, then run:
```
composer install
```

### 3️⃣ Install Node Dependencies
Make sure you have Node.js (>=18) and npm or yarn installed:
```
npm install
```
or
```
yarn install
```
### 4️⃣ Create Environment File
Copy the example .env file:
```
cp .env.example .env
```
Then update the following variables in .env:
```
    APP_NAME="Your Project Name"
    APP_URL=http://localhost
    VITE_APP_URL="${APP_URL}"

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=root
    DB_PASSWORD=your_db_password

    # Inertia SSR
    SSR_URL=http://localhost:13714

```
Then Generate Application Key :
```
php artisan key:generate

```
### 5️⃣ Run Migrations and Seeders
Run migrations to create database tables:
```
php artisan migrate
```
Then run your UserRolePermissionSeeder to create users, roles, and permissions:
```
php artisan db:seed --class=UserRolePermissionSeeder

```
### 6️⃣ Build Frontend Assets
For development:
```
npm run dev
```
For production:
```
npm run build
```

### 7️⃣ Run Inertia SSR Server
In a separate terminal:
```
php artisan inertia:start-ssr
```
Or using Node directly:
```
node bootstrap/ssr/ssr.mjs
```
*The SSR server must be running for server-side rendering to work.*

### 8️⃣ Serve the Laravel Application
*Using artisan:*
```
php artisan serve
```
*Using Composer:*
```
composer run dev
```
Now visit:
👉 http://localhost:8000

### Useful Commands

| Command                            | Description                          |
| ---------------------------------- | ------------------------------------ |
| `php artisan serve`                | Start Laravel backend server         |
| `npm run dev`                      | Start Vite dev server                |
| `npm run build`                    | Build frontend assets for production |
| `php artisan migrate:fresh --seed` | Reset DB and run all seeders         |
| `php artisan inertia:start-ssr`    | Start Inertia SSR server             |
| `php artisan tinker`               | Open Laravel REPL                    |
| `php artisan route:list`           | Show all routes                      |


### Deployment Notes
- Run npm run build before deploying.

- Ensure APP_ENV=production and APP_DEBUG=false.

- Make sure SSR server is configured in production if using SSR.

- You may use PM2 or Supervisor to keep the SSR process running.

### 🧑‍💻 Author
**Zin Min Thu** Web Developer
*zinminthu.dev@gmail.com*

**Portfolio:**
[https://zinminthu.vercel.app](https://zinminthu.vercel.app/)
[https://zin-min-thu.github.io](https://zin-min-thu.github.io/)