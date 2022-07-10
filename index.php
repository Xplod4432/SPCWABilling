<?php 
    $title = "HomePage";
    require './includes/header.php';
    require './db/conn.php';
    require_once './includes/auth_check.php';
?>
<div class="row">
<?php if ($_SESSION['accesslevel'] == 2 || $_SESSION['accesslevel'] == 4) { ?>
  <div class="col-md-12 col-md-8 col-lg-6 mt-5">
  <a href="./receiptgen.php" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">Generate Receipt</h4>
        <p class="card-text">Generate a receipt for <strong>registered residents</strong> against payment received towards monthly maintenance</p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">Generate Receipt</button>
        </div>
      </div>
    </div>
  </a>
  </div>
  <div class="col-md-12 col-md-8 col-lg-6 mt-5">
  <a href="./regupd.php" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">Register/Edit Resident</h4>
        <p class="card-text">Register a resident by entering the details or edit the pre-existing details for an existing resident</p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">Register/Edit</button>
        </div>
      </div>
    </div>
  </a>
</div>
<div class="col-md-12 col-md-8 col-lg-6 mt-5">
  <a href="#" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">View Reports</h4>
        <p class="card-text">View Transactions and Reports of Association Accounts <strong>(Implementation Pending)</strong></p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">Register/Edit</button>
        </div>
      </div>
    </div>
  </a>
</div>
<?php } ?>
<?php if ($_SESSION['accesslevel'] == 3 || $_SESSION['accesslevel'] == 4) { ?>
  <div class="col-sm-12 col-md-8 col-lg-6 my-5">
  <a href="./pendinglist.php" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">Approve Registration</h4>
        <p class="card-text">Verify and approve the registration/edit details of residents</p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">View List</button>
        </div>
      </div>
    </div>
  </a>
</div>
<?php } ?>
<div class="col-sm-12 col-md-8 col-lg-6 my-5">
  <a href="./viewreg.php" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">View Registration Status</h4>
        <p class="card-text">View and track the status of registration of residents</p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">View List</button>
        </div>
      </div>
    </div>
  </a>
</div>
<div class="col-sm-12 col-md-8 col-lg-6 my-5">
  <a href="./viewResidents.php" style="color:black; text-decoration:none;">
    <div class="card p-4">
      <div class="card-body">
        <h4 class="card-title">View Residents List</h4>
        <p class="card-text">View details of already registered residents</p>
        <div class="col pb-3">
            <button class="btn btn-orange-moon">View List</button>
        </div>
      </div>
    </div>
  </a>
</div>
</div>
<?php
  include 'includes/footer.php'
?>