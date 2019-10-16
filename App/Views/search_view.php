<h4>Поиск по датам</h4>
<p>
    <form method="post" name="form_search">
        <div class="box">
            <p></p>Дата выдачи <input name="datein" id="datepicker" readonly="true" type="text" value="<?php echo $data['datein'];?>"></p>
            <p></p>Дата забора <input name="dateout" id="datepicker2" readonly="true" type="text" value="<?php echo $data['dateout'];?>"></p>
            <p>План
                <select name="plan">
                    <option>Все</option>
                    <option>Day plan</option>
                    <option>Flex plan</option>
                    <option>Office</option>
                    <option>Week plan</option>
                    <option>Видеосъёмка</option>
                    <option>Капсульный отель</option>
                    <option>Малый зал</option>
                    <option>Средний зал</option>
                    <option>Переговорная</option>
                </select></p>
            <p><input type="submit" name="submit" value="Искать"></p>
        </div>
    </form>
</p>
