<?php
if ('127.0.0.1' == $_SERVER['REMOTE_ADDR'] OR '::1' == $_SERVER['REMOTE_ADDR']) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_BASE', 'minifacebook');
} else {
        define('DB_HOST', 'localhost');
        define('DB_USER', 's_vagorb');
        define('DB_PASS', 'zThQ3f6A');
        define('DB_BASE', 'vagorb');
}

//mysql -u s_vagorb -p zThQ3f6A vagorb < data/minifacebook.sql

function db() {
    static $conn;
    if ($conn===NULL){
        $conn = mysqli_connect (DB_HOST, DB_USER,DB_PASS, DB_BASE);
        $conn->set_charset('utf8');
    }
    return $conn;
}
