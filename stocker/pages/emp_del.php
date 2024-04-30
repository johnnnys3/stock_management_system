<?php
include '../includes/connection.php';

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
        case 'employee':
            // Check if there are transactions associated with this employee
            $query = 'SELECT COUNT(*) AS count FROM users WHERE EMPLOYEE_ID = ' . $_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $row = mysqli_fetch_assoc($result);
            $transactionCount = $row['count'];

            if ($transactionCount > 0) {
                // Display confirmation message to the user
                ?>
                <script type="text/javascript">
                    var confirmed = confirm("There are <?php echo $transactionCount; ?> transactions associated with this employee. Are you sure you want to delete this employee? This action will also delete all associated transactions. This action cannot be undone.");
                    if (confirmed) {
                      window.location = "employee.php"
                    } 
                </script>
                <?php
            } else {
                // No associated transactions, proceed with deletion
                $query = 'DELETE FROM employee WHERE EMPLOYEE_ID = ' . $_GET['id'];
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                ?>
                <script type="text/javascript">
                    alert("Employee Successfully Deleted.");
                    window.location = "employee.php";
                </script>
                <?php
            }
            break;
        default:
            // Invalid type
            echo 'Invalid type';
            break;
    }
}
?>
