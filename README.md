## About Project

## Plugins

- [Activity Logger](https://filamentphp.com/plugins/z3d0x-logger).
- [Spatie roles & Permissions](https://filamentphp.com/plugins/tharinda-rodrigo-spatie-roles-permissions).
- [Spatie Media Library](https://filamentphp.com/plugins/filament-spatie-media-library).
- [Breezy](https://github.com/jeffgreco13/filament-breezy).
- [Laravel JetStream](https://jetstream.laravel.com/introduction.html).

## Tech Stack

- [Laravel](https://laravel.com).
- [TailwindCSS](https://tailwindcss.com).
- [FilamentPHP V3](https://filamentphp.com).

## Functionality

- Email verification
- Enable 2FA
- Likes and Dislikes
- Commenting


## Prerequisites

- Import the database to get a few things started

- Admin credentials
```bash
email: admin@admin.dev
password: Admin123
```

- Remember to checkout the screenshots folder in the root directory 

## Installation
- Clone the repository
```bash
git clone https://github.com/njugunamwangi/laravel-livewire.git
```
- On the root of the directory, copy and paste .env.example onto .env and configure the database accordingly
 ```bash
copy .env.example .env
```

- Grab the email test credentials from mailtrap.io and replace in the .env file
```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxxxxx
MAIL_PASSWORD=xxxxxxx
```

- Install composer dependencies bu running composer install
 ```bash
composer install
```
- Install npm dependencies
```bash
npm install
```

- Generate laravel application key using 
```bash
php artisan key:generate
```

- Run laravel application using 
```bash
php artisan serve
```
- Run react application using 
```bash
npm run dev
```

- Storage
```bash
php artisan storage:link
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
