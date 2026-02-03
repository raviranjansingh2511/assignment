## Project Setup

1. Clone the project to your local machine:
   git clone <repository-url>

2. Navigate into the project directory:
   cd project-folder-name

3. Install dependencies:
   composer update

4. Create a `.env` file:
   cp .env.example .env

5. Create a database using XAMPP / WAMP / phpMyAdmin.

6. Update the `.env` file with basic configuration:
   - Database name
   - Database username & password
   - Mail credentials
   - Project URL

8. Run database migrations:
   php artisan migrate

9. Run database seeders:
   php artisan db:seed

10. Run the project:
    php artisan serve
