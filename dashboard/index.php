<?php
    session_start();
    if($_POST){

        if(($_POST['User']=="yadi")&&($_POST['password']=="kapony")){

            $_SESSION['user']="ok";
            $_SESSION['userName']="yadi";
            header('location:inicio.php');
        }else{
            $mensaje = "Error: El usuario o contreasenia son incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador del sitio web</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
    <?php if(isset($mensaje)) { ?>
        <?php echo $mensaje; ?>

        <?php } ?>
    <header class="login">
        <h1>Login</h1>
        <form method="post">
            <div>
                <label for="User">User:</label>
                <input type="text" name= "User" placeholder = "Enter your username">
            </div>
            <div>
            <label for="password">Password:</label>
            <input type="password" name = "password"  placeholder = "Enter your password">
            </div>
            <button type="submit">Entrer the dashboard</button>
        </form>
    </header>
</body>
</html>