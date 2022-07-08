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
        $plot = test_input($_POST['plot']);
        $oname = test_input($_POST['oname']);
        $resname = test_input($_POST['resname']);
        $contact = test_input($_POST['phone']);
        $paid = test_input($_POST['paid']);
        $mstatus = test_input($_POST['mstatus']);

        //Call function to insert and track if success or not
        $isSuccess = $crud->editDetails($id,$plot,$oname,$resname,$contact,$paid,$mstatus);
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