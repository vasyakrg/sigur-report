<h3>Авторизация</h3>
<p>
<div id="form_auth">
    <form method="post" name="form_auth" >
        <table>
            <tr>
                <td> Логин: </td>
                <td>
                    <input type="text" name="login" required="required" value="vasya" /><br />
                    <!--                        <span id="valid_login_message" class="mesage_error"></span>-->
                </td>
            </tr>

            <tr>
                <td> Пароль: </td>
                <td>
                    <input type="text" name="password" placeholder="минимум 2 символа" required="required" value="123" /><br />
                    <span id="valid_password_message" class="mesage_error"></span>
                </td>
            </tr>
            <td colspan="2" class="text_center" >
                <label>
                    <input type="checkbox" name="rmb" checked="checked" /> Запомнить меня
                </label>
            </td>
            </tr>

            <tr>
                <td>
                    <input name="submit" type="submit" value="Войти" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php echo $data['login']?>
</p>