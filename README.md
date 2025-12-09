# ArtConnect - Online Community for Creative Sharing

ArtConnect is an online platform where artists can share their artwork, connect with other creatives, follow artists, create collections, and learn through tutorials.

## Features

- User authentication (Register/Login)
- Upload and share artworks
- Browse artworks by categories
- Like and comment on artworks
- Follow other artists
- Create and manage collections
- View and learn from tutorials
- User profiles with bio and social links
- Admin dashboard for content management

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/MariaDB
- XAMPP (recommended for local development)

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/KweydG/ArtConnect.git
cd ArtConnect
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install NPM dependencies

```bash
npm install
```

### 4. Environment setup

Copy the example environment file:

```bash
cp .env.example .env
```

### 5. Configure the database

Open `.env` and update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=group10_finals
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create the database

Using phpMyAdmin or MySQL command line, create a database named `group10_finals`:

```sql
CREATE DATABASE group10_finals;
```

### 7. Generate application key

```bash
php artisan key:generate
```

### 8. Run migrations

```bash
php artisan migrate
```

### 9. Seed the database (sample data)

```bash
php artisan db:seed
```

### 10. Build frontend assets

```bash
npm run build
```

### 11. Create storage link

```bash
php artisan storage:link
```

### 12. Run the application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Quick Setup (All Commands)

```bash
# After cloning, run these commands in order:
composer install
npm install
cp .env.example .env
php artisan key:generate
# Create database 'group10_finals' in phpMyAdmin first, then:
php artisan migrate
php artisan db:seed
npm run build
php artisan storage:link
php artisan serve
```

## Default Test Users

After seeding, you can login with these test accounts:

| Email | Password | Role |
|-------|----------|------|
| admin@artconnect.com | password | Admin |
| artist@artconnect.com | password | Artist |

## Troubleshooting

### Database Connection Error

If you get `Host 'localhost' is not allowed to connect`:

1. Make sure MySQL is running in XAMPP
2. Try changing `DB_HOST=localhost` to `DB_HOST=127.0.0.1` in `.env`

### No data showing

Make sure you ran the seeder:

```bash
php artisan db:seed
```

### Clear cache if having issues

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** MySQL/MariaDB
- **Build Tool:** Vite

## Group 10 Members

- [Add your team members here]

## License

This project is for educational purposes.
