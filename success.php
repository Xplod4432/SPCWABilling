<?php
    $title = 'Success'; 
    require_once 'includes/header.php';
    require_once './db/conn.php';
    require './includes/sanitise.php';
    require './includes/auth_check.php';

    if(isset($_POST['submit'])){
        //extract values from the $_POST array
        $plot = test_input($_POST['plot']);
        $oname = test_input($_POST['oname']);
        $resname = test_input($_POST['resname']);
        $contact = test_input($_POST['phone']);
        $paid = test_input($_POST['paid']);
        $mstatus = test_input($_POST['mstatus']);

        //Call function to insert and track if success or not
        $isSuccess = $crud->insertDetails($plot,$oname,$resname,$contact,$paid,$mstatus);
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
                <?php echo $_POST['resname'] ;  ?>
            </h5>
            <p class="card-text">
                Plot No: <?php echo $_POST['plot'];  ?>
            </p>
            <p class="card-text">
                Paid Upto: <?php echo $_POST['paid'];  ?>
            </p>
            <p class="card-text">
                Contact Number: <?php echo $_POST['phone'];  ?>
            </p>
    
        </div>
    </div>
    

<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>