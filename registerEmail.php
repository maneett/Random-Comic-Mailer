<?php
require_once 'config-db.php';
require_once './utilFunctions.php';
    
if(isset($_POST['email'])){
    $email = $_POST['email']; 

    // validating email util function
    if ( !isValidEmail($email)) {
        // retruning response to client if email is invalid
        returnResponse( 'Enter Valid Email',402 );
        exit();
    }
    
    // otp generation
    $OTP = genetateOTP();
    
    $conn = OpenCon();

    $sql = "SELECT * FROM subscribers WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $error = "Email already exists";
            // retruning response to client if email already exists
            returnResponse($error,409);
        } else {
            // sending otp to user
            $sql = "INSERT INTO subscribers (email, is_activated, OTP) VALUES ( '{$email}', 0, $OTP)";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                die("query failed");
             }
           
            $to = $email;
            $subject = "OTP from XKCD comic mailer";
            
            $header = "From: XKCD-Comic-Mailer <dope.godfather@gmail.com>\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=ISO-8859-1\r\n";
            
            $message = "<html>
                <body>
                <h1>Enjoy Comic Every 5 Mins </h1>
                <br>
                <h3>Otp is: $OTP</h3>
                </body>
                </html> ";
            
            $retval = mail ($to,$subject,$message,$header);
            
            if( $retval == true ) {
               echo "Message sent successfully...";
            }else {
               echo "Message could not be sent...";
            }
 }
    CloseCon($conn);

}else{
    returnResponse( 'something went wrong',500 );
}
?>