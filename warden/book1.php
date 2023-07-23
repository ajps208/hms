<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    //code for registration
    // if(isset($_POST['submit'])){
    //     $bedno=$_POST['bed'];
    //     $roomno=$_POST['room_no'];
    //     $stayfrom=$_POST['stayf'];
    //     $roomtype=$_POST['rtype'];
    //     $atp=$_POST['ta'];
    //     $admno=$_POST['admno'];
    //     $name=$_POST['name'];
    //     $course=$_POST['course'];
    //     $semester=$_POST['sem'];
    //     $email=$_POST['email'];
    //     $sex=$_POST['sex'];
    //     $contact=$_POST['contact'];
    //     $dob=$_POST['dob'];
    //     $age=$_POST['age'];
    //     $caste=$_POST['caste'];
    //     $food=$_POST['food'];
    //     $distance=$_POST['distance'];
    //     $gname=$_POST['gname'];
    //     $grelation=$_POST['grelation'];
    //     $gcontact=$_POST['gcontact'];
    //     $address=$_POST['address'];
    //     $district=$_POST['district'];
    //     $pincode=$_POST['pincode'];
    //     $photo=$_POST['photo'];
    //     $idcard=$_POST['idcard'];
    //     $cc=$_POST['cc'];
     
     
    //     $query="INSERT into  registration(bedno,roomno,stayfrom,roomtype,atp,admno,name,course,semester,email,sex,contact,dob,age,caste,food,distance,gname,grelation,gcontact,address,district,pincode,photo,idcard,cc) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    //     $stmt = $mysqli->prepare($query);
    //     $rc=$stmt->bind_param('ssssssssssssssssssssssssss',$bedno,$roomno,$stayfrom,$roomtype,$atp,$admno,$name,$course,$semester,$email,$sex,$contact,$dob,$age,$caste,$food,$distance,$gname,$grelation,$gcontact,$address,$district,$pincode,$photo,$idcard,$cc);
    //     $stmt->execute();
    //     echo"<script>alert('Success: Booked!');</script>";
    // }
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
                                        <select class="custom-select mr-sm-2" name="bed" id="bed" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            <option selected>Select...</option>
                                            <?php $query ="SELECT * FROM rooms";
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


                    <!-- <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Duration</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="duration" name="duration">
                                            <option selected>Choose...</option>
                                            <option value="1">One Month</option>
                                            <option value="2">Two Month</option>
                                            <option value="3">Three Month</option>
                                            <option value="4">Four Month</option>
                                            <option value="5">Five Month</option>
                                            <option value="6">Six Month</option>
                                            <option value="7">Seven Month</option>
                                            <option value="8">Eight Month</option>
                                            <option value="9">Nine Month</option>
                                            <option value="10">Ten Month</option>
                                            <option value="11">Eleven Month</option>
                                            <option value="12">Twelve Month</option>
                                        </select>
                                    </div>
                              
                            </div>
                        </div>
                    </div> -->
                    

                    <!-- <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">Food Status</h4>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" value="1" name="foodstatus"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Required <code>Extra $211 Per Month</code></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" value="0" name="foodstatus"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio2">Not Required</label>
                                </div>
                                
                            </div>
                        </div>
                    </div> -->


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
                  
                
                </div>

                <h4 class="card-title mt-5">Student's Personal Information</h4>

<div class="row">

    <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Admission Number</h4>
                        <div class="form-group">
                            <input type="text" name="admno" id="admno"  class="form-control" required>
                        </div>
                </div>
            </div>
        </div>


    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Name</h4>
                    <div class="form-group">
                        <input type="text" name="name" id="name"  class="form-control" required>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Course</h4>
        
                <div class="form-group">
                        <input type="text" name="course" id="course" class="form-control" required>
                    </div>
                    
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Semester</h4>
                <div class="form-group">
                        <input type="text" name="sem" id="sem"  class="form-control" required>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Email</h4>
                    <div class="form-group">
                        <input type="email" name="email" id="email"  class="form-control" required>
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
                        <input type="text" name="contact" id="contact"  class="form-control" required>
                    </div>
            </div>
        </div>
    </div>

   

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
                <h4 class="card-title">College Id</h4>
                    <div class="form-group">
                        <input type="file" name="idcard" id="idcard" class="form-control" required>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Caste Certificate</h4>
                    <div class="form-group">
                        <input type="file" name="cc" id="cc" class="form-control" required>
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
                            <input type="text" name="gcontact" id="gcontact" required class="form-control" placeholder="Enter Guardian's Contact No.">
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

<!-- 
    <h4 class="card-title mt-5">Permanent Address Information</h4>


    <div class="row">
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle"><code>Ignore this CHECK BOX if you have different permanent address</code> </h6>
                    <fieldset class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="adcheck"> My permanent address is same as above!
                        </label>
                    </fieldset>
                   
                </div>
            </div>
        </div>
        
    
    </div>

    
    <h5 class="card-title mt-5">Please fill up the form "ONLY IF" you've different permanent address!</h5>


    <div class="row">

    
    <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Address</h4>
                        <div class="form-group">
                            <input type="text" name="paddress" id="paddress" class="form-control" placeholder="Enter Address" required>
                        </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">District</h4>
                        <div class="form-group">
                            <input type="text" name="pdistrict" id="pdistrict" class="form-control" placeholder="Enter City Name" required>
                        </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Postal Code</h4>
                        <div class="form-group">
                            <input type="text" name="ppincode" id="ppincode" class="form-control" placeholder="Enter Postal Code" required>
                        </div>
                </div>
            </div>
        </div> -->
    
    
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