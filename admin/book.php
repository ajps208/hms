<?php
   
    session_start();
   
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    include('../includes/Exception.php');
    include('../includes/PHPMailer.php');
    include('../includes/SMTP.php');
    
    
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	

	
    
       $id=$_GET["admno"];
      
       $quer="select * from userregistration where admno='$id' ";
       $re=mysqli_query($mysqli,$quer);
       $ro=mysqli_fetch_assoc($re);
       $fname=$ro['name'];
        $dep=$ro['course'];
        $sem=$ro['semester'];
        $ano=$ro['admno'];
        $email=$ro['email'];
        $cno=$ro['contactNo'];


        $query="select * from book_hostel where admno='$id' ";
        $res=mysqli_query($mysqli,$query);
        $row=mysqli_fetch_assoc($res);
        $dob=$row['dob'];
        $age=$row['age'];
        $caste=$row['caste'];
        $sex=$row['gender'];
        $food=$row['food'];
        $gname=$row['local_gname'];
        $grel= $row['local_grelation'];
        $gcon=$row['local_phone'];
        $addr=$row['address'];
        $pin=$row['pincode'];
        $district=$row['district'];
        $dist=$row['distance'];
        $photo=$row['photo'];
        $idcard=$row['idcard'];
        $cc=$row['c_certificate'];
        
    // code for registration
    if(isset($_POST['submit'])){
        $bedno=$_POST['bed'];
        $roomno=$_POST['room_no'];
        $stayfrom=$_POST['stayf'];
        $roomtype=$_POST['rtype'];
        $atp=$_POST['ta'];
        $status=$_POST['status'];
        $admno=$_POST['admno'];
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
            $mail->Body = "hello ". $fname. "You have been admitted to Sree c achuthamenon govt kuttanellur College Host. You can check the room details by logging into the hostel website. You have to pay the advance fee within one week and produce the advance receipt in the website to confirm your admission otherwise your admission will be cancelled.";
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
       
        $query1="update book_hostel SET status='$status'
        WHERE admno='$admno' ";
        $res=mysqli_query($mysqli,$query1);
    
     
        $query="INSERT into  registration(admno,bedno,roomno,stayfrom,roomtype,atp,status) values(?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc=$stmt->bind_param('issssss',$admno,$bedno,$roomno,$stayfrom,$roomtype,$atp,$status);
        $stmt->execute();
        echo"<script>alert('Success: Booked!');</script>";
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script>
    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'bedid='+val,
        success: function(data){
        //alert(data);
        $('#room_no').val(data);
        }
        });

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#rtype').val(data);
        }
        });
    }
    </script>
    
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Hostel Bookings</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

            <form method="POST">
                
                <div class="row">


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bed No</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="bed" id="bed" onChange="getSeater(this.value);"  required id="inlineFormCustomSelect">
                                            <option selected>Select...</option>
                                            <?php $query = "SELECT bed_no FROM rooms WHERE bed_no NOT IN (SELECT bedno FROM registration)";
                                            $stmt2 = $mysqli->prepare($query);
                                            $stmt2->execute();
                                            $res=$stmt2->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                            ?>
                                            <option value="<?php echo $row->bed_no;?>"> <?php echo $row->bed_no;?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="room-availability-status" style="font-size:12px;"></span>
                                    </div>
                              
                            </div>
                        </div>
                    </div>

                
 
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Start Date</h4>
                                    <div class="form-group">
                                        <input type="date" name="stayf" id="stayf" class="form-control" required>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                   

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Room No</h4>
                                    <div class="form-group">
                                        <input type="text" id="room_no" name="room_no" placeholder="Enter Seater No." required class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Room Type</h4>
                                    <div class="form-group">
                                        <input type="text" name="rtype" id="rtype" placeholder="Your total fees" class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Advance to Pay</h4>
                                    <div class="form-group">
                                        <input type="text" name="ta"  id="ta" placeholder="Total Amount here.." required class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="status" name="status">
                                            <option selected>Please Select...</option>
                                            <option >Approved</option>
                                            <option>Advance Pending</option>
                                            <option>pending</option>
                                            <option>Rejected</option>


                                           
                                          
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>

                  
                
                </div>

                <h4 class="card-title mt-5">Student's Personal Information</h4>
               
                <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                <img src="<?php echo $photo; ?> " class="rounded-circle" style="width: 180px;"  alt="Avatar" />
                </div>
               
                                                                                                               
                

                
                <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admission Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="admno" id="admno" value="<?php echo $ano; ?> " class="form-control" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Application Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="uid" id="uid" value="<?php echo $kid; ?> " class="form-control" readonly>
                                        </div>
                                </div>
                            </div>
                        </div> -->


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" value="<?php echo $fname; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Course</h4>
                        
                                <div class="form-group">
                                        <input type="text" name="course" id="course" value="<?php echo $dep; ?> " class="form-control" readonly>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Semester</h4>
                                <div class="form-group">
                                        <input type="text" name="sem" id="sem" value="<?php echo $sem; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                   
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sex</h4>
                                <div class="form-group">
                                        <input type="email" name="sex" id="sex" value="<?php echo $sex; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="contact" id="contact" value="<?php echo $cno; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Birth Date</h4>
                                    <div class="form-group">
                                        <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Age</h4>
                                    <div class="form-group">
                                        <input type="text" name="age" id="age" value=<?php echo $age; ?> class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Caste</h4>
                                <div class="form-group">
                                        <input type="text" name="caste" id="caste" value=<?php echo $caste; ?> class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Food</h4>
                                <div class="form-group">
                                        <input type="text" name="food" id="food" value=<?php echo $food; ?>  class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Distance To College</h4>
                                    <div class="form-group">
                                        <input type="text" name="distance" id="distance" value=<?php echo $dist; ?> class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">College id</h4>
                                        <div class="form-group">
                                        <a href="<?php echo $idcard; ?>">View</a></td>
  
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Caste Certificate</h4>
                                        <div class="form-group">
                                        <td><a href="<?php echo $cc; ?>">View </a></td>
                                            <!-- <input type="text" name="pincode" id="pincode" value=  class="form-control" placeholder="Enter Postal Code" readonly> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                    



                              
                </div>

                <h4 class="card-title mt-5">Guardian's Information</h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Guardian Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="gname" id="gname" value=<?php echo $gname; ?> class="form-control" placeholder="Enter Guardian's Name" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Relation</h4>
                                        <div class="form-group">
                                            <input type="text" name="grelation" id="grelation"  value=<?php echo $grel; ?> required class="form-control" placeholder="Student's Relation with Guardian" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="gcontact" id="gcontact" value=<?php echo $gcon; ?>  required class="form-control" placeholder="Enter Guardian's Contact No." readonly>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <h4 class="card-title mt-5">Current Address Information</h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                        <div class="form-group">
                                            <input type="text" name="address" id="address" value=<?php echo $addr; ?> class="form-control" placeholder="Enter Address" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">District</h4>
                                        <div class="form-group">
                                            <input type="text" name="district" id="district" value=<?php echo $district; ?>  class="form-control" placeholder="Enter City Name" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Postal Code</h4>
                                        <div class="form-group">
                                            <input type="text" name="pincode" id="pincode" value=<?php echo $pin; ?>  class="form-control" placeholder="Enter Postal Code" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>
                       
                        
                    
                    
                    </div>

                    
                    
                    </div>
                  

                  



                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>

                
                </form>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- Custom Ft. Script Lines -->
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
    </script>
    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'roomno='+$("#room").val(),
        type: "POST",
        success:function(data){
            $("#room-availability-status").html(data);
            $("#loaderIcon").hide();
        },
            error:function (){}
            });
        }
    </script>


    <script type="text/javascript">

    $(document).ready(function() {
        $('#duration').keyup(function(){
            var fetch_dbid = $(this).val();
            $.ajax({
            type:'POST',
            url :"ins-amt.php?action=userid",
            data :{userinfo:fetch_dbid},
            success:function(data){
            $('.result').val(data);
            }
            });
            

    })});
    </script>

</body>

</html>