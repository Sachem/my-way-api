This is an API for `My Way` (habit tracking app / website)

Front-end here: https://github.com/Sachem/my-way-vue
Or here: https://github.com/Sachem/my-way-react

## Installation

1. Copy `.env.example`, into `.env`. 
2. Fill:
    GOOGLE_CLIENT_ID={your_key}
    GOOGLE_CLIENT_SECRET={your_secret}
    GOOGLE_REDIRECT_URI=http://localhost:8100/auth/google-callback
3. Run `docker-compose up -d`
4. Run `docker exec -it laravel_php bash` followed by `composer install` and `php artisan migrate`


