# scrabble
Scrubble challenge for Elder Studios

## Problem description

    https://elder.cz/scrabble.html

## Install

Download repository.
Run 

    docker-compose up
    docker-compose exec php composer install
    docker-compose exec php php artisan key:generate
    
Run 

    docker-compose exec php php artisan migrate
    
*If you are interested run database seeding command*

    docker-compose exec php php artisan db:seed
    

App will be available here:

    http://localhost:8000/
    
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