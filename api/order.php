<?php
include "db.php";

$_POST['no'] = date("Ymd") . rand(100000, 999999);
$_POST['cart'] = serialize($_SESSION['cart']);
$_POST['acc'] = $_SESSION['mem'];

$Order->save($_POST);

// 把購物車清除
unset($_SESSION['cart']);
?>
<script>
alert(`訂購成功!
感謝您的選購`)
location.href = "../index.php";
</script>