<?php
    $title = "View Records";
    require_once './includes/header.php';
    require_once './db/conn.php';
    require_once './includes/admin_check.php';
    require './includes/sanitise.php';
    
    $results = $crud->getPendingReg();
    if($results != 0)
    {
?>

<table class="table">
        <tr>
            <th>Plot No</th>
            <th>Plot Type</th>
            <th>Resident Name</th>
            <th>Contact</th>
            <th>Paid Upto</th>
            <th>Actions</th>
        </tr>
        <?php while ($r = $results->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $r['plot_no'] ?></td>
                <td><?php echo $r['resident_type'] ?></td>
                <td><?php echo $r['occupant_name'] ?></td>
                <td><?php echo $r['contact'] ?></td>
                <td><?php echo $r['paid_upto'] ?></td>
                <td>
                <a href="view.php?tid=<?php echo $r['tid'] ?>" class="btn btn-primary">View</a>
                <a onclick="return confirm('Are you sure you want to approve this record?')" href="approve.php?tid=<?php echo $r['tid'] ?>" class="btn btn-success">Approve</a>
                <a onclick="return confirm('Are you sure you want to delete this record?')" href="reject.php?tid=<?php echo $r['tid'] ?>" class="btn btn-danger">Reject</a>
                </td>
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