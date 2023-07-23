<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();


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
     <!-- This page plugin CSS -->
     <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script language="javascript" type="text/javascript">
    var popUpWin=0;
    function popUpWindow(URLStr, left, top, width, height){
        if(popUpWin) {
         if(!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Attendence details</h4>
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
    <div class="row">
        <div class="col-12">
            <form method="POST">
                <label for="month">Select Month:</label>
                <select id="month" name="month">
                    <?php 
                        for ($i=1; $i<=12; $i++) {
                            $month = date("F", mktime(0, 0, 0, $i, 1));
                            echo "<option value='$i' >$month</option>";
                        }
                    ?>
                </select>
                <label for="year">Select Year:</label>
                <select id="year" name="year">
                    <?php 
                        $currentYear = date("Y");
                        for ($i=$currentYear; $i>=($currentYear-10); $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="submit">Search</button>
            </form>
            <br>

            <!-- Table Starts -->
            <div class="card">
                <div class="card-body">
                    <?php
                        if(isset($_POST['submit'])) {
                            $month = $_POST['month'];
                            $year = $_POST['year'];

                            $ret = "SELECT ar.admno, COUNT(ar.attendence) as totalDays, 
                                    SUM(CASE WHEN ar.attendence = 'present' THEN 1 ELSE 0 END) as presentDays, ur.name
                                    FROM attendence ar
                                    JOIN userregistration ur ON ar.admno = ur.admno
                                    WHERE MONTH(ar.date) = $month AND YEAR(ar.date) = $year
                                    GROUP BY ar.admno";

                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->execute();
                            $res=$stmt->get_result();
                            $cnt=1;

                            if(mysqli_num_rows($res) > 0) {
                                echo "<h5 class='card-subtitle'>Displaying attendance records for all students for $month / $year.</h5>";
                                echo "<div class='table-responsive'>
                                <table id='zero_config' class='table table-striped table-hover table-bordered no-wrap'>
                                <thead class='thead-dark'>
                                <tr>
                                <th>#</th>
                                <th>Adm. No.</th>
                                <th>Student's Name</th>
                                <th>Total days</th>
                                <th>No of present days</th>
                                <th>Attendance Percentage</th>
                                </tr>
                                </thead>
                                <tbody>";

                                while($row=$res->fetch_object()) {
                                    $attendancePercentage = ($row->presentDays / $row->totalDays) * 100;
                                    $attendancePercentage = round($attendancePercentage, 2);

                                    echo "<tr>
                                    <td>$cnt</td>
                                    <td>$row->admno</td>
                                    <td>$row->name</td>
                                    <td>$row->totalDays</td>
                                    <td>$row->presentDays</td>
                                    <td>$attendancePercentage%</td>
                                    </tr>";
                                    $cnt=$cnt+1;
                                }
                            } else {
                                echo "<p>No attendance records found for the selected month and year.</p>";
                            }
                        }
                    ?>
                </tbody>
                </table>
               
            </div>
        </div>    
        <a href="patten.php"><button type="submit" name="submit" class="btn btn-success">Print</button></a> 
<br><br>

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
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

</body>

</html>