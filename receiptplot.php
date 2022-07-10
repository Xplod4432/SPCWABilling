<?php
    $title = "Monthly Maintenance";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require './includes/auth_check.php';
    require_once './includes/admin_check.php';
    require_once './includes/sanitise.php';
    if (isset($_POST['submit'])) {
        $plot = test_input($_POST['plot']);
        $res = $crud->getResidentByPlot($plot);
        if ($res == 0) {
            include './includes/errormessage.php';
            echo "<h2>Maybe the resident does not exist in database, try registering or waiting for admin to approve the registration<h2>";
        }
        else {
?>
    <h1 class="text-center">Resident Maintenance</h1>
    <form method="post" action="receipt.php" enctype="multipart/form-data" autocomplete="off">
        <input required type="hidden" id="rid" name="rid" value="<?php echo $res['resident_id']; ?>" readonly="readonly">
        <input required type="hidden" id="monthlypay" name="monthlypay" value="<?php echo $res['monthly_amt']; ?>" readonly="readonly">
        <div class="mb-3">
            <label for="plot" class="form-label">Plot No</label>
            <input required type="text" class="form-control" id="plot" name="plot" value="<?php echo $res['plot_no']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="restype" class="form-label">Residence Type</label>
            <input id="restype" name="restype" class="form-control" value="<?php echo $res['typename']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="oname" class="form-label">Full name of Owner</label>
            <input required type="text" class="form-control" id="oname" name="oname" value="<?php echo $res['owner_name']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="resname" class="form-label">Occupant Name</label>
            <input required type="text" class="form-control" id="resname" name="resname" value="<?php echo $res['occupant_name']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact Number</label>
            <input required type="tel" class="form-control" id="phone" name="phone" value="<?php echo $res['contact']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="paid" class="form-label">Paid Upto</label>
            <input required type="text" class="form-control" id="paid" name="paid" value="<?php echo $res['paid_upto']; ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="mstatus" class="form-label">Membership Status</label>
            <input id="mstatus" name="mstatus" class="form-control" value="<?php if($res['membership_status']){echo "Member";} else{echo "Non-Member";} ?>" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount Paid</label>
            <input required type="number" class="form-control" id="amount" name="amount">
        </div>
        <div class="mb-3">
            <label for="paytype" class="form-label">Payment Type</label>
            <select id="paytype" name="paytype" class="form-select">
                   <option value="1">UPI</option>
                   <option value="2">Cash</option>
                   <option value="3">Cheque</option>
                   <option value="4">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="refnum" class="form-label">Txn ID/Cheque No/Cash Handler</label>
            <input required type="text" class="form-control" id="refnum" name="refnum">
        </div>
        <div class="py-3">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php
    }
        }
    else {
        include './include/errormessage.php';
    }
    require './includes/footer.php'
?>