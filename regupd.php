<?php
    $title = "Register/Update Residents";
    require_once './includes/header.php';
    require_once './db/conn.php';
    require_once './includes/admin_check.php';
?>
    <table class="table">
        <tr>
            <th>Course</th>
            <th>Max Marks</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($r = $results->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $r['name'] ?></td>
                <td><?php echo $r['max_marks'] ?></td>
                <td><?php echo $r['dateoftest'] ?></td>
                <td>
                <a href="viewt.php?tid=<?php echo $r['test_id'] ?>" class="btn btn-primary">View</a>
                </td>
            </tr>
        <?php }?>
    </table>

<?php
  require './includes/footer.php'
?>