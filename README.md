# baseballAdmin
Laravel PHP web application. 
Easy to test and develop locally.

1) git clone baseballAdmin project
2) Make sure docker is installed on local machine
3) once docker is installed, open the terminal and navigate to the project
4) run following commands:
    - docker-compose up -d (runs docker-compose.yml file and creates the images, -d is for detaching from the terminal)
    - test this by opening browser and pinging localhost:4000, if it fails make sure that port is free on your machine
    - if browser displays error: no application key, open your terminal and navigate toproject directory.
        - run command : docker exec -it laravel bash (opens ssh-like connection on that web container)
        - once bash opens run command : php artisan key:generate (this populates .env file with app key\
5) once login screen appears we are close to done
    - open up a terminal 
        - run command : docker exec -it laravel bash
        - once bash opens run command : php artisan migrate (this creates all the database tables in the post db container)
6) Create a admin user and then all should be ready for development





Possible Additions:
    - composer require uxweb/sweet-alert (swal.JS)
    
Trello Project (Scrum Board)
    - https://trello.com/b/humNhSDM/seminar-project-laravel
