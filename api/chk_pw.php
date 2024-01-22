<?php
include_once "db.php";

$table = $_POST['table'];
unset($_POST['table']);
$db = new DB($table);
$chk = $db->count($_POST);

if ($chk) {
    echo $chk; // 回傳給前端去判斷輸入的帳、密是否正確
    $_SESSION[$table] = $_POST['acc']; // 把登入成功的帳號儲存起來，因為購物車功能會用到
} else {
    echo $chk;
}
