<?php
    if(!($_SESSION['accesslevel'] == 2 || $_SESSION['accesslevel'] == 4)){
        header("Location: login.php");
    }
?>