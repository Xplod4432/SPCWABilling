<?php
    if(!($_SESSION['accesslevel'] == 3 || $_SESSION['accesslevel'] == 4)){
        header("Location: login.php");
    }
?>