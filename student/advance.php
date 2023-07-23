<?php
    session_start();
    include('../includes/dbconn.php');
    date_default_timezone_set('America/Chicago');
    include('../includes/check-login.php');
    check_login();
   
    if(isset($_POST['update'])){
        $aid=$_POST['id'];
        $image = $_FILES["photo"]["name"];
        $image_tmp = $_FILES["photo"]["tmp_name"];
        $folder="../advance/".$image;
        move_uploaded_file($image_tmp,$folder);
        

        $query="update registration SET adv_recipt='$folder'
        WHERE admno='$aid' ";
        $res=mysqli_query($mysqli,$query);
        if($res)
                {
                 echo "<script>alert('Leave application verified');</script>";
                
                 }
  
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

    <!-- <script type="text/javascript">
    function valid(){
        if(document.registration.password.value!= document.registration.cpassword.value){
            alert("Password and Re-Type Password Field do not match !!");
            document.registration.cpassword.focus();
        return false;
            } return true;
     }
    </script> -->
    
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
            <?php include '../includes/student-navigation.php'?> 
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
                <?php include '../includes/student-sidebar.php'?>
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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Profile</h4>
                </div>


                <div class="row">

                    <?php	
                    $kid=$_SESSION['id'];
                        $ret="select * from userregistration where id=?";
                            $stmt= $mysqli->prepare($ret) ;
                        $stmt->bind_param('i',$kid);
                        $stmt->execute() ;//ok
                        $res=$stmt->get_result();
                        //$cnt=1;
                        while($row=$res->fetch_object())
                        {
                            ?>
    


                </div>
                
                    
                    <form name="registration" onSubmit="return valid();" method="POST" enctype="multipart/form-data">

                    <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-12">
                            
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="<?php echo  $row->admno; ?>" class="form-control" readonly>
                                        </div>
                              
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">First Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $row->name;?>"   required="required">
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Advance Recipt</h4>
                                    <div class="form-group">
                                        <input type="file" name="photo" id="photo" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>



                        <?php } ?>
                    
                    </div>

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-success">Make Changes</button>
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
</body>

</html>