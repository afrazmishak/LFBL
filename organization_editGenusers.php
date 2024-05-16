<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: signin-signup_organization.php");
    exit();
}

// Include the database connection
include ("./system/config/dbconnection.php");

$id = $_GET['id'];

// Fetch existing details
$existing_details_query = "SELECT * FROM `general_users` WHERE `id`='$id'";
$existing_details_result = mysqli_query($conn, $existing_details_query);

// Check if existing details are fetched successfully
if ($existing_details_result && mysqli_num_rows($existing_details_result) > 0) {
    $existing_details = mysqli_fetch_assoc($existing_details_result);

    // Assign existing details to variables for displaying in the form
    $existing_email = $existing_details['email'];

    // Form submission handling
    if (isset($_POST['submitDetails'])) {
        // Retrieve and sanitize input data
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $userpassword = mysqli_real_escape_string($conn, $_POST["userpassword"]);
        
        // Hash the password
        $hashed_password = password_hash($userpassword, PASSWORD_DEFAULT);

        // Perform the update
        $update_query = "UPDATE `general_users` SET `email`='$email', `userpassword`='$hashed_password'";

        $update_query .= " WHERE `id`='$id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // On successful submission or update, display the popup
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('popup').classList.add('active');
                });

                function closePopup() {
                    window.location.href = 'organization_users.php?success!'; // Redirect to home.php
                }
              </script>";
        } else {
            echo "Error updating details: " . mysqli_error($conn);
        }
    }
} else {
    echo "Error fetching existing details: " . mysqli_error($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>LFBL | Change Password</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(270deg, #06142e, #bbb);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow-y: auto;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .nav {
            position: fixed;
            top: 10px;
            display: flex;
            align-items: start;
            width: 100%;
            height: 100px;
            line-height: 100px;
            z-index: 100;
        }

        .nav-logo img {
            display: none;
            height: 45px;
            padding-left: 40px;
        }

        .form-box {
            position: relative;
            width: 516px;
            height: auto;
            overflow: auto;
            z-index: 2;
        }

        .header {
            font-size: 24px;
            align-self: center;
            margin-top: 15px;
            margin-bottom: 15px;
            color: #fff;
            font-weight: 500;
        }

        .login-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 10px;
            border-radius: 10px;
        }

        .login-container header {
            color: #fff;
            font-size: 30px;
            text-align: center;
            padding: 10px 0 30px 0;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .image-upload {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-top: 15px;
        }

        .upload-label {
            font-size: 30px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            height: 60px;
            width: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        .upload-label:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .upload-label i {
            color: #fff;
        }

        #imageUpload {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 1;
        }

        .input-field {
            font-size: 15px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            height: 50px;
            width: 100%;
            padding: 0 45px 0 45px;
            border: none;
            border-radius: 30px;
            outline: none;
        }

        .input-field:hover,
        .input-field:focus {
            background: rgba(255, 255, 255, 0.25);
        }

        .input-box i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 15px;
            color: #fff;
        }

        .submit,
        .delete {
            font-size: 15px;
            font-weight: 500;
            color: black;
            height: 45px;
            width: 100%;
            border: none;
            border-radius: 30px;
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: .3s ease-in-out;
        }

        .submit:hover {
            background: green;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }

        .delete:hover {
            background: red;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }

        .popup {
            width: 400px;
            background: #fff;
            border-radius: 6px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
            z-index: 9999;
            overflow: hidden;
        }

        .popup.active {
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup i {
            font-size: 100px;
            color: #333;
            width: 100px;
            margin-top: 30px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .popup h2 {
            font-size: 38px;
            font-weight: 500;
            margin: 30px 0 10px;
        }

        .popup button {
            width: 100%;
            margin-top: 50px;
            padding: 10px 0;
            background: #6fd649;
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
        }

        .popup.active~.blur-background {
            display: block;
        }

        .notification-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .notification-content {
            text-align: center;
        }

        .notification-buttons button {
            margin: 10px 10px;
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .notification-buttons button:hover {
            background-color: #0056b3;
        }

        .blur-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9998;
        }

        @media only screen and (max-width: 540px) {
            .wrapper {
                min-height: auto;
            }

            .form-box {
                width: 100%;
            }

            .login-container,
            .register-container {
                padding: 0 20px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <img src="./images/Logo Files/For Web/png/White logo - no background.png" alt="Logo">
            </div>
        </nav>

        <div class="form-box">
            <form class="login-container" id="login" action="organization_editGenusers.php?id=<?php echo $id; ?>"
                method="POST" enctype="multipart/form-data">
                <p class="header">General Users</p>
                <p class="header">Change Username and/or Password</p>

                <div class="input-box">
                    <input type="text" class="input-field" name="email" placeholder="Email"
                        value="<?php echo $existing_email; ?>">
                    <i class='bx bxs-bank'></i>
                </div>

                <div class="input-box">
                    <input type="text" class="input-field" name="userpassword" placeholder="Change Password">
                    <i class='bx bx-user'></i>
                </div>

                <div class="input-box">
                    <input type="submit" class="submit" name="submitDetails" value="Submit">
                </div>
            </form>

            <div class="popup" id="popup">
                <i class='bx bx-check-circle'></i>
                <h2>Success</h2>
                <p>Profile details have been updated successfully!</p>
                <button type="button" onclick="closePopup();">OK</button>
            </div>

            <div class="blur-background" id="blur-background"></div>
        </div>
    </div>
</body>
<script>
    document.getElementById('imageUpload').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const imgData = reader.result;
                const uploadLabel = document.querySelector('.upload-label');
                uploadLabel.style.backgroundImage = `url('${imgData}')`;
                uploadLabel.style.backgroundSize = 'cover';
                uploadLabel.style.backgroundPosition = 'center';
                // Hide the <i> tag
                uploadLabel.querySelector('i').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    //Display new image on selecting upon the existing
    function displayImage(input) {
        var label = input.previousElementSibling;
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            // If label contains an image, replace it with the new image
            if (label.querySelector('img')) {
                label.querySelector('img').src = e.target.result;
            } else { // Otherwise, create a new image element and append it to the label
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Selected Image";
                img.style.maxWidth = "100%";
                img.style.maxHeight = "100%";
                img.style.cursor = "pointer";
                label.appendChild(img);
            }
        };

        reader.readAsDataURL(file);
    }

    // JavaScript function to open the notification popup
    function openNotification() {
        document.getElementById("notificationPopup").style.display = "block";
        document.getElementById("blur-background").style.display = "block"; // Display background overlay
    }

    // JavaScript function to close the notification popup
    function closeNotification() {
        document.getElementById("notificationPopup").style.display = "none";
        document.getElementById("blur-background").style.display = "none"; // Hide background overlay
    }

    // JavaScript function to handle the Delete Account button click
    function confirmDelete(id) {
        // Redirect to a PHP script to handle account deletion
        window.location.href = 'delete_organization_generaluserdetails.php?id=' + id;
    }

    // Add event listener to ensure the notification popup stays open until user interaction
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButton = document.querySelector('.delete');
        var notificationPopup = document.getElementById('notificationPopup');

        deleteButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevents the default form submission behavior
            openNotification();
        });

        notificationPopup.addEventListener('click', function (event) {
            // Close the notification popup if user clicks outside of it or on "No"
            if (event.target === notificationPopup || event.target.classList.contains('no-button')) {
                closeNotification();
            }
        });
    });

</script>

</html>