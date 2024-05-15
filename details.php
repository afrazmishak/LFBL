<?php
//Include the database connection
include("./system/config/dbconnection.php");

$sql = "SELECT * FROM foodbankdetails";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFBL</title>
    <link rel="stylesheet" href="./details.css">
</head>

<body>
    <main class="table">
        <section class="tableheader">
            <h1>Food Bank Information</h1>
        </section>
        <section class="tablebody">
            <table>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Bank</th>
                            <th>Incharge</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Postal Code</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $ranking = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <?php echo $ranking++; ?>
                                </td>

                                <td>
                                    <img src="<?php echo $row['imagelocation']; ?>">
                                    <span>
                                        <?php echo $row['bankname']; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo $row['incharge']; ?>
                                </td>
                                <td>
                                    <?php echo $row['contactnumber']; ?>
                                </td>
                                <td>
                                    <?php echo $row['location_address']; ?>
                                </td>
                                <td>
                                    <?php echo $row['postalcode']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </section>
    </main>
</body>

</html>