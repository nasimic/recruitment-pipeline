# Check the current progress from here: [TODO.md](https://github.com/nasimic/recruitment-pipeline/blob/master/TODO.md)


# Installation guide

- Clone project

- Install packages
```
composer install
```

- Copy and paste **.env.example** (Rename it to **.env**)
```
cp .env.example .env
```

- Change DB configs in **.env** file as you wish
```
php artisan key:generate
```
```
php artisan optimize
```
```
php artisan migrate
```
```
php artisan db:seed
```
```
php artisan serve
```

**Enjoy**
