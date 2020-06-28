<?php

if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['password']);
}

exit(header("Location: /"));