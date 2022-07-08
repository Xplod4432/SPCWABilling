<?php
    $title = "Register/Update Residents";
    require_once './includes/header.php';
    require_once './db/conn.php';
    require_once './includes/admin_check.php';
    require_once './includes/sanitise.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $plot = test_input($_POST['plot']);
        $result = $crud->countResidentByPlot($plot);
        if($result == 0)
        {
            header("Location: signup.php");
        }
        else {
            header("Location: editres.php?plot=$plot");
        }
    }
?>
    <h1 class="text-center">Enter Plot No.</h1>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" autocomplete="off">
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