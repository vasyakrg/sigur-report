<h4>Отчет за текущий месяц</h4>
<p>
<table>
    <tr><td align="center">тариф</td><td align="center">фио</td><td align="center">Дата выдачи</td><td align="center">Дата изъятия</td><td align="center">Кол-во</td></tr>
    <?php
    $i = 1;
    foreach($data as $row) {
        $qty = $row['qty'];
        if ($qty == '0') {
            $time1 = $row['DATEEXP'];
//            echo $time1.'</br>';
            $time2 = $row['DATECRE'];
            $hourdiff = round((strtotime($time1) - strtotime($time2))/3600, 0);
//            echo $hourdiff;
            $qty = $hourdiff.' ч.';
        }
        else
        {
            $qty .= ' дн.';
        }
        echo '</td><td>'.$row['VALUE'].'</td><td>'.$row['NAME'].'</td><td>'.$row['DATECRE'].'</td><td align="center">'.$row['DATEEXP'].'</td><td align="center">'.$qty.'</td></tr>';
        $i++;
    }
    ?>
</table>
</p>
<p>Всего записей: <b><?php echo $i-1 ?></b></p>
