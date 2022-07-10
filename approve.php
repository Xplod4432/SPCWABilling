<?php
$title = 'Approve Registration';
    require_once './includes/header.php';
    require_once './includes/auth_check.php';
    require_once './includes/master_check.php';
    require_once './db/conn.php';
    require './includes/sanitise.php';
    if (!isset($_GET['tid'])) {
        include 'includes/errormessage.php';
    }
    else {
        $id = test_input($_GET['tid']);
        $result = $crud->approveRegistration($id);

        if ($result) {
            include './includes/successmessage.php';
        }
        else {
            include './includes/errormessage.php';
        }
    }
?>
<a href="pendinglist.php" class="btn btn-info">Back to List</a>
<a href="index.php" class="btn btn-warning">Back to Home</a>