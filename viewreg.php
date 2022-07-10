<?php
    $title = "View Records";
    require_once './includes/header.php';
    require_once './db/conn.php';
    require_once './includes/auth_check.php';
    require './includes/sanitise.php';
    
    $results = $crud->getAllReg();
    if($results != 0)
    {
?>
<div class="input-group">
    <form class="d-flex" action="./searchreg.php" method="get">
        <input class="form-control rounded-pill" id="Search" name="Search" type="search" placeholder="Search" aria-label="Search" required>
        <button class="btn btn-default" type="submit">
            <span class="fa fa-search"></span>
        </button>
    </form>
</div>
<table class="table">
        <tr>
            <th>Plot No</th>
            <th>Resident Name</th>
            <th>Contact</th>
            <th>Applied On</th>
            <th>Status</th>
        </tr>
        <?php while ($r = $results->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $r['plot_no'] ?></td>
                <td><?php echo $r['occupant_name'] ?></td>
                <td><?php echo $r['contact'] ?></td>
                <td><?php echo $r['appliedon'] ?></td>
                <td><?php echo $r['statusname'] ?></td>
            </tr>
        <?php }?>
    </table>

<?php
    }
    else {
        echo "<h1>No more pending registrations!</h1>";
    }
    require './includes/footer.php'
?>