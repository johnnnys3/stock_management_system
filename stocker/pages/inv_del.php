<?php
include'../includes/connection.php';

          
	if (!isset($_GET['do']) || $_GET['do'] != 1) {
						
    	switch ($_GET['type']) {
    		case 'product':
    			$query = 'DELETE FROM product WHERE PRODUCT_ID = ' . $_GET['id'];
				$result = mysqli_query($db, $query) or die(mysqli_error($db));
				?>
				<script type="text/javascript">
					alert("Item Successfully Deleted.");
					window.location = "inventory.php";
				</script>
				<?php
				break;
			default:
				// Invalid type
				?>
				<script type="text/javascript">
					alert("Invalid type specified.");
					window.location = "inventory.php";
				</script>
				<?php
				break;
		}
	  } else {
		// Display confirmation message to the user
		?>
		<script type="text/javascript">
			var confirmed = confirm("Are you sure you want to delete this Inventory? This action cannot be undone.");
			if (confirmed) {
			  window.location = "inventory.php";
			} else {
				window.location = "inventory.php";
			}
		</script>
		<?php
	  }
	  ?>