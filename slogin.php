<?php
    session_start();
    include('includes/dbconn.php');
  
    include('includes/check-login.php');
    include('includes/Exception.php');
    include('includes/PHPMailer.php');
    include('includes/SMTP.php');
    
    
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
    if(isset($_POST['login']))
    {
    $email=$_POST['email'];
    $password=$_POST['password'];
    // $password = md5($password);
    $stmt=$mysqli->prepare("SELECT email,password,id,admno  FROM userregistration WHERE email=? and password=? ");
        $stmt->bind_param('ss',$email,$password);
        $stmt->execute();
        $stmt -> bind_result($email,$password,$id,$admno);
        $rs=$stmt->fetch();
         $stmt->close();
    
        $_SESSION['id']=$id;
        $_SESSION['login']=$email;
        $_SESSION['admno'] = $admno;
        $uip=$_SERVER['REMOTE_ADDR'];
        $ldate=date('d/m/Y h:i:s', time());
         if($rs){
            $uid=$_SESSION['id'];
            $uemail=$_SESSION['login'];
            $kk=$_SESSION['admno'];
        $ip=$_SERVER['REMOTE_ADDR'];
        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
        $city = $addrDetailsArr['geoplugin_city'];
        $country = $addrDetailsArr['geoplugin_countryName'];
        $log="insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
        $mysqli->query($log);
        if($log){
          
            header("location:student/dashboard.php");
                 }
        } else {
            echo "<script>alert('Sorry, Invalid Username/Email or Password!');</script>";
               }
   }
   if(isset($_POST['forgot'])) {
    // get the email entered by the user
    $email = $_POST['email'];
  
    // connect to the database
  
    // check if the email exists in the userregistration table
    $query = "SELECT * FROM userregistration WHERE email='$email'";
    $result = mysqli_query($mysqli,$query);
  
    if(mysqli_num_rows($result) == 1) {
      // generate a new password
      $newPassword = rand();
  
      // update the user's password in the userregistration table
      $updateQuery = "UPDATE userregistration SET password='$newPassword' WHERE email='$email'";
      mysqli_query($mysqli,$updateQuery);
      $mail = new PHPMailer();
        //Set mailer to use smtp
            $mail->isSMTP();
        //Define smtp host
            $mail->Host = "smtp.gmail.com";
        //Enable smtp authentication
            $mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
            $mail->SMTPSecure = "tls";
        //Port to connect smtp
            $mail->Port = "587";
        //Set gmail username
            $mail->Username = "gcthostelgcthostel789@gmail.com";
        //Set gmail password
            $mail->Password = "aivpikwikxkgqmyh";
        //Email subject
            $mail->Subject = "Test email using PHPMailer";
        //Set sender email
            $mail->setFrom('gcthostelgcthostel789@gmail.com');
        //Enable HTML
            $mail->isHTML(true);
        //Attachment
            $mail->addAttachment('img/attachment.png');
        //Email body
            $mail->Body = "Your new password is: ' . $newPassword";
        //Add recipient
            $mail->addAddress ($email);
        //Finally send email
            if ( $mail->send() ) {
                echo "Email Sent..!";
            }else{
                echo $mail->ErrorInfo;
            }
    //Closing smtp connection
        $mail->smtpClose();
       
  
    //   // send the new password to the user's email address
    //   $to = $email;
    //   $subject = 'New Password Generated';
    //   $message = 'Your new password is: ' . $newPassword;
    //   $headers = 'From: gcthostelgcthostel789@gmail.com' . "\r\n" .
    //   'Reply-To: gcthostelgcthostel789@gmail.com' . "\r\n" .
    //   'X-Mailer: PHP/' . phpversion();
  
    //   if(mail($to, $subject, $message, $headers)) {
    //     $_SESSION['success_message'] = 'A new password has been sent to your email address.';
    //   } else {
    //     $_SESSION['error_message'] = 'Failed to send a new password. Please try again later.';
    //   }
    // } else {
    //   $_SESSION['error_message'] = 'The email address does not exist in our database.';
    // }
  
    // close the database connection

  }}
?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
    function valid() {
    if(document.registration.password.value!= document.registration.cpassword.value){
        alert("Password and Re-Type Password Field do not match  !!");
    document.registration.cpassword.focus();
    return false;
        }
    return true;
        }
    </script>

</head>



<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/hostel1.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/big/login.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Student Login</h2>
                        
                        <form class="mt-4" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" name="email" id="uname" type="email"
                                            placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" name="password" id="pwd" type="password"
                                            placeholder="Enter your password" >
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12 text-center">
                                    <button type="submit" name="login" class="btn btn-block btn-dark">LOGIN</button>
                                    <button type="submit" name="forgot" class="btn btn-block btn-dark">Forget</button>
                                </div> -->
                                <div class="col-lg-12 form-actions">
                                 <div class="text-center">
                                    <button type="submit" name="login" class="btn btn-success"">LOGIN</button>
                                    <button type="submit" name="forgot" class="btn btn-dark">Forget</button>
                                  </div>
                               </div>
                               
                              
                            </div>
                      
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>