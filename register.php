<?php
    session_start();
    include('./includes/dbconn.php');
    if(isset($_POST['submit']))
    {
    $admno=$_POST['admno'];
    $fname=$_POST['fname'];
    $course=$_POST['course'];
    $sem=$_POST['sem'];
    $contactno=$_POST['contact'];
    $emailid=$_POST['email'];
    $password=$_POST['password'];
    // $password = md5($password);
    $query="INSERT into userRegistration(admno,name,course,semester,contactNo,email,password) values(?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssssss',$admno,$fname,$course,$sem,$contactno,$emailid,$password);
    $stmt->execute();
    $_SESSION['admno']=$admno;
    $ui= $_SESSION['admno'];
        echo"<script>alert('Student has been Registered . $ui .!');</script>";
        header("location:index.html");
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
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="./assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="./assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
    function valid(){
        if(document.registration.password.value!= document.registration.cpassword.value)
    {
        alert("Password and Confirm Password does not match");
        document.registration.cpassword.focus();
        return false;
    }
        return true;
    }
    </script>
    
</head>

<body class="d-flex justify-content-center">
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
        <!-- <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header> -->
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- <aside class="left-sidebar" data-sidebarbg="skin6">
            Sidebar scroll
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            End Sidebar scroll
        </aside> -->
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper ">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Registration Form</h4>
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

                <form method="POST" name="registration" onSubmit="return valid();">

                    <div class="row">



                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admission Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="admno" placeholder="Enter Admission Number" id="admno" class="form-control" required>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" placeholder="Enter Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        
                        <div class="col-sm-12 col-md-6 col-lg-">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Course</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="course" name="course" required="required">
                                                <option selected>Choose...</option>
                                                <option >Bsc Computer Science</option>
                                                <option>Bsc Maths</option>
                                                <option>Bsc Statistics</option>
                                                <option>Bsc Psychology</option>
                                                <option>Bcom</option>
                                                <option >BBA</option>
                                                <option>Ba History</option>
                                                <option>Ba English</option>
                                                <option>Ba Economics</option>
                                                <option>Mcom</option>
                                                <option>Ma History</option>
                                                <option>Ma English</option>
                                                <option>Ma Economics</option>
                                                <option>Msc Psychology</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Semester</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="sem" name="sem" required="required">
                                                <option selected>Choose...</option>
                                                <option >1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
<!-- 
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gender</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="gender" name="gender" required="required">
                                                <option selected>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div> -->


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="contact" id="contact" placeholder="Your Contact" pattern="[789][0-9]{9}" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email ID</h4>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Your Email" onBlur="checkAvailability()" required="required" class="form-control">
                                            <span id="user-availability-status" style="font-size:12px;"></span>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Enter Password(Minimum 8 characters)"  minlength="8"  required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Confirm Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirmation Password"  required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>



                    </div>
                

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Register</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
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
            <?php include './includes/footer.php' ?>
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
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="./dist/js/app-style-switcher.js"></script>
    <script src="./dist/js/feather.min.js"></script>
    <script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="./dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="./dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="./assets/extra-libs/c3/d3.min.js"></script>
    <script src="./assets/extra-libs/c3/c3.min.js"></script>
    <script src="./assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="./assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="./dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- customs -->
    <!-- <script>
    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'emailid='+$("#email").val(),
        type: "POST",
        success:function(data){
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
            },
                error:function ()
            {
                event.preventDefault();
                alert('error');
            }
        });
    }
    </script> -->
</body>

</html>