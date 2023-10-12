
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if 'user_name' key exists in the $_POST array
    if (isset($_POST["user_name"])) {
        // Database connection information
        $servername = "localhost";
        $username = "nicolae";
        $password = "Bogdan&milena1";
        $dbname = "beachshore";

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user input from the form
        $user_name = $_POST["user_name"];
        $email = $_POST["email"];
        $birthday = $_POST["birthday"];

        // Check if the email address has been used before and if it was used show an error message
        $sql = "SELECT * FROM user_details WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<!DOCTYPE html><html lang="en">
            <head>
                <link rel="stylesheet" href="./style.css" />
                <meta charset="UTF-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Welcome to our competition</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
            </head>
            <body>
            <div class="container">
            <div class="card">
            <div class="card-body">
            <h5 class="card-title">Error!</h5>
            <p class="card-text">This email address has already been used.</p>
            <br>
            <a class="btn btn-secondary" href="./index.html" role="button">Go back</a>
            </div>
            </div>
            </div>
            </body>
            </html>';
            exit();
        }

        // Insert the user data into the database
        $sql = "INSERT INTO user_details (user_name, email, birthday) VALUES ('$user_name', '$email', '$birthday')";
        
        if ($conn->query($sql) === TRUE) {
            echo '<!DOCTYPE html><html lang="en">
                    <head>
                       <link rel="stylesheet" href="./style.css" /><meta charset="UTF-8">
                       <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Welcome to our competition</title>
                       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
                    </head>
                                    <body>
                                        <div class="container">
                                            
                                                <div class="card-body">
                                                    <h5 class="card-title">Thank you for entering our competition!</h5>
                                                    <p class="card-text">The lucky winner will be drawn at random after the competition closes. Good luck!</p>
                                                </div> 
                                                <br>
                                                <a class="btn btn-secondary" href="./index.html" role="button">Go back</a>
                                        </div>
                                    </body>
                 </html>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>