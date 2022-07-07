<?php
    $title = "Monthly Maintenance";
    require_once './db/conn.php';
    require_once './includes/header.php';
    require_once './includes/auth_Check.php';
?>
    <h1 class="text-center">Enter Plot No.</h1>
    <form method="post" action="receiptplot.php" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
            <label for="plot" class="form-label">Plot No</label>
            <input required type="text" class="form-control" id="plot" name="plot">
        </div>
        <div class="py-3">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php
  require './includes/footer.php'
?>