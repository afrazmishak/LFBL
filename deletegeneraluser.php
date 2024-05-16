<?php
// Include the database connection
include ("./system/config/dbconnection.php");

session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: signin-signup_users.php");
    exit();
}

// Retrieve the logged-in user's email from the session
$email = $_SESSION['email'];

// Fetch user record based on the provided email
$query = "SELECT * FROM `general_users` WHERE `email`='$email'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id']; // Get the ID of the logged-in user

    // Delete related rows from general_userdetails table
    $delete_details_query = "DELETE FROM `general_userdetails` WHERE `general_user_id`='$user_id'";
    if (mysqli_query($conn, $delete_details_query)) {
        // User details deleted successfully
        // Now delete the user account from the general_users table
        $delete_user_query = "DELETE FROM `general_users` WHERE `id`='$user_id'";
        if (mysqli_query($conn, $delete_user_query)) {
            // Account deleted successfully
            unset($_SESSION['email']);
            header("Location: signin-signup_users.php?accountdeleted!");
            exit();
        } else {
            // Handle error deleting account
            echo "Error deleting user account: " . mysqli_error($conn);
        }
    } else {
        // Handle error fetching user details
        echo "Error fetching user details.";
    }
}
