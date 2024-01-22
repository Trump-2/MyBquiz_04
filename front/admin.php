<h2>管理員登入</h2>
<table class="all">
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="text" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">驗證碼</td>
        <td class="pp">
            <?php
            $a = rand(10, 99);
            $b = rand(10, 99);
            $_SESSION = $a + $b; // 把計算的結果存在 session 裡面
            echo $a . " + " . $b . " = ";
            ?>
            <input type="text" name="chk" id="chk">
        </td>
    </tr>
</table>

<div class="ct"><button type="button">確認</button></div>