# Laravel Passport API Authentication Setup

This project demonstrates how to implement **API authentication** using **Laravel Passport**. It includes user registration, login, and token-based authentication with secure handling of API tokens.

## 🔧 Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL or PostgreSQL
- Laravel Passport

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/your-org/your-passport-project.git
cd your-passport-project
```

### 2. Install dependencies

```bash
composer install
```


### 3. Copy and set up environment

```bash
Copier
Modifier
cp .env.example .env
php artisan key:generate
```
Edit `.env` and set up your database credentials.

### 4. Run database migrations

```bash
Copier
Modifier
php artisan migrate
```

### 5. Install Laravel Passport

```bash
Copier
Modifier
composer require laravel/passport
php artisan passport:install
```
You should see output including the personal access and password grant clients.

Optional (to seed default clients):

```bash
php artisan passport:install --force
```

### 6. Configure AuthServiceProvider

```bash
use Laravel\Passport\Passport;

public function boot()
{
    Passport::routes();
}

```

### 7. Set Passport driver in `config/auth.php`

```php
'guards' => [
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

### 8. Use HasApiTokens trait
In your `User.php` model:

```php
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}
```

### 9. Start the local server

```bash
Copier
Modifier
php artisan serve
```


# API Authentication Flow

| Endpoint        | Method | Description         |
| --------------- | ------ | ------------------- |
| `/api/register` | POST   | Register a new user |
| `/api/login`    | POST   | Login and get token |
| `/api/user`     | GET    | Authenticated user  |


## Make sure to send the token in the Authorization header:

```bash 
Authorization: Bearer {access_token}
```

# 🛠️ Security Tips
<ul>
<li>Do not commit .env or storage/oauth-private.key.</li>

<li>Restrict access to the main branch using GitHub branch protection rules.</li>

<li>Use .gitignore to avoid leaking sensitive config files.</li>
</ul>
# 📚 References
Laravel Passport Documentation

OAuth2 Protocol

# 👨‍💻 Author
Maintained by <a herf='https://jery-portal.vercel.app'>Jery Foto</a> – backend engineer.

