<h3>Редактирование сервиса</h3>
   <form method="post" name="form_edit" >
    <div class="box">
        <p>Статус</p>
        <?php switch ($data[0]['status']) {
        case 0: echo '<p><input type="radio" name="status" value="0" checked> <img src="images/off.jpeg" align="center" width="15" height="15"><Br>
                     <input type="radio" name="status" value="1"> <img src="images/on.jpeg" align="center" width="15" height="15"><Br>
                    <input type="radio" name="status" value="2"> <img src="images/sleep.jpeg" align="center" width="15" height="15"><Br>'; break;
        case 1: echo '<p><input type="radio" name="status" value="0"> <img src="images/off.jpeg" align="center" width="15" height="15"><Br>
                     <input type="radio" name="status" value="1" checked> <img src="images/on.jpeg" align="center" width="15" height="15"><Br>
                    <input type="radio" name="status" value="2"> <img src="images/sleep.jpeg" align="center" width="15" height="15"><Br>'; break;
        case 2: echo '<p><input type="radio" name="status" value="0"> <img src="images/off.jpeg" align="center" width="15" height="15"><Br>
                     <input type="radio" name="status" value="1"> <img src="images/on.jpeg" align="center" width="15" height="15"><Br>
                    <input type="radio" name="status" value="2" checked> <img src="images/sleep.jpeg" align="center" width="15" height="15"><Br>'; break;
        }?>
        <p>Сервис</br> <input type="text" name="name" value="<?php echo $data[0]['name'];?>"></p>
        <p>Описание</br> <input type="text" name="detail" value="<?php echo $data[0]['detail'];?>"></p>
        <p>Состояние</br> <textarea rows="2" name="work" cols="45" name="detail"><?php echo $data[0]['work'];?></textarea></p>
        <input name="id" value="<?php echo $data[0]['id'];?>" hidden>
        <p></p>
        <input type="checkbox" name="delete">удалить этот сервис (второй раз не спрошу!)
        <p></p>
        <input name="submit" type="submit" value="Сохранить"/>
    </div>
   </form>
