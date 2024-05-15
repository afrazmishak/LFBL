<?php
//connect to database
$conn = mysqli_connect('localhost', 'root', '', 'lfbl');

//check connection
if(!$conn){
    echo 'Connection error :'. mysqli_connect_error();
}
?>