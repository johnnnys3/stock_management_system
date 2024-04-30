<?php
include'../includes/connection.php';

session_start();

              $date = $_POST['date'];
              $customer = $_POST['customer'];
              $subtotal = $_POST['subtotal'];
              $lessvat = $_POST['lessvat'];
              $netvat = $_POST['netvat'];
              $addvat = $_POST['addvat'];
              $total = $_POST['total'];
              $cash = $_POST['cash'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              //imma make it trans uniq id
              $today = date("mdGis"); 
              
              $countID = count($_POST['name']);
              // echo "<table>";
             
switch($_GET['action']) {
    case 'add':
        $validUpdate = true; // Flag to check if all updates are valid

        for ($i = 1; $i <= $countID; $i++) {
            // Check if updating this product would result in a negative quantity
            $result = mysqli_query($db, "SELECT `QTY_STOCK` FROM `product` WHERE `NAME` = '".$_POST['name'][$i-1]."'");
            $currentQty = mysqli_fetch_assoc($result)['QTY_STOCK'];

            if (($currentQty - $_POST['quantity'][$i-1]) < 0) {
                $validUpdate = false; // Set flag to false if any update is invalid
                echo "<script>alert('Product quantity for ".$_POST['name'][$i-1]." is ".$currentQty.".');</script>";
                echo "<script>window.location.href = 'pos.php';</script>";
                break; // Exit loop if any update is invalid
            }
        }

        // If all updates are valid, perform the updates and insert transaction
        if ($validUpdate) {
            for ($i = 1; $i <= $countID; $i++) {
                // Insert transaction details
                $query = "INSERT INTO `transaction_details` (`ID`, `TRANS_D_ID`, `PRODUCTS`, `QTY`, `PRICE`, `EMPLOYEE`, `ROLE`)
                          VALUES (Null, '{$today}', '".$_POST['name'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}')";

                mysqli_query($db, $query) or die(mysqli_error($db));

                // Update product quantity in the database
                $updateQuery = "UPDATE `product` SET `QTY_STOCK` = `QTY_STOCK` - '".$_POST['quantity'][$i-1]."' WHERE `NAME` = '".$_POST['name'][$i-1]."'";

                mysqli_query($db, $updateQuery) or die(mysqli_error($db));
            }

            // Insert transaction
            $query111 = "INSERT INTO `transaction` (`TRANS_ID`, `CUST_ID`, `NUMOFITEMS`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
                         VALUES (Null,'{$customer}','{$countID}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}')";

            mysqli_query($db, $query111) or die(mysqli_error($db));

            unset($_SESSION['pointofsale']); // Unset the session after successful transaction
        } else {
          // echo "<script>window.location.href = 'pos.php';</script>";// Redirect back to the previous page if any update is invalid
        }
        break;
}
?>

            <?php
            
                    unset($_SESSION['pointofsale']);
               ?>
              <script type="text/javascript">
                alert("Transaction successful");
               window.location.href = 'print_trans_view.php';
              //  window.location.href = 'pos.php';
                
              </script>
          </div>














          

<?php
              // ailswitch($_GET['action']){
              //   case 'add':     
              //       $query = "INSERT INTO transaction_details
              //                  (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                  VALUES (Null, 'here', '{$emp}', '{$rol}')";
              //       mysqli_query($db,$query)or die ('Error in Database '.$query);
              //       $query2 = "INSERT INTO `transaction`
              //                  (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
              //                  VALUES (Null,'{$customer}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}'')";
              //       mysqli_query($db,$query2)or die ('Error in updating Database2 '.$query2);
              //   break;
              // }

              // mysqli_query($db,"INSERT INTO transaction_details
              //                 (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                 VALUES (Null, 'a', '{$emp}', '{$rol}')");

              // mysqli_query($db,"INSERT INTO `transaction`
              //                 (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_DETAIL_ID`)
              //                 VALUES (Null,'{$customer}',{$subtotal},{$lessvat},{$netvat},{$addvat},{$total},{$cash},'{$date}',(SELECT MAX(ID) FROM transaction_details))");

              // header('location:posdets.php');

            ?>
 <!-- <script type="text/javascript">
      alert("Transaction successfully added.");
      window.location = "pos.php";
      </script> -->