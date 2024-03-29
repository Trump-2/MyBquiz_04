<div class="ct">
    <button type="button" onclick="location.href='?do=add_admin'">新增管理員</button>

</div>
<!-- table.all>tr*2>td.pp.ct*3 -->
<table class="all">
    <tr>
        <th class="tt ct">帳號</th>
        <th class="tt ct">密碼</th>
        <th class="tt ct">管理</th>
    </tr>
    <?php
    $rows = $Admin->all();
    foreach ($rows as $row) {
    ?>
        <tr>
            <td class="pp ct"><?= $row['acc'] ?></td>
            <!-- 把明碼的密碼改成用 * 代替；這裡不是 <input> 所以不能使用 input:password -->
            <td class="pp ct"><?= str_repeat("*", strlen($row['pw'])) ?></td>
            <td class="pp ct">
                <?php
                if ($row['acc'] == 'admin') {
                    echo "此帳號為最高權限";
                } else {
                ?>
                    <!-- 這裡使用 &#39; 因為前面已經有使用單引號了，但又需要單引號，所以用 &#39; 代替
                     改成用 html 語法的方式 -->
                    <button onclick="location.href='?do=edit_admin&id=<?= $row['id'] ?>'">修改</button>
                    <button onclick="del('admin',<?= $row['id'] ?>)">刪除</button>
                <?php
                }
                ?>
            </td>
        </tr>

    <?php
    }
    ?>
</table>
<div class=" ct">
    <button type="button" onclick="location.href='./index.php'">返回</button>
</div>