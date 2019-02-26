# scrabble
Scrubble challenge for Elder Studios

## Problem description

    https://elder.cz/scrabble.html

## Install

Download repository.
Run 

    composer install

Copy `.env.example` and create `.env` file. 
Set app variables in the `.env` file:

    DB_DATABASE= your_db_name
    DB_USERNAME= db_username
    DB_PASSWORD= db_password

You can use artisan command for app key generation.

    php artisan key:generate
    
Run 

    php artisan migrate
    
*If you are interested run database seeding command*

    php artisan db:seed
    

This command serves the app

    php artisan serve
    
## Tests

You can run UnitTests using this command:

    composer test
    
## TODO

1. Finish leaderboard@index - show statistics of highest and lowest scores achieved.

2. Make more complex UnitTests
    
    2.1 Game tests
    
    2.2 Integrity tests
    
3. Create api/game routes

4. Create web routes

5. Create frontend views
    
    5.1 Player routes
    
    5.2 Game routes
    
    5.3 Leaderboard routes


//Things not included in the task

    
6. Create user section

    6.1 authentication
    
    6.2 administration
    
7. Gamification

    7.1 player badges
    
8. Gallery
    
    8.1 Every game will have gallery (both players can add photos)
    
9. Create leagues, tournaments