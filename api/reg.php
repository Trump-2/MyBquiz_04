<?php
include_once "db.php";

// 除了註冊按鈕之外，還有 edit_mem.php 使用，所有才有這個判斷式
if (!isset($_POST['id'])) { // 沒有 id 代表要註冊

    $_POST['regdate'] = date("Y-m-d"); // 因為表單送過來的欄位沒有 regdate，所以手動指定
}

// 新增、修改都要存回資料庫
$Mem->save($_POST);

if (isset($_POST['id'])) { // 有 id 代表要編輯會員資料

    to("../back.php?do=mem");
}
