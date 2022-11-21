We Build

Instalation Steps: 
1. clone repo 

2. Run the following to install dependecies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

3. copy env file
`cp .env.example .env`
replace `DB_HOST` with `mysql`
replace `DB_USERNAME` with `sail`
replace `DB_PASSWORD` with a password of your choosing
replace `REDIS_HOST` with `redis`
replace `MEMCACHED_HOST` with `memcached`

4. bring up container `./vendor/bin/sail up -d` or if you have a sail alias set up `sail up -d`
5. generate key `sail php artisan key:generate`
6. install frontend dependencies `sail npm install`
7. run migrations `sail php artisan migrate`
8. run dev frontned dev server `sail npm run dev`
9. go to `localhost` on browser
