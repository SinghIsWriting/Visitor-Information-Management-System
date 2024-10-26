<?php 

require_once "config.php";

$success = 2;
$message = '';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? 0;
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $reason = $_POST['visit'] ?? '';
    $other = $_POST['other'] ?? '';


    $sql = "INSERT INTO visitor (name, age, gender, email, phone, address, reason, other)
            VALUES (:name, :age, :gender, :email, :phone, :address, :reason, :other);";
    $stmt = $conn->prepare($sql);

    // Execute SQL statement
    try {
        $stmt->execute([
            ':name' => $name,
            ':age' => $age,
            ':gender' => $gender,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':reason' => $reason,
            ':other' => $other,
        ]);

        // Success message
        $success = true;
        $message = "Thank you! Your information has been recorded successfully as a visitor in the IIT (ISM) Dhanbad!";
    } catch (PDOException $e) {
        $success = false;
        $message = "Error: " . $e->getMessage();
    }
}

// Fetching all visitor records
$visitors = [];
try {
    $stmt = $conn->query("SELECT * FROM visitor ORDER BY sno DESC");
    $visitors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching visitors: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors' Registration - IIT ISM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <img src="iitism.png" alt="iitism_pic">
    <div class="container">
        <h1>Visitors' Registration - IIT ISM</h1>
        <?php
        if($success==1){
        echo "<span id='success'>$message</span>";
        }else if($success==0){
            echo "<span id='error'>$message</span>";
        }else{
            echo "<span>Please enter visitor's details below to register a visit in IIT (ISM) Dhanbad</span>";
        }
        ?>
        <form method="post" id="visitorForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter visitor's name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter visitor's age" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option id="disabled-option" value="" disabled selected>Select visitor's gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="nonbinary">Non-binary</option>
                <option value="preferNotToSay">Prefer not to say</option>
                <option value="other">Other</option>
            </select>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter visitor's email" required>
            <label for="phone">Phone number:</label>
            <input type="phone" id="phone" name="phone" placeholder="Enter visitor's phone number" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter visitor's address" required>
            <label for="visit">Reason of this visit:</label>
            <input type="text" id="visit" name="visit" placeholder="Enter the reason of this visit" required>
            <label for="other">Other Information:</label>
            <textarea id="other" name="other" cols="20" rows="2" placeholder="Enter other information (if any)..."></textarea>
            <input type="submit" value="Submit" id="submit">

        </form>

        
    </div>
    <div class="visitors">
        <!-- Visitor Records Table -->
        <h1 style="margin-top: 20px">Visitors Information</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Purpose of visit</th>
                    <th>Other Info</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($visitors)): ?>
                    <?php 
                        $serialNumber = 1;
                        foreach($visitors as $visitor) {
                            echo "<tr>
                                    <td title='{$serialNumber}'>{$serialNumber}.</td>
                                    <td title='{$visitor["name"]}'>{$visitor['name']}</td>
                                    <td title='{$visitor["age"]}'>{$visitor['age']}</td>
                                    <td title='{$visitor["gender"]}'>{$visitor['gender']}</td>
                                    <td title='{$visitor["email"]}'>{$visitor['email']}</td>
                                    <td title='{$visitor["phone"]}'>{$visitor['phone']}</td>
                                    <td title='{$visitor["address"]}'>{$visitor['address']}</td>
                                    <td title='{$visitor["reason"]}'>{$visitor['reason']}</td>
                                    <td title='{$visitor["other"]}'>{$visitor['other']}</td>
                                    <td title='{$visitor['datetime']}' id='time'>{$visitor['datetime']}</td>
                                </tr>";
                            $serialNumber++;
                        }
                        ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No visitors found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" defer></script>  

    <script>
        function ready(fn) {
            if (document.readyState !== 'loading') {
                fn();
            } else {
                document.addEventListener('DOMContentLoaded', fn);
            }
        }
        function submitForm() {
            const form = document.getElementById('visitorForm');
            const formData = new FormData(form); // Collects form data

            fetch('index.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                form.reset();  // Reset the form after submission
                updateRelativeTimes();
            })
            .catch(error => {
                console.log("An error occurred: " + error);
            });
        }

        ready(function(){

            if (typeof jQuery !== 'undefined'){

                updateRelativeTimes();

                function updateRelativeTimes() {
                    const timeElements = document.querySelectorAll('#time');
                    
                    timeElements.forEach(element => {
                        const exactTime = new Date(element.getAttribute('title'));
                        const now = new Date();
                        const diffInSeconds = Math.floor((now - exactTime) / 1000);
                        
                        let timeAgo;
                        if (diffInSeconds < 60) {
                            timeAgo = 'Just now';
                        } else if (diffInSeconds < 3600) {
                            const minutes = Math.floor(diffInSeconds / 60);
                            timeAgo = `${minutes} ${minutes === 1 ? 'minute' : 'minutes'} ago`;
                        } else if (diffInSeconds < 86400) {
                            const hours = Math.floor(diffInSeconds / 3600);
                            timeAgo = `${hours} ${hours === 1 ? 'hour' : 'hours'} ago`;
                        } else if (diffInSeconds < 604800) {
                            const days = Math.floor(diffInSeconds / 86400);
                            timeAgo = days === 1 ? 'Yesterday' : `${days} days ago`;
                        } else if(diffInSeconds<2600640) {
                            const weeks = Math.floor(diffInSeconds / 604800);
                            timeAgo = weeks === 1 ? 'last week' : `${weeks} weeks ago`;
                        }
                         else if(diffInSeconds<31207680) {
                            const weeks = Math.floor(diffInSeconds / 2600640);
                            timeAgo = weeks === 1 ? 'last month' : `${weeks} months ago`;
                        }
                         else if(diffInSeconds<31207680) {
                            const months = Math.floor(diffInSeconds / 2600640);
                            timeAgo = months === 1 ? 'last month' : `${weeks} months ago`;
                            if(months>=12){
                                if(months==12) timeAgo = `${months/12} year ago`;
                                else if(months%12==0) timeAgo = `${months/12} years ago`;
                                else timeAgo = `${months/12} years and ${months%12} months ago`;
                            }
                        }                        
                        // Update only the relative time part
                        element.textContent = `${timeAgo}`;
                    });
                }

                // Update times every minute
                setInterval(updateRelativeTimes, 60000);

            }else{
                console.error('jQuery is not loaded');
            }
        });

    </script>
</body>
</html>