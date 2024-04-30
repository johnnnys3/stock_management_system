<link rel="stylesheet" href="../css/sb-admin-2.min.css">
<link rel="stylesheet" href="../css/custom.css">
<?php
include'../includes/connection.php';

$query = "SELECT MAX(TRANS_ID) as latest_id FROM transaction";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$latest_id = $row['latest_id'];

// Construct the link for printing the latest entry
$link = "trans_view.php?action=edit%20&%20id=" . $latest_id;
?>
<div class="prtty">
<a class="prt-btn btn btn-danger" href="#" onclick="backToPos();"> <<< Back to POS</a>
<a class="prt1-btn btn btn-primary" href="#" onclick="printLatestEntry();">Print Receipt</a>
</div>


<script>
  function printLatestEntry() {
    // Define the URL with the latest ID
    var link = "trans_view.php?action=edit%20&%20id=<?php echo $latest_id; ?>";

    // Create a hidden iframe
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    document.body.appendChild(iframe);

    // Set the iframe's src to the desired URL
    iframe.src = link;

    // Once the iframe is fully loaded, trigger the print function
    iframe.onload = function() {
      iframe.contentWindow.print();

      // Delay closing the window to ensure the print dialog is shown
      setTimeout(function() {
        document.body.removeChild(iframe);
        window.close();
      }, 1000); // Adjust the delay as needed
    };
  }

  function backToPos() {
    window.location.href = 'pos.php';
  } 
</script>
