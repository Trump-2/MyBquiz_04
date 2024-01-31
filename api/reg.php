<?php
include_once "db.php";

if (!isset($_POST['id'])) {

    $_POST['regdate'] = date("Y-m-d"); // 因為表單送過來的欄位沒有 regdate，所以手動指定
}

$Mem->save($_POST);

if (isset($_POST['id'])) {

    to("../back.php?do=mem");
}
