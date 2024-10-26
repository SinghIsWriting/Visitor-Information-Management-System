# Visitor Information Management System

A web-based application for storing and displaying visitor information for a college. This project enables users to submit their personal details, which are stored in a database and displayed in a user-friendly table format. 

## Table of Contents

- [Features](#features)
- [Deployed Project Link](#deployed-project-link)
- [Screenshots](#screenshots)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Technologies Used](#technologies-used)
- [License](#license)

---

## Features

- Submit visitor information via a web form.
- Store visitor data securely in a MySQL database.
- Display all visitor information in a table format with pagination.
- User-friendly interface with scrollable and responsive design.
- Displays success message after form submission.

## Deployed Project Link [Click Here](http://data-store.infinityfreeapp.com/visitors-project/)

## Screenshots
Include screenshots of the form and the table to illustrate the user interface.
![visitors-project](https://github.com/user-attachments/assets/70113c83-286e-4301-bf13-585c81f6e8a3)

## Installation

Follow these steps to set up the project on your local machine or server.

### Prerequisites

- PHP >= 7.4
- MySQL database
- Tools (XAMPP, GitHub)
- A web server (e.g., Apache or Nginx)
- Composer (optional, if additional PHP packages are needed)

### Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/SinghIsWriting/Visitor-Information-Management-System.git
   cd Visitor-Information-Management-System
   ```
2. Set up the Database

- Open `XAMPP` control panel and start `Apache` and `MySql server`.
- Create a MySQL database for the project in `phpmyadmin`.
- Create a table manually:
  ```sql
    CREATE TABLE visitors (
      sno INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(50),
      age INT,
      gender VARCHAR(10),
      email VARCHAR(100),
      phone VARCHAR(15),
      address VARCHAR(255),
      reason TEXT,
      other TEXT,
      datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ```
3. Configure Database Connection

Open `config.php` and update database credentials:
  ```php
    <?php
      $host = "localhost";
      $username = "root";
      $password = "";
      $dbname = "your_database_name";
      
      // Connect to the database
      try {
          $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Database connection failed: " . $e->getMessage();
          exit();
      }
      ?>
  ```
4. Deploy the Project

- Place the project files on your server's document root (e.g., htdocs for XAMPP, www for WAMP).
- Start the server and access the project via `http://localhost/Visitor-Information-Management-System` or your server's URL.

## Usage
### Submitting Visitor Information
1. Fill out the visitor form with required details like name, age, gender, email, phone, address, visit reason, and other information.
2. Submit the form to save the visitor's data in the database.
3. A success message will appear upon successful submission.

### Viewing Visitor Information
1. All submitted visitor details are displayed in a scrollable, responsive table below the form.
2. The table includes a serial number, timestamp, and all form data.

## Project Structure
  ```perl
    Visitor-Information-Management-System/
    ├── index.php            # Main file containing form and display logic
    ├── config.php           # Database configuration
    ├── styles.css           # Styling for the form and table
    ├── README.md            # Project documentation
    └── visitor.sql          # SQL file for setting up the database (optional)
  ```

## Technologies Used
- **Frontend:** HTML, CSS (with a scrollable and responsive design)
- **Backend:** PHP
- **Database:** MySQL
- **Server:** (Apache and MySQL Server) XAMPP

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For questions, feel free to contact me or open an issue on GitHub.
* Email: sabhisheksignh343104@gmail.com
* GitHub: [SinghIsWriting](https://github.com/SinghIsWriting)
* LinkedIn: [Abhishek Singh](https://www.linkedin.com/in/abhishek-singh-bba2662a9)

