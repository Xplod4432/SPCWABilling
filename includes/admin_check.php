<?php
    if(!($_SESSION['accesslevel'] == 3)){
        header("Location: login.php");
    }
?>