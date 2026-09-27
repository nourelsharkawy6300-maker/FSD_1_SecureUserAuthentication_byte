# Secure User Authentication System (Task 1)

This project is a secure user authentication system developed for the Arithmatrix Virtual Internship Program (AVIP) 2026.

## Features
*   **Registration Endpoint:** Allows users to create a new account.
*   **Login Endpoint:** Authenticates users and initiates a secure session.
*   **Password Security:** Passwords are securely hashed using `password_hash()` (BCRYPT) before being stored in the database. No plain-text passwords are saved.
*   **Protected Routes:** Includes a dashboard that is inaccessible without a valid authenticated session.
*   **Input Validation:** Server-side validation for required fields and proper error messaging.
*   **Responsive UI:** Clean and responsive user interface built with Bootstrap 5.

## Tech Stack
*   Backend: PHP (PDO)
*   Database: MySQL
*   Frontend: HTML5, CSS3, Bootstrap 5

## Setup Instructions
1.  Clone the repository.
2.  Create a MySQL database and run the following SQL command to create the required table:
    ```sql
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```
3.  Update the database connection details in `db.php`.
4.  Run the project on a local server (e.g., XAMPP, WAMP).
