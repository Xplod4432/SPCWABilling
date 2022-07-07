<?php
    $title = 'User Login'; 

    require_once './includes/header.php';
    require_once './db/conn.php';
    require './includes/sanitise.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = test_input(strtolower(trim($_POST['username'])));
        $password = test_input($_POST['password']);
        //$new_password = md5($password.$username);

        $result = $user->getUser($username,$password);
        if(!$result){
            echo '<div class="alert alert-danger">Username or Password is incorrect! Please try again. </div>';
        }else{
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $result['userid'];
            $_SESSION['accesslevel'] = $result['accesslevel'];
            header("Location: index.php");
        }

    }
?>

<div class="row py-4">
    <h1 class="text-center bold">Welcome!</h1>
</div>
<div class="d-flex align-items-center justify-content-center mb-5">
<div class="rounded-3 bg-light p-5">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" name="username" class="form-control" id="username" placeholder="Username">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="d-grid gap-2 py-4">
            <input type="submit" value="Login" class="btn btn-orange-moon rounded-3">
        </div>
    </form>
</div>
</div>
<?php include_once './includes/footer.php'?>