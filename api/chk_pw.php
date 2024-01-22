<?php
include_once "db.php";

$table = $_POST['table'];
unset($_POST['table']);
$db = new DB($table);
$chk = $db->count($_POST);

if ($chk) {
    echo $chk;
    $_SESSION[$table] = $_POST['acc']; // 把登入成功的帳號儲存起來，因為購物車功能會用到
}

echo $Mem->count(['acc' => $_GET['acc']]);
