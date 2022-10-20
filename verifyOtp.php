<?php
require_once 'config-db.php';
require_once './utilFunctions.php';
if(isset($_POST["otp"]) && isset($_POST["email"])){
    $otp = $_POST["otp"];
    $email = $_POST["email"];
    
    
    $conn = OpenCon();
    $sql = "SELECT OTP FROM subscribers WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die ("query unsuccessfull");} 

    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        $row = mysqli_fetch_assoc($result);
        while($row){
               if($otp == $row["OTP"]){
                $sql = "UPDATE subscribers SET is_activated = 1 
                WHERE OTP = $otp AND email = '$email'";
                // print_r((mysqli_fetch_assoc($result)));
                // echo $otp;
                // echo $email;
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    die( "error");
                }
                include './sendComic.php';
                // if (mysqli_num_rows($result) > 0){
                //     echo 'found';
                //     include './sendComic.php';
                // }else{
                //     returnResponse("no result found ",403);
                // }
               }else{
                returnResponse("wrong otp",401);
               }
        }
    }
    CloseCon($conn);
} else{
    returnResponse( 'something went wrong',500 );
}

?>