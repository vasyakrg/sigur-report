<h4>Отчет за текущий месяц</h4>
<p>
<table>
    <tr><td align="center">#</td><td align="center">тариф</td><td align="center">фио</td><td align="center">Дата выдачи</td><td align="center">Дата изъятия</td><td align="center">Кол-во дн</td></tr>
    <?php
    $i = 0;
    foreach($data as $row)
    {
        echo '<tr><td>'.$i.'</td><td>'.$row['VALUE'].'</td><td>'.$row['NAME'].'</td><td>'.$row['DATECRE'].'</td><td align="center">'.$row['DATEEXP'].'</td><td align="center">'.$row['qty'].'</td></tr>';
        $i++;
    }
    ?>
</table>
</p>
