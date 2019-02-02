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
        - run command : docker exec laravel bash (opens ssh-like connection on that web container)
        - once bash opens run command : php artisan key:generate (this populates .env file with app key)
