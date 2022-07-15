# shifts-api-app

Please fork this repo to your own github account, then `git clone` it
locally.

You'll need to create a .env file, this will contain database credentials like this.

![Screenshot](docs/images/env.png)

The exported database file is in the db directory in the project root directory.

You can also run `php dbseed.php` at the project root in the command to generate dummy data into your database. (Make sure the dbname is updated to your database name)

![Screenshot](docs/images/update_db_name.png)

Run `php -S 127.0.0.1:8000` to serve the project

# API Endpoints

Here is a link to the postman documentation:
https://documenter.getpostman.com/view/616819/UzQvrPqb

I also implemeted pagination to the get requests.
This prevents the app from crashing or causing a hang on the frontend/app coonsuming the api. So the pagination helps limit the amount data gotten per request.
This is my solution for the number (4) question in the test.
