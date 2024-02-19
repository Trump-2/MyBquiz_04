<!-- 老師從 back 的 mem.php 複製過來的 -->
<h2 class="ct">訂單管理</h2>
<table class="all">
    <tr>
        <td class="ct tt">訂單編號</td>
        <td class="ct tt">金額</td>
        <td class="ct tt">會員帳號</td>
        <td class="ct tt">姓名</td>
        <td class="ct tt">下單時間</td>
        <td class="ct tt">操作</td>
    </tr>

    <?php
    $orders = $Order->all();
    foreach ($orders as $order) {


    ?>
        <tr>
            <td class="ct pp">
                <a href="?do=detail&id=<?= $order['id'] ?>">
                    <?= $order['no'] ?>
                </a>

            </td>
            <td class="ct pp"><?= $order['total'] ?></td>
            <td class="ct pp"><?= $order['acc'] ?></td>
            <td class="ct pp"><?= $order['name'] ?></td>
            <td class="ct pp"><?= date("Y/m/d", strtotime($order['orderdate'])) ?></td>
            <td class="ct pp">
                <?php

                echo "<button onclick='del(&#39;orders&#39;,{$row['id']})'>刪除</button>";
                ?>
            </td>
        </tr>
    <?php
    }


    ?>
</table>