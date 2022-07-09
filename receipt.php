<?php 
    $title = "Edit Resident Data";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_Check.php';
    require_once './includes/sanitise.php';
    //Get values from post operation
    if(isset($_POST['submit'])){
        //extract values from the $_POST array
        $id = test_input($_POST['rid']);
        $amount = test_input($_POST['amount']);
        $paytype = test_input($_POST['paytype']);
        $refnum = test_input($_POST['refnum']);
        $date = date('Y-m-d H:i:s');
        $biller = $_SESSION['userid'];

        //Call function to insert and track if success or not
        $isSuccess = $crud->insertPayReceipt($id,$amount,$paytype,$refnum,$date,$biller);
        if($isSuccess){
            include 'includes/successmessage.php';
        }
        else{
            include 'includes/errormessage.php';
        }
    }
    else{
        include 'includes/errormessage.php';
    }
    echo "<a href='index.php' class='btn btn-info'>Back to Home</a>";
    include './includes/footer.php';
?>