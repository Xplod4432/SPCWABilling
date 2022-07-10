<?php
    $title = 'View Resident Details'; 

    require_once 'includes/header.php';
    require_once './includes/auth_check.php';
    require_once './includes/master_check.php';
    require_once './db/conn.php';
    require './includes/sanitise.php';

    // Get Blog by id
    if(!isset($_GET['tid'])){
        include './includes/errormessage.php';
        
    } else{
        $id = test_input($_GET['tid']);
        $result = $crud->getPendingById($id);
    
    
?>
<div class="text-center container">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col py-2">
      <div class="card h-100 shadow-lg p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <h5 class="card-title">Occupant Name: <?php echo $result['occupant_name']; ?></h5>
            <p class="card-text">Plot No:<?php echo $result['plot_no']; ?></p>
            <p class="card-text">Paid Upto:<?php echo $result['paid_upto']; ?></p>
            <p class="card-text">Owner Name:<?php echo $result['owner_name']; ?></p>
            <p class="card-text">Contact Number:<?php echo $result['contact']; ?></p>
            <p class="card-text">Membership Status:<?php echo $result['membership_status']; ?></p>
        </div>
      </div>
    </div>
</div>
<br/>
                <a href="pendinglist.php" class="btn btn-info">Back to List</a>
                <a onclick="return confirm('Are you sure you want to approve this record?')" href="approve.php?tid=<?php echo $r['tid'] ?>" class="btn btn-success">Approve</a>
                <a onclick="return confirm('Are you sure you want to delete this record?')" href="reject.php?tid=<?php echo $r['tid'] ?>" class="btn btn-danger">Reject</a>
    </div></div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><div id="iframeHolder"></div>
<?php if(!isset($_GET['id'])){
        include './includes/errormessage.php';
        
    } else{
        $id = test_input($_GET['id']);
        $crud->modComments($id);   
?>


</div>   
<?php } }?>
<?php require_once 'includes/footer.php'; ?>