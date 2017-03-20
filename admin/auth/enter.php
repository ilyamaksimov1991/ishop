<?php
define("ISHOP", TRUE);
session_start();

include $_SERVER['DOCUMENT_ROOT']."/config.php"; // путь к корневой директории



if ($_SESSION['auth']['admin']){ // редирект если администратор
    header("location: ".PATH."admin/");
   exit;
}
if ($_POST){
    $login = trim(mysql_real_escape_string($_POST['user']));
    $pass = trim($_POST['pass']);

$query="SELECT * FROM `customers` WHERE login='$login' AND id_rol='2'";
$res = mysql_query($query) or die (mysql_error());
$row = mysql_fetch_assoc($res);

if ($row['password'] == md5($pass)){
    $_SESSION['auth']['admin']= $row['name'];
    $_SESSION['auth']['customer_id ']= $row['customer_id'];
header ("Location: ../");
exit;
}else{
    $_SESSION['res'] = "<div class='Text-reg-error'>Неправильный логин или пароль </div>";
    header("Location:".$_SERVER['PHP_SELF']);

}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../<?=TEMPLATE_ADMIN?>/style.css" />
    <title>Вход в админку</title>
</head>

<body>
<div class="karkas">
    <div class="head">
        <a href="#"><img src="../<?=TEMPLATE_ADMIN?>/images/logoAdm.jpg" /></a>
        <?php
        if ( $_SESSION['res']){
        echo $_SESSION['res'];
        unset  ($_SESSION['res']);
        }
        ?>
        <p>Вход в админку</p>
    </div>
    <div class="enter">

        <form method="post" action="">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="image" src="../<?=TEMPLATE_ADMIN?>/images/enter_btn.jpg" name="submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>

