<?php

define('ROOT', __DIR__);

// Подключает все классы
spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$login = $password = $error = '';

if(!empty($_POST)) {
    $user_o = new Users();

    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $user = $user_o->loginUserByLoginAndPassword($login, $password);
    
    if($user == null) {
        $error = 'Неправильные данные для входа!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lab1</title>
        <style>
            .block {
                border: 1px solid #ccc;
                width: 700px;
                padding: 25px;
                margin: 50px auto;
            }
            label {
                display: block;
                padding-bottom: 10px;
            }
            form > div {
                padding-bottom: 10px;
            }
            form input[type=text] {
                width: 100%;
            }
            .btn-block {
                text-align: right;
            }
            .btn {
                border: 1px solid #ccc;
                padding: 5px 10px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
    <div class="content">
        <div class="block">
            <?php if($user != null) { ?>
                <div style="text-align:center;">
                    <h3><?=$user->showMessage()?></h3>
                    <a href="/logout.php" class="btn">Log out</a>
                </div>
            <?php } else { ?>
                <form action="/" method="POST">
                    <div style="color: red; text-align: center;">
                        <?= $error ?>
                    </div>
                    <div>
                        <label>Login:</label>
                        <input type='text' name='login' value='<?=$login?>'>
                    </div>
                    <div>
                        <label>Password:</label>
                        <input type='text' name='password' value='<?=$password?>'>
                    </div>
                    <div class="btn-block">
                        <button type="submit">
                        Login
                        </button>
                    </div>
                </form>
            <?php } ?>
       </div>
    </div>
    </body>
</html>

