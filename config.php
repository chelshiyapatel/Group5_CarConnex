<?php
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'cars');

    $mysqli = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
    mysqli_set_charset($mysqli, 'utf8');

    function prepare_string($mysqli, $string) {
        $string_trimmed = trim($string);
        $string = mysqli_real_escape_string($mysqli, $string_trimmed);
        return $string;
    }
?>
