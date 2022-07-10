<?php 
    $title = "Edit Resident Data";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_check.php';
    require_once './includes/admin_check.php';
    require_once './includes/sanitise.php';
    //Get values from post operation
    if(isset($_POST['submit'])){
        $amount = test_input($_POST['amount']);
        $maintenance = test_input($_POST['monthlypay']);
        if ($amount % $maintenance == 0) {
            $id = test_input($_POST['rid']);
            $addmonth = $amount / $maintenance;
            $paytype = test_input($_POST['paytype']);
            $refnum = test_input($_POST['refnum']);
            $paydate = date('Y-m-d H:i:s');
            $biller = $_SESSION['userid'];
            $isSuccess = $crud->insertPayReceipt($id,$amount,$paytype,$refnum,$paydate,$biller,$addmonth);
            if($isSuccess > 0){
                include 'includes/successmessage.php';
                $result = $crud->getResidentById($id);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<style>  
  table {  
    font-family: arial, sans-serif;  
    border-collapse: collapse;  
    width: 50%;
    margin: 0px auto;
  }
  #htmlContent{
    text-align: center;
  }  
  td, th, button {  
    border-: ;  
    text-align: left;  
    padding: 8px;  
  }  
  button {  
    border: 1px solid black;   
  } 
</style>  
<div id="htmlContent">
  <h2 style="color: #0094ff">Receipt Details</h2>  
  <h3><strong>Ticket ID:</strong> <?php echo $isSuccess; ?></h3>  
  <table>  
    <tbody>  
        <tr>  
            <th>Name</th>  
            <td><?php echo $result['occupant_name']; ?></td>
        </tr>  
        <tr>  
            <th>Plot No</th>  
            <td><?php echo $result['plot_no']; ?></td>
        </tr>  
        <tr>  
            <th>Amount</th>  
            <td><?php echo $amount; ?></td>
        </tr>  
        <tr>  
            <th>Date of Receipt</th>  
            <td><?php echo $paydate; ?></td>
        </tr>
        <tr>  
            <th>Paid Upto</th>  
            <td><?php echo $result['paid_upto']; ?></td>
        </tr>
        <tr>  
            <th>Billed By</th>  
            <td><?php echo $_SESSION['posname']; ?></td>
        </tr>  
    </tbody>  
  </table>    
</div>
<div id="editor"></div>
<center>
  <p>
    <button id="generatePDF">generate PDF</button>
  </p>
</center>

<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};
 
 
$('#generatePDF').click(function () {
    doc.fromHTML($('#htmlContent').html(), 15, 15, {
        'width': 700,
        'elementHandlers': specialElementHandlers
    });
    doc.save('Maintenance_Receipt_<?php echo $paydate; ?>.pdf');
});
</script>
<?php
            }
            else{
                include 'includes/errormessage.php';
            }
        }
        else {
            include 'includes/errormessage.php';
            echo "<h1>Amount not a multiple of Monthly Maintenance</h1>";
        }
    }
    else{
        include 'includes/errormessage.php';
    }
    echo "<a href='index.php' class='btn btn-info'>Back to Home</a>";
    include './includes/footer.php';
?>