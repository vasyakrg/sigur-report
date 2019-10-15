<h2>Профиль</h2>
<form method="post" name="form_profile">
<p> логин:
    <?php echo $data['login']?> </br>
    новый пароль: </br>
    <input type="password" name="newpass"> </br>
    <input type="submit" name="submit" value="Сохранить">
</p>
</form>