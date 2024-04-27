<?php 

require '../dbh.inc.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result); 
}
else{
    header("Location: ./Login/login.php");
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['notify'])){
    $query = mysqli_query($conn,"SELECT * FROM accounts WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);
    $usermail = $row['email'];
    $authormail = $_POST['email'];
    $pdtname = $_POST['pdtname'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


//Load Composer's autoloader
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $usermail;                     //SMTP username
    $mail->Password   = 'rfsj yfez twfk pgdk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($usermail,'Mailer');
    $mail->addAddress($authormail, 'Joe User');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Interested in your product '. $pdtname;
    $mail->Body    = 'This email finds you in great interest in your product '.$pdtname;

    $mail->send();
    echo "<script>
    window.location.href = '../home.php';
    alert('Message has been sent');
    </script>";
} catch (Exception $e) {
    echo "<script>
    window.location.href = '../home.php';
    alert('Message could not be sent');
    </script>";
}
}
?>