## Project Laravel - README

### Prerequisites

Ensure you have the following installed on your system:
- PHP
- Composer
- Node.js & npm
- Vite

### Installation

Follow the steps below to set up the project:

1. **Install Composer dependencies**

   ```sh
   composer install
   ```

2. **Install npm and Vite**

   ```sh
   npm install vite
   ```

3. **Configure the environment**

   - Duplicate the `.env.example` file and rename it to `.env`.
   - Update the necessary environment variables in the `.env` file, such as database credentials and application settings.

4. **Generate the application key**

   ```sh
   php artisan key:generate
   ```

5. **Run the database migrations**

   ```sh
   php artisan migrate
   ```

6. **Seed the database**

   ```sh
   php artisan db:seed --class=UsersTableSeeder
   ```

7. **Create a symbolic link for storage**

   ```sh
   php artisan storage:link
   ```

### Running the Application

1. **Start the Laravel development server**

   ```sh
   php artisan serve
   ```

2. **Compile assets with Vite**

   ```sh
   npm run dev
   ```

Visit `http://localhost:8000` to see the application in action.

### Additional Commands

- To run Vite in production mode:

  ```sh
  npm run build
  ```

- To run the tests:

  ```sh
  php artisan test
  ```

- To clear the application cache:

  ```sh
  php artisan cache:clear
  ```

- To optimize the application:

  ```sh
  php artisan optimize
  ```