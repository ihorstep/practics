<?php
    $user = getenv("AUTH_USER");
    $psd = getenv("AUTH_PASS");

    $input_user = $_GET['user'];
    $input_pass = $_GET['pswd'];

    if ($input_user == $user && $input_pass == $input_pass) {
        echo "SUCCESS";
    }
?>
