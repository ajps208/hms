<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    if(isset($_POST['update'])){
        $x=$_POST['admno'];
        $z=$_POST['status'];

        $query="update registration SET status='$z'
        WHERE admno='$x' ";
        $res=mysqli_query($mysqli,$query);
        if($res)
                {
                 echo "<script>alert('application verified');</script>";
                
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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <form method="POST" enctype="multipart/form-data">
                
              


                
                <div class="row">


                </div>

                
                <div class="row">

               
                
                <?php	
                 $id=$_GET["admno"];
                 $query = "SELECT userregistration.admno,userregistration.email, userregistration.name,registration.admno, registration.bedno, registration.roomno, registration.adv_recipt, registration.status 
                 FROM userregistration 
                 INNER JOIN registration 
                 ON userregistration.admno = registration.admno
                 WHERE userregistration.admno =$id ";
                
                 $res=mysqli_query($mysqli,$query);
                 $row=mysqli_fetch_assoc($res);
                 $a=$row['admno'];
                 $b=$row['name'];
                 $e=$row['bedno'];
                 $f=$row['roomno'];
                 $g=$row['adv_recipt'];
                 $m=$row['status'];
                 $v=$row['email'];
                 
            
                        ?>
                        
                              
                        <div class="col-sm-12 col-md-6 col-lg-12">
                            
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="<?php echo $v; ?>" class="form-control" readonly>
                            </div>
                  
            </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admission Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="admno" id="admno" value="<?php echo $a; ?>" class="form-control" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>
                        

                                        

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" value="<?php echo $b; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    
              
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bedno</h4>
                        
                                <div class="form-group">
                                        <input type="text" name="bed" id="bed" value="<?php echo $e; ?>" class="form-control" readonly >
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Roomno</h4>
                                <div class="form-group">
                                        <input type="text" name="room" id="room" value="<?php echo $f; ?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>
                   
                   
                   
                       
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Advance Recipt</h4>
                                        <div class="form-group">
                                        <td><a href="<?php echo $g; ?>">View </a></td>
                                            <!-- <input type="text" name="pincode" id="pincode" value=  class="form-control" placeholder="Enter Postal Code" readonly> -->
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
                                                
                    


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                            <form action="cc.php" method="get">
                            <td><a href="cc.php?mail=<?php echo $v;?>"><input type="button" class="btn btn-danger" value="Send Mail"></a></td>
                            </form>
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


</body>

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

</html>