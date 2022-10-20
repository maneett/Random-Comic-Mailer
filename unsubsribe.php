<?php
require_once 'config-db.php';

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $conn = OpenCon();
    $sql = "DELETE FROM subscribers WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        die ("query unsuccessfull");} 

    // if (mysqli_num_rows($result) > 0) {
    //     echo "yoo";
    // }
    CloseCon($conn);
}
?>