<?php
    include('../includes/pdoconfig.php');
    if(!empty($_POST["bedid"])) {	
    $id=$_POST['bedid'];
    $stmt = $DB_con->prepare("SELECT * FROM rooms WHERE bed_no = :id");
    $stmt->execute(array(':id' => $id));
    ?>
    <?php
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
    ?>
    <?php echo htmlentities($row['room_no']); ?>
    <?php
    }
}



if(!empty($_POST["rid"])) {	
    $id=$_POST['rid'];
    $stmt = $DB_con->prepare("SELECT * FROM rooms WHERE bed_no = :id");
    $stmt->execute(array(':id' => $id));
    ?>
    <?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    ?>
    <?php echo htmlentities($row['room_type']); ?>
    <?php
    }
}

?>