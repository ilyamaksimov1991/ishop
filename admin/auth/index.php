<?php
define("ISHOP", TRUE);
session_start();

include $_SERVER['DOCUMENT_ROOT']."/config.php"; // путь к корневой директории
if (!$_SESSION["auth"]["admin"]){
    header("location: ".PATH."admin/auth/enter.php");
    exit;
}else{
    header("location: ".PATH."admin/");
    exit;
}
?>