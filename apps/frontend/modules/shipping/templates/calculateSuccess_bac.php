<form action="<?php echo url_for('shipping/calculate')?>" method="post">
    <input type="radio" name="shipment[cat]" value="1" checked> Przesyłki krajowe<br>
    <input type="radio" name="shipment[cat]" value="2" > Przesyłki międzynarodowe<br>
    Rodzaj przesyłki:<br/>
    <select name="shipment[type]" >
        <option value="paczka">Paczka</option>
        <option value="koperta">Koperta</option>
        <option value="paleta">Paleta</option>
    </select>
    <br/>
    Ilość paczek:<br/>
    <select name="shipment[number_of_parcels]">
        <?php
        for($i=1;$i<=10;$i++)
        {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
    </select>
    <br/>
    Waga [kg]:<br/>
    <input type="text" name="shipment[weight]" />
    <br/>
    Wysokość [cm]:<br/>
    <input type="text" name="shipment[height]" />
    <br/>
    Szerokość [cm]:<br/>
    <input type="text" name="shipment[weight]" />
    <br/>
    Wysokość [cm]:<br/>
    <input type="text" name="shipment[lenght]" />
    <br/>
    <input type="submit" value="Dalej"/>
</form>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
