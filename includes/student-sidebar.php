<!-- Sidebar navigation-->
<nav class="sidebar-nav">

    <ul id="sidebarnav">
    
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard.php"
        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
         class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>
        
       
        <li class="nav-small-cap"><span class="hide-menu">Features</span></li>
                            
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="book-hostel.php"
        aria-expanded="false"><i class="fas fa-h-square"></i><span
        class="hide-menu">Book Hostel</span></a></li>
        <?php
                    $uid=$_SESSION['admno'];
                    $stmt=$mysqli->prepare("SELECT admno FROM registration WHERE admno=? ");
                    $stmt->bind_param('i',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($admno);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($rs){ ?>
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="room-details.php"
        aria-expanded="false"><i class="fas fa-bed"></i><span
        class="hide-menu">My Room Details</span></a></li>

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="more.php"
        aria-expanded="false"><i class="fas fa-cogs"></i><span
        class="hide-menu">More Options</span></a></li>


      
        <?php }?>                 
    </ul>
</nav>
<!-- End Sidebar navigation -->