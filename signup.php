<?php
    $title = "Sign Up";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_Check.php';
    $results = $crud->getPlotTypes();
?>
    <h1 class="text-center">Resident Registration</h1>
    <form method="post" action="success.php" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
            <label for="plot" class="form-label">Plot No</label>
            <input required type="text" class="form-control" id="plot" name="plot">
        </div>
        <div class="mb-3">
            <label for="ptype" class="form-label">Residence Type</label>
            <select id="ptype" name="ptype" class="form-select">
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)) {?>
                    <option value="<?php echo $r['resident_type'] ?>"><?php echo $r['typename']; ?></option>
                <?php }?>
            </select>
        </div>
        <div class="mb-3">
            <label for="oname" class="form-label">Full name of Owner</label>
            <input required type="text" class="form-control" id="oname" name="oname">
        </div>
        <div class="mb-3">
            <label for="resname" class="form-label">Occupant Name</label>
            <input required type="text" class="form-control" id="resname" name="resname">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact Number</label>
            <input required type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="paid" class="form-label">Paid Upto</label>
            <input required type="text" class="form-control" id="paid" name="paid">
        </div>
        <div class="mb-3">
            <label for="mstatus" class="form-label">Membership Status</label>
            <select id="mstatus" name="mstatus" class="form-select">
                   <option value="1">Member</option>
                   <option value="0">Non-Member</option>
            </select>
        </div>
        <div class="py-3">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php
  require './includes/footer.php'
?>