<?php
    $title = "Monthly Maintenance";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_Check.php';
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
        <input required type="hidden" id="rid" name="rid" value="<?php echo $res['resident_id']; ?>">
        <div class="mb-3">
            <label for="plot" class="form-label">Plot No</label>
            <input required type="text" class="form-control" id="plot" name="plot" value="<?php echo $res['plot_no']; ?>" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="oname" class="form-label">Full name of Owner</label>
            <input required type="text" class="form-control" id="oname" name="oname" value="<?php echo $res['owner_name']; ?>" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="resname" class="form-label">Occupant Name</label>
            <input required type="text" class="form-control" id="resname" name="resname" value="<?php echo $res['occupant_name']; ?>" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact Number</label>
            <input required type="tel" class="form-control" id="phone" name="phone" value="<?php echo $res['contact']; ?>" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="paid" class="form-label">Paid Upto</label>
            <input required type="text" class="form-control" id="paid" name="paid" value="<?php echo $res['paid_upto']; ?>" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="mstatus" class="form-label">Membership Status</label>
            <select id="mstatus" name="mstatus" class="form-select" value="<?php echo $res['membership_status']; ?>" readonly="readonly">
                   <option value="1">Member</option>
                   <option value="0">Non-Member</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount Paid</label>
            <input required type="number" class="form-control" id="amount" name="amount">
        </div>
        <div class="mb-3">
            <label for="paytype" class="form-label">Payment Type</label>
            <select id="paytype" name="paytype" class="form-select">
                   <!-- <option value="1">Member</option> -->
                   <!-- <option value="0">Non-Member</option> -->
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