<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: signin-signup_organization.php");
    exit();
}

// Include the database connection
include("./system/config/dbconnection.php");

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the delete query
    $delete_query = "DELETE FROM `foodbankdetails` WHERE `id`='$id'";

    // Perform the deletion
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Redirect back to the page where food bank details are listed
        header("Location: organization_foodbanks.php?deleted_successfully");
        exit();
    } else {
        // Error handling if deletion fails
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // Redirect if ID parameter is not provided
    header("Location: organization_foodbanks.php");
    exit();
}