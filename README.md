# Check the current progress from here: [TODO.md](https://github.com/nasimic/recruitment-pipeline/blob/master/TODO.md)

# To run tests
```
php artisan test
```

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

- Change DB configs in **.env** file as you wish (mind DB_TEST_DATABASE for testing)
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
