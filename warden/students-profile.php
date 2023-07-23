<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    $id=$_SESSION['admno'];
    $quer="select * from userregistration where admno='$id' ";
    $re=mysqli_query($mysqli,$quer);
    $ro=mysqli_fetch_assoc($re);
    $fname=$ro['name'];
     $dep=$ro['course'];
     $sem=$ro['semester'];
     $ano=$ro['admno'];
     $email=$ro['email'];
     $cno=$ro['contactNo'];
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Details About My Booked Room</h4>
                </div>



                <!--Table Column -->
                
                 <div class="card">
                 
                   <div class="card-body">
                   
                      <div class="row">
                      
                      <div class="table-responsive">
                                

                                    <table id="zctb" class="table table-striped table-bordered no-wrap">

                                        <tbody>

                                        <?php	

                                        $kid=$_GET['admno'];

                                        $ret = "SELECT b.admno, b.dob, b.age, b.caste, b.gender, b.food, b.local_gname, b.local_grelation, 
                                        b.local_phone, b.address, b.pincode, b.district, b.distance, b.photo, b.idcard, 
                                        b.c_certificate, a.bedno, a.roomno, a.stayfrom, a.roomtype, a.atp, a.postingDate 
                                        FROM registration a 
                                        INNER JOIN book_hostel b ON a.admno = b.admno 
                                        WHERE a.admno=?";
                                        $stmt= $mysqli->prepare($ret) ;
                                        $stmt->bind_param('i',$kid);
                                        $stmt->execute() ;//ok
                                        $res=$stmt->get_result();
                                                                                //$cnt=1;
                                         while($row=$res->fetch_object())
                                        {
                                                ?>
                                        

                                            <tr>
                                                <td colspan="3"><b>Date & Time of Registration: <?php echo $row->postingDate;?></b></td>
                                                
                                            </tr>

                                            <tr>
                                            <td><b>Admission Number :</b></td>
                                            <td><?php echo $row->admno;?></td>
                                            <td><b>Full Name :</b></td>
                                            <td><?php echo $fname;?></td>
                                            <td><b>Email Address:</b></td>
                                            <td><?php echo $email;?></td> 
                                            </tr>


                                            <tr>
                                            <td><b>Contact Number :</b></td>
                                            <td><?php echo $cno;?></td>
                                            <td><b>Gender :</b></td>
                                            <td><?php echo $row->gender;?></td>
                                            <td><b>Selected Course :</b></td>
                                            <td><?php echo $dep;?></td>
                                            </tr>


                                            <tr>
                                            
                                            <td><b>Guardian Name :</b></td>
                                            <td><?php echo $row->local_gname;?></td>
                                            <td><b>Guardian Relation :</b></td>
                                            <td><?php echo $row->local_grelation;?></td>
                                            </tr>

                                            <tr>
                                            <td><b>Guardian Contact No. :</b></td>
                                            <td colspan="6"><?php echo $row->local_phone;?></td>
                                            </tr>

                                            <tr>
                                            <td><b>Current Address:</b></td>
                                            <td colspan="2">
                                            <?php echo $row->address;?><br />
                                            </td>
                                                

                                            </td>
                                            </tr>

                                            <tr>

                                            <td><b>Room No :</b></td>
                                            <td><?php echo $row->roomno;?></td>
                                            <td><b>Bed No :</b></td>
                                            <td><?php echo $row->bedno;?></td>


                                            <td><b>Starting Date :</b></td>
                                            <td><?php echo $row->stayfrom;?></td>

                                            

                                            </tr>

                                            <tr>

                                            <td><b>Food Status:</b></td>
                                            <td>
                                            <?php echo $row->food;?>
                                            </td>
                                            <tr>

                                            <td><b>college id:</b></td>
                                            <td><a href="<?php echo $row->idcard;?>">view</a></td>
                                            <td><b>Photo:</b></td>
                                            <td><a href="<?php echo $row->photo;?>">view</a></td>
                                            

                                            </tr>

                                            


                                            


                                            <?php } ?>

                                        </tbody>
                                        </table>

                                   
                                </div>
                      
                      
                      </div>
                   
                   
                   </div>
                 
                 
                 </div>

                <!-- Table column end -->

    
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
</body>

</html>