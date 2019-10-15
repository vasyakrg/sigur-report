<h4>Log</h4>
<p>
<table>
    <tr><td align="center">?</td><td align="center">Who</td><td align="center">Date</td><td align="center" width="75%">str</td></tr>
    <?php
    foreach($data as $row)
    {
        echo '<tr><td align="center">'.$row['idlog'].'</td><td>'.$row['who'].'</td><td>'.$row['daterun'].'</td><td>'.$row['str'].'</td></tr>';
    }
    ?>
</table>
</p>