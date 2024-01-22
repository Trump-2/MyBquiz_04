<h2 class="ct">會員註冊</h2>
<table class="all">
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp">
            <input type="text" name="acc" id="acc">
            <button onclick="chkacc()">檢測帳號</button>
        </td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel"></td>
    </tr>
    <tr>
        <td class="tt ct">住址</td>
        <td class="pp"><input type="text" name="addr" id="addr"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email"></td>
    </tr>
</table>
<div class="ct">
    <button onclick="reg()">註冊</button>
    <button onclick="clean()">重置</button>
</div>

<script>
function chkacc() {
    let acc = $("#acc").val()
    $.get("./api/chk_acc.php", {
        acc
    }, (res) => {
        if (parseInt(res) == 1 || acc == 'admin') { // 等於 1 表示帳號註冊過了；admin 不能被註冊
            alert(`此帳號${acc}已被使用`)
        } else {
            alert(`此帳號${acc}可以使用`)
        }
    })
}

function clean() {
    $("#name,#acc, #pw, #tel, #addr, #email").val('')
}


function reg() {
    let user = {
        name: $("#name").val(),
        acc: $("#acc").val(),
        pw: $("#pw").val(),
        tel: $("#tel").val(),
        addr: $("#addr").val(),
        email: $("#email").val()
    }

    $.get("./api/chk_acc.php", {
        acc
    }, (res) => {
        if (parseInt(res) == 1 || acc == 'admin') { // 等於 1 表示帳號註冊過了
            alert(`此帳號${user.acc}已被使用`)
        } else {
            $.post("./api/reg.php", user, (res) => {
                location.href = "?do=login"; // 註冊成功倒回登入頁面
            })
        }
    })
}
</script>