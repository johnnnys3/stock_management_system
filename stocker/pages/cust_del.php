<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
<?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}
?>

<?php


if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
        case 'customer':
            // Check if there are transactions associated with this customer
            $query = 'SELECT COUNT(*) AS count FROM transaction WHERE CUST_ID = ' . $_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $row = mysqli_fetch_assoc($result);
            $transactionCount = $row['count'];

            if ($transactionCount > 0) {
                // Display confirmation message to the user
                ?>
                <script type="text/javascript">
                    var confirmed = confirm("There are <?php echo $transactionCount; ?> transactions associated with this customer. Are you sure you want to delete this customer? This action will also delete all associated transactions. This action cannot be undone.");
                    if (confirmed) {
                        window.location = "customer.php";
                    } 
                </script>
                <?php
            } else {
                // No associated transactions, proceed with deletion
                $query = 'DELETE FROM customer WHERE CUST_ID = ' . $_GET['id'];
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                ?>
                <script type="text/javascript">
                    alert("Customer Successfully Deleted.");
                    window.location = "customer.php";
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
