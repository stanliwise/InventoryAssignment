## Welcome to inventory Test Assessment

### Setup
1. Copy .env.example to .env<br>
    ```shell
    cp .env.example .env
    ```
2. create an sqlite database
    ```shell
    touch database/database.sqlite
    ```
3. install composer and generate app
    ```shell
    composer install
    ```
    ```shell
    php artisan key:generate
    ```
4. Install package and build
    ```shell
    npm install 
    ```
    ```shell
    npm run dev
    ```

5. Seed dummy data
    ```shell
    php artisan migrate:fresh
    php artisan db:seed
    ````

6. Turn on Server
    ```shell
    php artisan db serve
    ````
7. Login details for admin
   `johndoe@gmail.com`<br>
   `password`

8. To view Users frontend
   `user@gmail.com`<br>
   `password`