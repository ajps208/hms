<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();

    if(isset($_GET['del'])) {
        $id=intval($_GET['del']);
        $adn="DELETE from book_hostel where admno=?";
            $stmt= $mysqli->prepare($adn);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->close();	   
            echo "<script>alert('Record has been deleted');</script>" ;
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
<center><h1>>My College, india</h1></center><br>
    <center><h3>Payment Pending Details</h3></center><br>
    
            <div class="container-fluid">

                <!-- Table Starts -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                        
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Adm. No.</th>
                                                <th>Student's Name</th>
                                                <th>Room No</th>
                                                <th>Bed No</th>
                                                <th>amount</th>
                                                <th>Date</th>
                                                <th>status</th>
                                                <th></th>

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                        $aid=$_SESSION['id'];
                                    
                                        $ret = "SELECT l.id, l.admno, u.name, r.bedno, r.roomno, l.amount, l.date,l.status
                                        FROM payment l
                                        JOIN userregistration u ON l.admno = u.admno
                                        JOIN registration r ON l.admno = r.admno 
                                        where l.status='pending'";
                                        $stmt= $mysqli->prepare($ret) ;
                                        $stmt->execute() ;//ok
                                        $res=$stmt->get_result();
                                        $cnt=1;
                                        while($row=$res->fetch_object())
                                            {
                                                ?>
                                        <tr><td><?php echo $cnt;;?></td>
                                        <td><?php echo $row->admno;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->roomno;?></td>
                                        <td><?php echo $row->bedno;?></td>
                                        <td><?php echo $row->amount;?></td>
                                        <td><?php echo $row->date;?></td>
                                        <td><?php echo $row->status;?></td>
                                        <td><a href="payreciptview.php?admno=<?php echo $row->admno;?>&date=<?php echo $row->date;?>"></a></td>
                                        <td>
                                        <a href="view-students-acc.php?del=<?php echo $row->admno;?>" title="Delete Record" onclick="return confirm("Do you want to delete");"></a></td>
                                        </tr>
                                            <?php
                                        $cnt=$cnt+1;
                                            } ?>
											
										
									</tbody>
                                    </table>
                                    <button type="submit" onclick="window.print()" name="submit" class="btn btn-success">Print</button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Table Ends -->

            </div>
            
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