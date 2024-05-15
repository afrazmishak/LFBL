<?php
//Include the database connection
include("./system/config/dbconnection.php");

// Check if the form is submitted
if (isset($_POST["submitLogin"])) {

    // Retrieve input values from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate if the email and password fields are not empty
    if (!empty($email) && !empty($password)) {

        // Fetch user record based on the provided email
        $query = "SELECT * FROM `general_users` WHERE `email`='$email'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            // Check if any matching user found
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['userpassword'];

                // Verify the provided password against the hashed password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session or redirect as needed
                    session_start();
                    $_SESSION['email'] = $email;
                    header("Location: generaluser_dashboard.php");
                    exit();
                } else {
                    // Password is incorrect
                    echo "Incorrect password!";
                }
            } else {
                // No user found with the provided email
                echo "No account found with this email!";
            }
        } else {
            // Query execution error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Email and password fields are required
        echo "Email and password are required!";
    }
}
