-- SQL script to create visitors table and add sample data

-- Create the visitors table
CREATE TABLE visitor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(15),
    address VARCHAR(255),
    visit_reason VARCHAR(255),
    other_info TEXT,
    visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO visitor (name, age, gender, email, phone, address, visit_reason, other_info) 
VALUES 
('John Doe', 25, 'Male', 'johndoe@example.com', '1234567890', '123 Elm Street', 'Business Meeting', 'No other information'),
('Jane Smith', 30, 'Female', 'janesmith@example.com', '0987654321', '456 Oak Avenue', 'Conference', 'Requested access to conference room');

-- Select all data from the visitors table
SELECT * FROM visitor;
