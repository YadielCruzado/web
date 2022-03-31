<?php
    if($_POST){
        header('location:inicio.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador del sitio web</title>
</head>
<body>
    <header>
        login
    </header>
    <form method="post">
        <label for="User">User</label>
        <input type="text" name= "User" placeholder = "Enter your username">
        <label for="password">Password</label>
        <input type="password" name = "password"  placeholder = "Enter your password">
        <button type="submit">Entrer the dashboard</button>
    </form>
</body>
</html>