# Laravel with Sail and Vue.js

## Setup Instructions

### Requirements
- `docker` installed on your local machine.
- `docker-compose` installed on your local machine.

### Clone the Repository
```bash
git clone <repository_url>
cd <repository_directory>
```

## Start Docker Environment
```bash
docker-compose up -d
```

Access Laravel Sail workspace:

```bash
docker exec -it laravel_app bash
composer install
npm install
npm run dev/build
```

## Database Setup
```bash
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan db:seed
```

## Access application in your browser at http://localhost

## Features
- List
- Create with draft, remember last step
- Edit
- Delete