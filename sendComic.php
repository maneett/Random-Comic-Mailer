<?php
require_once 'config-db.php';
require_once './utilFunctions.php';
// if (!isset($_SERVER['SERVER_NAME']) || !isset($_SERVER['HTTP_HOST'])) {
//     die('Server error.');
// }
$conn = OpenCon();
$sql = "SELECT email FROM `subscribers` WHERE is_activated = 1";
$result = mysqli_query($conn, $sql);
$res = (mysqli_fetch_array($result,MYSQLI_ASSOC));


if(!$result){
    die ("query unsuccessfull");
} 

if (mysqli_num_rows($result) > 0) {
    // while($row = mysqli_fetch_assoc($result)){
        // $subscribers = mysqli_fetch_array($result);

$no = rand(1, 2561);
$url = 'https://xkcd.com/' . $no . '/info.0.json';

// requesting the web server for JSON data
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);

// extracting data
$data = json_decode($result, true);
$img = $data['img'];
$title = $data['safe_title'];

// printing the comic to the browser
echo '<img src="' . $img . '" alt="' . $title . '" />';

// sending the comic over the email
$subject = 'Random XKCD Comics';
$header = "From: XKCD-Comic-Mailer <dope.godfather@gmail.com>\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=ISO-8859-1\r\n";

foreach ($res as $user) {
    // adding unsubscribe_token to the message
    $message = '<h3>' . $title . '</h3><br>';
    $message .= '<img src="' . $img . '" alt="' . $title . '"><br><br>';
    $message .= 'Click here to <a href="http://' 
    . $_SERVER['HTTP_HOST'] . '/php-maneett' . '/unsubsribe.php?email='. $user . '">unsubscribe</a>.';

    mail($user, $subject, $message, $header);
}
    // }
CloseCon($conn);

}else{
    returnResponse("no email is activated",404);
}
?>