<?php
    $title = "Edit Resident Data";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_check.php';
    require_once './includes/admin_check.php';
    require_once './includes/sanitise.php';
    if (isset($_GET['plot'])) {
        $plot = test_input($_GET['plot']);
        $res = $crud->getResidentByPlot($plot);
?>
    <h1 class="text-center">Edit Resident Data</h1>
    <form method="post" action="editPost.php" enctype="multipart/form-data" autocomplete="off">
        <input required type="hidden" id="rid" name="rid" value="<?php echo test_input($res['resident_id']); ?>">
        <div class="mb-3">
            <label for="plot" class="form-label">Plot No</label>
            <input required type="text" class="form-control" id="plot" name="plot" value="<?php echo test_input($res['plot_no']); ?>">
        </div>
        <div class="mb-3">
            <label for="oname" class="form-label">Full name of Owner</label>
            <input required type="text" class="form-control" id="oname" name="oname" value="<?php echo test_input($res['owner_name']); ?>">
        </div>
        <div class="mb-3">
            <label for="resname" class="form-label">Occupant Name</label>
            <input required type="text" class="form-control" id="resname" name="resname" value="<?php echo test_input($res['occupant_name']); ?>">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact Number</label>
            <input required type="tel" class="form-control" id="phone" name="phone" value="<?php echo test_input($res['contact']); ?>">
        </div>
        <div class="mb-3">
            <label for="paid" class="form-label">Paid Upto</label>
            <input required type="text" class="form-control" id="paid" name="paid" value="<?php echo test_input($res['paid_upto']); ?>">
        </div>
        <div class="mb-3">
            <label for="mstatus" class="form-label">Membership Status</label>
            <select id="mstatus" name="mstatus" class="form-select" value="<?php echo test_input($res['membership_status']); ?>">
                   <option value="1">Member</option>
                   <option value="0">Non-Member</option>
            </select>
        </div>
        <div class="py-3">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php
    }
    else {
        include './includes/errormessage.php';
    }
    require './includes/footer.php'
?>