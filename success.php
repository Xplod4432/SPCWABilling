<?php
    $title = 'Success'; 
    require_once 'includes/header.php';
    require_once './db/conn.php';
    require './includes/sanitise.php';
    require './includes/auth_check.php';
    require './includes/admin_check.php';

    if(isset($_POST['submit'])){
        //extract values from the $_POST array
        $plot = test_input($_POST['plot']);
        $oname = test_input($_POST['oname']);
        $resname = test_input($_POST['resname']);
        $contact = test_input($_POST['phone']);
        $paid = test_input($_POST['paid']);
        $mstatus = test_input($_POST['mstatus']);
        $ptype = test_input($_POST['ptype']);

        //Call function to insert and track if success or not
        $isSuccess = $crud->insertDetails($plot,$oname,$resname,$contact,$paid,$mstatus,$ptype);
        if($isSuccess){
            include 'includes/successmessage.php';
        }
        else{
            include 'includes/errormessage.php';
        }
    }
?>
    <!-- This prints out values that were passed to the action page using method="post" -->
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $resname ;  ?>
            </h5>
            <p class="card-text">
                Plot No: <?php echo $plot;  ?>
            </p>
            <p class="card-text">
                Paid Upto: <?php echo $paid;  ?>
            </p>
            <p class="card-text">
                Contact Number: <?php echo $contact;  ?>
            </p>
    
        </div>
    </div>
<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>