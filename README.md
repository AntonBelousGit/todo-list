
###Постман коллекция находиться в файле 
    TODO_LIST.postman_collection.json

###Установка

    git clone https://github.com/AntonBelousGit/todo-list
    cd laravel-tasks
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    php artisan serve

###Логинимся под одним из юзеров

    Важно! Незабыть подставить новый Bearer token в Postman
