<?php
//Include the database connection
include ("./system/config/dbconnection.php");

// Check if the registration form is submitted
if (isset($_POST["submitRegister"])) {

    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["userpassword"];

    // Validate that all fields are filled
    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
        $firstname = mysqli_real_escape_string($conn, $firstname);
        $lastname = mysqli_real_escape_string($conn, $lastname);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $check_email_query = "SELECT * FROM volunteer_users WHERE email='$email'";
        $result = mysqli_query($conn, $check_email_query);
        if (mysqli_num_rows($result) > 0) {
            // If email already exists
            echo "Email already exists";
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO `volunteer_users` (`firstname`, `lastname`, `email`, `userpassword`) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";
            $sql_run = mysqli_query($conn, $sql);

            // Check if the insertion was successful
            if ($sql_run) {
                // Set session variable to indicate successful registration
                $_SESSION['registration_success'] = true;
                header("Location: signin-signup_volunteers.php?register=success");
                exit();
            } else {
                // Error occurred during insertion
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        // If any field is empty, display an error message
        echo "All fields are required";
    }
}