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
            <input type="text" name="ans" id="ans">
        </td>
    </tr>
</table>

<div class="ct">
    <button type="button" onclick="login('admin')">確認</button>
</div>

<script>
    function login(table) {
        $.get('./api/chk_ans.php', {
            ans: $("#ans").val()
        }, (chk) => {
            if (parseInt(chk) == 0) {
                alert("對不起，您輸入的驗證碼有誤，請您重新登入")
            } else {
                $.post("./api/chk_pw.php", {
                    table, // 這裡多一個 table 是因為 chk_pw.php 會由 mem 和 amdin 這兩張資料表共用
                    acc: $("#acc").val(),
                    pw: $("#pw").val()
                }, (res) => {
                    if (parseInt(res) == 0) {
                        alert("帳號或密碼錯誤，請重新輸入")

                    } else {
                        location.href = "back.php?do=admin";
                    }
                })
            }
        })
    }
</script>