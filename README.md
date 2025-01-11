Setup Instructions

1. Download ZIP and extract in your directory

2. Install Dependencies
Run the following commands to install the necessary dependencies:
    - composer install    
    - npm install

3. Set Up the Database
    - Create a database 'task_manager' in your MySQL server.
    - Update the .env file with your database credentials.

4. Run Migrations
Run the following commands to install the necessary dependencies:
    - php artisan migrate
    - php artisan key:generate

5. Start the Development Server
Run the following commands to install the necessary dependencies:
    - php artisan serve


            --- Access the application at http://localhost:8000. ---