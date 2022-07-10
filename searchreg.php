<?php
    $title = 'Search Application Data'; 

    require_once 'includes/header.php';
    require_once './db/conn.php';
    require './includes/auth_check.php';
    require './includes/sanitise.php';

    if(!isset($_GET['Search'])){
        include './includes/errormessage.php';
        
    } else{
        $search = test_input($_GET['Search']);
    }
?>
<div class="row py-4">
        <h2 class="text-center bold">Search Results for Plot No."<?php echo $search; ?>"</h2>
</div>
<div class="container p-4">
  <?php $crud->searchRegs($search); ?>
</div>
<?php require_once 'includes/footer.php'; ?>