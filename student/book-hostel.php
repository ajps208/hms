<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    if(isset($_POST['submit'])){
        $uid=$_SESSION['id'];
        $ano=$_POST['admno'];
        $dob=$_POST['dob'];
        $age=$_POST['age']; 
        $caste=$_POST['caste'];
        $gender=$_POST['sex'];
        $food=$_POST['food'];
        $gname=$_POST['gname'];
        $grel=$_POST['grelation'];
        $gcon=$_POST['gcontact'];
        $addr=$_POST['address'];
        $pin=$_POST['pincode'];
        $district=$_POST['district'];
        $dist=$_POST['distance'];
        $image = $_FILES["photo"]["name"];
        $image_tmp = $_FILES["photo"]["tmp_name"];
        $folder="../photo/".$image;
        move_uploaded_file($image_tmp,$folder);
        $idcard = $_FILES["idcard"]["name"];
        $id_tmp = $_FILES["idcard"]["tmp_name"];
        $folder1="../idcard/".$idcard;
        move_uploaded_file($id_tmp,$folder1);
        $cc = $_FILES["cc"]["name"];
        $cc_tmp = $_FILES["cc"]["tmp_name"];
        $folder2="../caste/".$cc;
        move_uploaded_file($cc_tmp,$folder2);
        // $_SESSION['admno']=$admno;

        
  $query="insert into book_hostel(admno,dob,age,caste,gender,food,local_gname,local_grelation,local_phone,address,pincode,district,distance,photo,idcard,c_certificate) values('$ano','$dob','$age','$caste','$gender','$food','$gname','$grel','$gcon','$addr','$pin','$district','$dist','$folder','$folder1','$folder2')";
  
  $result=mysqli_query($mysqli,$query);
  if($result)
  {
    echo "<script>alert('Hostel Requested!')</script>";
    // echo "<script>window.location.href='dashboard.php'</script>";
  }else{
    echo "<script>alert('Hostel Request failed!')</script>";
    echo "<script>window.location.href='dashboard.php'</script>";
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

    <!-- <script>
    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'roomid='+val,
        success: function(data){
        //alert(data);
        $('#seater').val(data);
        }
        });

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#fpm').val(data);
        }
        });
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
                
                <form method="POST" enctype="multipart/form-data">
                <?php
                    $uid=$_SESSION['admno'];
                    $stmt=$mysqli->prepare("SELECT admno FROM book_hostel WHERE admno=? ");
                    $stmt->bind_param('i',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($admno);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($rs){ ?>
                 	<h3 style="color: red" align="center">Hostel already booked by you</h3>
			<div align="center">
				<div class="col-md-4">&nbsp;</div>
			<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

												<div class="stat-panel-number h1 ">My Room</div>
													
												</div>
											</div>
											<a href="room-details.php" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
                    <?php }
                    else{
						
							
				?>	



                <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Hostel Bookings</h4>
                    </div>

                
                <div class="row">


                  
                </div>

                <h4 class="card-title mt-5">Student's Personal Information</h4>

                <div class="row">

                <?php	
                $aid=$_SESSION['id'];
                    $ret="select * from userregistration where id=?";
                        $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('i',$aid);
                    $stmt->execute();
                    $res=$stmt->get_result();

                    while($row=$res->fetch_object())
                    {
                        ?>
                 
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admission Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="admno" id="admno" value="<?php echo $row->admno;?>" class="form-control" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" value="<?php echo $row->name;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Course</h4>
                        
                                <div class="form-group">
                                        <input type="text" name="course" id="course" value="<?php echo $row->course;?>" class="form-control" readonly>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Semester</h4>
                                <div class="form-group">
                                        <input type="text" name="sem" id="sem" value="<?php echo $row->semester;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" value="<?php echo $row->email;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                   
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sex</h4>
                                <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="sex" name="sex">
                                            <option selected>Please Select...</option>
                                            <option >Male</option>
                                            <option>Female</option>
                                           
                                          
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="contact" id="contact" value="<?php echo $row->contactNo;?>" class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <?php }?>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Birth Date</h4>
                                    <div class="form-group">
                                        <input type="date" name="dob" id="dob" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Age</h4>
                                    <div class="form-group">
                                        <input type="text" name="age" id="age" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Caste</h4>
                                <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="caste" name="caste">
                                            <option selected>Please Select...</option>
                                            <option >SC</option>
                                            <option>ST</option>
                                            <option>OEC</option>
                                            <option>OBC</option>
                                            <option>GENERAL</option>
                                            <option>OTHERES</option>
                                                                
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Food</h4>
                                <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="food" name="food">
                                            <option selected>Please Select...</option>
                                            <option >Veg</option>
                                            <option>Non Veg</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Distance To College</h4>
                                    <div class="form-group">
                                        <input type="text" name="distance" id="distance" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Photo</h4>
                                    <div class="form-group">
                                        <input type="file" name="photo" id="photo" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">College Id<small> (upload pdf file)</small></h4>
                                    <div class="form-group">
                                        <input type="file" name="idcard"  id="idcard" accept=".pdf" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Caste Certificate<small> (upload pdf file)</small></h4>
                                    <div class="form-group">
                                        <input type="file" name="cc" id="cc" accept=".pdf" class="form-control" required>
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
                                            <input type="text" name="gname" id="gname" class="form-control" placeholder="Enter Guardian's Name" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Relation</h4>
                                        <div class="form-group">
                                            <input type="text" name="grelation" id="grelation" required class="form-control" placeholder="Student's Relation with Guardian">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="gcontact" id="gcontact" pattern="[789][0-9]{9}" required class="form-control" placeholder="Enter Guardian's Contact No.">
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
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">District</h4>
                                        <div class="form-group">
                                            <input type="text" name="district" id="district" class="form-control" placeholder="Enter City Name" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Postal Code</h4>
                                        <div class="form-group">
                                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter Postal Code" required>
                                        </div>
                                </div>
                            </div>
                        </div>

                    
                    </div>

                    
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="column">
                      <div class="input-box">
                        <label><b>Declaration</b></label><br>
                        <span>i declare that i have read the rules of the hostel and do hereby promise to abide by them and rules as may be promulgated from time to time.</span>&nbsp;
                        <input type="checkbox" name="declare"  required/>
                      </div>

                    </div>
                                                
                    


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>

                
                </form>
                <?php } ?>   
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