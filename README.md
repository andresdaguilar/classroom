# Classroom Booking System

This is a Laravel-based classroom booking system. It allows users to view available classrooms, book time slots, and cancel bookings. The project is fully documented with Swagger and includes a Postman collection for API testing.

## Requirements

Before you start, make sure you have the following installed:

- PHP 8.1
- Composer
- MySQL or any other supported database
- Git
- Node.js & npm (for frontend assets, if needed)

## Installation

1. **Clone the repository:**

   `git clone https://github.com/andresdaguilar/classroom.git`

   `cd classroom`

2. **Install dependencies:**

   `composer install`

3. **Copy the `.env` file:**

   `cp .env.example .env`

4. **Generate the application key:**

   `php artisan key:generate`

## Database Configuration

1. **Create a database:**

   Create a new MySQL database. You can name it `classroom_booking` or any other name you prefer.

2. **Update the .env file:**

   Open the .env file and update the following lines with your database information:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=classroom_booking
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

3. **Run the database migrations:**

   `php artisan migrate`

## Seeding the Database

To seed the database with initial data, run the following command:

`php artisan db:seed`

This command will populate the `classrooms` table with predefined classroom data.

## Starting the Server

To start the Laravel development server, use the following command:

`php artisan serve`

By default, the server will start at `http://127.0.0.1:8000`.

## Accessing Swagger Documentation

This project includes Swagger documentation for the API endpoints.

1. **Generate Swagger documentation:**

   `php artisan l5-swagger:generate`

2. **Access the Swagger UI:**

   Open your browser and navigate to:

   `http://127.0.0.1:8000/api/documentation`

   Here, you'll find the interactive API documentation where you can test the endpoints.

## Using the Postman Collection

A Postman collection is included in the project to facilitate API testing.

1. **Import the Postman collection:**

   The Postman collection file is named `ClassroomBooking.postman_collection.json` and is located in the root of the project.

   - Open Postman.
   - Click on `Import` in the top-left corner.
   - Select the `ClassroomBooking.postman_collection.json` file from the project directory.
   - Click `Import`.

2. **Test the API:**

   Once imported, you can use the collection to test the available API endpoints for classrooms, bookings, and cancellations.

---

### Additional Notes

- **Environment Variables:** Make sure to adjust any environment variables in the `.env` file to match your specific setup, especially if deploying to a production environment.
- **Security:** Ensure that your database credentials and other sensitive information are kept secure and not committed to version control.
