## Crawler App

Clone the repository

    git clone https://github.com/ryotsu1036/crawler-app.git

Switch to the crawler-app folder

    cd crawler-app

Install all the dependencies using composer

    composer install

Install all the dependencies using npm

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create SQLite database

    touch /absolute/path/to/crawler.sqlite

SQLite Configuration

    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/crawler.sqlite

Running migrations

    php artisan migrate

Create the symbolic links configured for the application

    php artisan storage:link

Running PHP development server

    php artisan serve

And then try it.
