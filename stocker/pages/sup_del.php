<?php
include '../includes/connection.php';

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
        case 'supplier':
            // Check if there are products associated with this supplier
            $query = 'SELECT COUNT(*) AS count FROM product WHERE SUPPLIER_ID = ' . $_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $row = mysqli_fetch_assoc($result);
            $productCount = $row['count'];

            if ($productCount > 0) {
                // Display confirmation message to the user
                ?>
                <script type="text/javascript">
                    var confirmed = confirm("There are <?php echo $productCount; ?> products associated with this supplier. Are you sure you want to delete this supplier? This action will also delete all associated products. This action cannot be undone.");
                    if (confirmed) {
						window.location = "supplier.php";
                    } 
                </script>
                <?php
            } else {
                // No associated products, proceed with deletion
                $query = 'DELETE FROM supplier WHERE SUPPLIER_ID = ' . $_GET['id'];
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                ?>
                <script type="text/javascript">
                    alert("Supplier Successfully Deleted.");
                    window.location = "supplier.php";
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
