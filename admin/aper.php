<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

// Get the list of admission numbers and names from the userregistration table
$query = "SELECT DISTINCT a.admno, u.name FROM attendence a JOIN userregistration u ON a.admno = u.admno";
$result = mysqli_query($mysqli, $query);
if (!$result) {
    die("Error: " . mysqli_error($mysqli));
}
$admnos = array();
while ($record = mysqli_fetch_assoc($result)) {
    $admnos[$record['admno']] = $record['name'];
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="admno">Select Student:</label>
    <select name="admno" id="admno">
        <?php foreach ($admnos as $admno => $name): ?>
            <option value="<?php echo $admno; ?>"><?php echo "$admno - $name"; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Show Attendance</button>
</form>

<?php
if (isset($_POST['admno'])) {
    $admno = $_POST['admno'];

    // Get the attendance data for the selected student
    $query = "SELECT * FROM attendence WHERE admno = '$admno'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        // Calculate the attendance percentage, total days, present days, and absent days for each month
        $months = array();
        while ($record = mysqli_fetch_assoc($result)) {
            $date = new DateTime($record['date']);
            $month = $date->format('F');
            if (!isset($months[$month])) {
                $months[$month] = array('present' => 0, 'absent' => 0, 'total' => 0);
            }
            if ($record['attendence'] == 'present') {
                $months[$month]['present']++;
            } else {
                $months[$month]['absent']++;
            }
            $months[$month]['total']++;
        }
        $percentages = array();
        foreach ($months as $month => $data) {
            $percent = ($data['present'] / $data['total']) * 100;
            $percentages[$month] = round($percent, 2);
        }

        // Display the attendance percentages, total days, present days, and absent days for each month in a table
        echo "<h2>Attendance Report for Admission Number: $admno</h2>";
        echo "<table>";
        echo "<tr><th>Month</th><th>Attendance Percentage</th><th>Total Days</th><th>Days Present</th><th>Days Absent</th></tr>";
        foreach ($percentages as $month => $percentage) {
            $total_days = $months[$month]['total'];
            $days_present = $months[$month]['present'];
            $days_absent = $months[$month]['absent'];
            $percent = $percentages[$month];
            echo "<tr><td>$month</td><td>$percent%</td><td>$total_days</td><td>$days_present</td><td>$days_absent</td></tr>";
        }}
        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }