<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header("Location: signin-signup_users.php");
    exit();
}

//Include the database connection
include ("./system/config/dbconnection.php");

// Fetch the profile image URL and firstname for the logged-in user
$email = $_SESSION['email'];
$query = "SELECT general_users.id, general_userdetails.firstname, general_userdetails.lastname, general_userdetails.imagelocation
FROM general_users 
JOIN general_userdetails ON general_users.id = general_userdetails.general_user_id
WHERE general_users.email='$email'";

$result = mysqli_query($conn, $query);

// Check if the query was successful and if data was found
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imagelocation = $row['imagelocation'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $fullname = $firstname . " " . $lastname;

    // Check if imagelocation is empty
    if (empty($imagelocation)) {
        // Assign the URL of the default image
        $imagelocation = "./images/default_profile.jpg";
    }
} else {
    $imagelocation = "./images/default_profile.jpg";
}

$sqltwo = "SELECT * FROM foodbankdetails";
$resulttwo = mysqli_query($conn, $sqltwo);

// Update the latest login time for the user
$update_query = "UPDATE general_users SET last_login_time = CURRENT_TIMESTAMP WHERE email = '$email'";
mysqli_query($conn, $update_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFBL | Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            background-color: #e5e7eb;
            position: relative;
            display: flex;
            overflow-y: scroll;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        #menu {
            background: #111827;
            width: 300px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
        }

        #menu .logo {
            display: flex;
            align-items: center;
            color: #fff;
            padding: 20px 0 0 30px;
        }

        #menu .logo img {
            height: 50px;
        }

        #menu .items {
            margin-top: 40px;
        }

        #menu .items li {
            list-style-type: none;
            padding: 15px 0;
            transition: 0.4s ease;
        }

        #menu .items li:hover {
            background: #253047;
            cursor: pointer;
        }

        #menu .items li i {
            color: #fff;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            font-size: 18px;
            margin: 0 10px 0 25px;
        }

        #menu .items li:hover i,
        #menu .items li:hover a {
            color: #f3f4f6;
        }

        #menu .items li a {
            text-decoration: none;
            color: #fff;
            font-weight: 300px;
            transition: 0.4s ease;
        }

        #interface {
            width: calc(100% - 300px);
            margin-left: 300px;
            position: relative;
        }

        #interface .navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 15px 30px;
            border-bottom: 3px solid #111827;
            position: fixed;
            width: calc(100% - 300px);
        }

        #interface .navigation .search {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 8px 16px;
            border: 1px solid #d7dbe6;
            border-radius: 4px;
        }

        #interface .navigation .search i {
            margin-right: 10px;
            font-size: 16px;
        }

        #interface .navigation .search input {
            border: none;
            outline: none;
            font-size: 14px;
        }

        #interface .navigation .profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #interface .navigation .profile i {
            margin-top: 5px;
            margin-right: 30px;
            font-size: 24px;
            font-weight: 400;
            cursor: pointer;
        }

        #interface .navigation .profile img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #000;
            cursor: pointer;
        }

        .navigation_one {
            display: flex;
            justify-content: flex-start;
            align-items: center;

        }

        #menu_button {
            display: none;
            color: #2b2b2b;
            font-size: 22px;
            cursor: pointer;
            margin-right: 20px;
        }

        .i_name {
            color: #444a53;
            padding: 30px 30px 0 30px;
            font-size: 24px;
            font-weight: 700;
            margin-top: 70px;
        }

        .values {
            padding: 30px 30px 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .values .value_box {
            background: #fff;
            width: 230px;
            padding: 16px 20px;
            border-radius: 5px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 15px;
        }

        .values .value_box i {
            font-size: 26px;
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 50%;
            text-align: center;
            color: #fff;
            margin-right: 15px;
        }

        .values .value_box:nth-child(even) i {
            background: #585a5e;
        }

        .values .value_box:nth-child(odd) i {
            background: #111827;
        }

        .values .value_box h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .values .value_box span {
            font-size: 15px;
            color: #828997;
        }

        .board {
            width: 96%;
            margin: 30px 0 30px 30px;
            overflow: auto;
            background: #fff;
            border-radius: 8px;
        }

        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px solid #eef0f3;
        }

        thead td {
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 500;
            background: #f9fafb;
            text-align: center;
            padding: 15px;
        }

        tbody tr td {
            padding: 12px;
            text-align: center;
        }

        .board img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }

        .board h5 {
            font-weight: 600;
            font-size: 14px;
        }

        .board p {
            font-weight: 400;
            font-size: 16px;
        }

        .board .people {
            color: #787d8d;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .board .description p {
            align-items: start;
            margin-left: 5px;
        }

        .active p {
            font-size: 15px;
            background: #d7fada;
            padding: 2px 10px;
            display: inline-block;
            border-radius: 40px;
            color: #2b2b2b;
        }

        .role p {
            font-size: 15px;
        }

        .edit a {
            text-decoration: none;
            font-size: 14px;
            color: #b3b5b8;
            font-weight: 600;
        }

        .edit a:hover {
            color: #585a5e;
            transition: 0.2s ease;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100% auto;
            overflow: none;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            width: 350px;
            height: 350px;
            border-radius: 20px;
            text-align: center;
            margin: 15% auto;
            position: relative;
        }

        .profile-pic {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin-top: 30px;
        }

        .modal-content p {
            font-size: 20px;
            font-weight: 600;
        }

        .modal-content a {
            display: block;
            margin-top: 20px;
            margin-bottom: 20px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 32px;
            font-weight: 600;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }

        .details-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid black;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .details-box h3{
            font-size: 20px;
        }

        .details-box hr{
            margin-bottom: 15px;
        }

        .details-box p{
            font-size: 18px;
            font-weight: 500;
        }

        .details-box.active {
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .details-box button {
            width: 100%;
            margin-top: 20px;
            padding: 10px 0;
            background: linear-gradient(270deg, #06142e, #000000);
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
        }

        .details-box button:hover {
            width: 100%;
            padding: 10px 0;
            background: linear-gradient(270deg, #000000, #06142e);
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
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

        @media (max-width: 768px) {
            #menu {
                width: 270px;
                position: fixed;
                left: -270px;
                transition: 0.5s ease;
            }

            #menu.active {
                left: 0px;
            }

            #menu_button {
                display: initial;
            }

            #interface {
                width: 100%;
                margin-left: 0px;
                display: inline-block;
                transition: 0.5s ease;
            }

            #menu.active~#interface {
                width: calc(100% - 270px);
                margin-left: 270px;
                transition: 0.5s ease;
            }

            #interface .navigation {
                width: 100%;
            }

            .values {
                justify-content: space-evenly;
            }

            .values .value_box {
                margin: 0 10px 10px 10px;
            }

            .board {
                width: 92%;
                padding: 0;
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }
        }
    </style>
</head>

<body>
    <section id="menu">
        <div class="logo">
            <img src="./images/Logo Files/For Web/png/White logo - no background.png" alt="">
        </div>

        <div class="items">
            <li><a href="#"><i class='bx bxs-pie-chart-alt-2'></i>Home</a></li>
        </div>
    </section>

    <section id="interface">
        <div class="navigation">
            <div class="navigation_one">
                <div>
                    <i class='bx bx-menu' id="menu_button"></i>
                </div>

                <div class="search">
                    <i class='bx bx-search'></i>
                    <input type="text" id="searchInput" placeholder="Search">
                </div>
            </div>

            <div class="profile">
                <i class='bx bx-bell'></i>
                <img src="<?php echo $imagelocation; ?>" id="profile_img">
            </div>
        </div>

        <div class="modal" id="profile_modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img src="<?php echo $imagelocation; ?>" class="profile-pic">
                <?php if (isset($fullname) && !empty($fullname)): ?>
                    <p><?php echo $fullname; ?></p>
                <?php endif; ?>
                <a href="./generaluserdetails.php" id="edit_profile">Edit Profile</a>
                <a href="#" id="change_password">Change Password</a>
                <a href="./logout_users.php" id="logout">Logout</a>
            </div>
        </div>

        <h3 class="i_name">Dashboard</h3>

        <div class="values">
            <div class="value_box">
                <i class='bx bxs-user-detail'></i>
                <div>
                    <h3>8,267</h3>
                    <span>New Users</span>
                </div>
            </div>
        </div>

        <dir class="board">
            <table width="100%" id="dataTable">
                <?php if (mysqli_num_rows($resulttwo) > 0) { ?>
                    <thead>
                        <tr>
                            <td>Bank</td>
                            <td>Incharger</td>
                            <td>City</td>
                            <td>Postal Code</td>
                            <td>Contact Number</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($resulttwo)) { ?>
                            <tr>
                                <td class="people">
                                    <img src="<?php echo $row['imagelocation']; ?>">
                                    <div class="people-details">
                                        <p>
                                            <?php echo $row['bankname']; ?>
                                        </p>
                                    </div>
                                </td>

                                <td class="description">
                                    <?php echo $row['incharger']; ?>
                                </td>

                                <td class="description">
                                    <p>
                                        <?php echo $row['city']; ?>
                                    </p>
                                </td>

                                <td class="description">
                                    <p>
                                        <?php echo $row['postalcode']; ?>
                                    </p>
                                </td>

                                <td class="description">
                                    <p><?php echo $row['contactnumber']; ?></p>
                                </td>

                                <td class="edit">
                                    <a href="" class="view-more-link">View More</a>
                                    <div class="details-box">
                                        <h3><?php echo $row['bankname']; ?></h3><br>
                                        <hr>
                                        <p>Incharger: <?php echo $row['incharger']; ?></p>
                                        <p>Contact Number: <?php echo $row['contactnumber']; ?></p>
                                        <p>Location: <?php echo $row['location_address']; ?></p>
                                        <p>City: <?php echo $row['city']; ?></p>
                                        <p>Postal Code: <?php echo $row['postalcode']; ?></p>
                                        <button type="button" onclick="closePopup();">Close</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </dir>
    </section>
    <div class="blur-background" id="blur-background"></div>
</body>

<script>
    $('#menu_button').click(function () {
        $('#menu').toggleClass("active");
    })

    document.getElementById("profile_img").addEventListener("click", function () {
        document.getElementById("profile_modal").style.display = "block";
        document.body.style.overflow = "hidden"; // stop background scrolling
    });

    document.getElementById("logout").addEventListener("click", function () {
        // Perform logout action here
    });

    document.getElementById("change_password").addEventListener("click", function () {
        // Perform change password action here
    });

    document.getElementsByClassName("close")[0].addEventListener("click", function () {
        document.getElementById("profile_modal").style.display = "none";
        document.body.style.overflow = "auto"; // revert background scrolling
    });

    // Get references to the search input and the table body
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector('#dataTable tbody');

    // Function to filter table rows based on user input
    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            const city = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const postalCode = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            if (city.includes(searchValue) || postalCode.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Add event listener for input events on the search input
    searchInput.addEventListener('input', filterTable);

    // Get all view more links
    const viewMoreLinks = document.querySelectorAll('.view-more-link');

    // Add click event listeners to each link
    viewMoreLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Hide all other details boxes
            document.querySelectorAll('.details-box').forEach(box => {
                if (box !== link.nextElementSibling) {
                    box.style.display = 'none';
                }
            });

            // Toggle visibility of the associated details box
            const detailsBox = link.nextElementSibling;
            detailsBox.style.display = (detailsBox.style.display === 'block') ? 'none' : 'block';

            // Get the blur background element
            const blurBackground = document.getElementById('blur-background');

            // Toggle blur background
            blurBackground.style.display = (detailsBox.style.display === 'block') ? 'block' : 'none';
        });
    });

    // Function to close the details box
    function closePopup() {
        // Hide the details box
        const detailsBoxes = document.querySelectorAll('.details-box');
        detailsBoxes.forEach(box => {
            box.style.display = 'none';
        });

        // Hide the blur background
        const blurBackground = document.getElementById('blur-background');
        blurBackground.style.display = 'none';
    }

</script>

</html>