<?php
// Include the database connection
include("./system/config/dbconnection.php");

// Check if the payment form is submitted
if (isset($_POST["submitPayment"])) {

    // Retrieve form data
    $amount = $_POST["amount"];
    $card_number = $_POST["card_number"];
    $card_holder = $_POST["card_holder"];
    $expiration_month = $_POST["expiration_month"];
    $expiration_year = $_POST["expiration_year"];
    $cvv = $_POST["cvv"];

    // SQL query to insert the credit card details into the database
    $sql = "INSERT INTO donations (amount, card_number, card_holder, expiration_month, expiration_year, cvv)
            VALUES ('$amount', '$card_number', '$card_holder', '$expiration_month', '$expiration_year', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        header("Location: paymentgateway.php?payment=success");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}