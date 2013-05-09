<?php if(isset($package_dimension)){ ?>
<div class="box2_top">
    <div class="box_title">Informacje o przesyłce: </div>

 <div class="box2">
     <div class="user_info">
         <table cellpadding="0" cellspacing="0" >
    <tr>
        <td class="col_left" style="border-top: 1px solid silver;"><b>Typ przesyłki:</b></td>
        <td class="col_right" style="border-top: 1px solid silver;"><?php echo ($package_dimension['typ']==1)?"krajowa":"międzynarodowa"; ?></td>
    </tr>
    <?php if($package_dimension['typ']==2){ ?>
        <tr>
        <td class="col_left" style="border-top: 1px solid silver;"><b>Kraj:</b></td>
        <td class="col_right" style="border-top: 1px solid silver;"><?php echo CountriesPeer::retrieveByPK($package_dimension['kraj']) ?></td>
    </tr>
    <?php } ?>
    <tr>
        <td class="col_left" style="border-top: 1px solid silver;"><b>Rodzaj przesyłki:</b></td>
        <td class="col_right" style="border-top: 1px solid silver;"><?php echo $r_wysylki->getName() ?></td>
    </tr>
     <tr>
        <td class="col_left"><b>Ilość paczek:</b></td>
        <td class="col_right"><?php echo $package_dimension['ilosc_paczek']; ?></td>
    </tr>
      <tr>
        <td class="col_left"> <b>Deklarowana waga:</b></td>
        <td class="col_right"><?php echo $package_dimension['wg']; ?>kg</td>
    </tr>
     <tr>
        <td class="col_left"> <b>Wysokość:</b></td>
        <td class="col_right"><?php echo $package_dimension['wy']; ?>cm</td>
    </tr>
    <tr>
        <td class="col_left"><b>Szerokość:</b></td>
        <td class="col_right"> <?php echo $package_dimension['sz']; ?>cm</td>
    </tr>
    <tr>
        <td class="col_left"><b>Długość:</b></td>
        <td class="col_right"> <?php echo $package_dimension['dl']; ?>cm</td>
    </tr>

</table>
<div style="clear: both;"></div>
<div style="float: right;"><?php echo link_to(image_tag('zmien.jpg'),'shipping/packageDimensions?rep=true') ?></div>
<div style="clear: both;"></div>
<?php if(isset($type)){ ?>
<table style="border: 3px solid silver;" cellspacing="0">
    <tr><th style="background: silver; color: black;">Informacje o wybranych uslugach:</th></tr>
    <tr><th style="border-top: 1px solid silver;border-bottom: 1px solid silver;;">Rodzaj usługi:</th></tr>
    <tr><td style="border-top: 1px solid silver;border-bottom: 1px solid silver;"><?php echo $type ?></td></tr>
    <?php if(isset ($options)): ?>
    <tr><th>Opcje:</th></tr>
    <?php foreach ($options as $option): ?>
    <?php if(is_object($option)): ?>
    <tr><td style="border-top: 1px solid silver;border-bottom: 1px solid silver;"><?php echo $option ?> <?php if(isset ($options[$option->getId().'_amount'])): ?> kwota:  <?php echo $options[$option->getId().'_amount'] ?>  <?php endif; ?></td> </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <tr ><td style="font-weight: bold; font-size: 14pt; border-top: 3px solid silver;">Cena: <?php echo $calculate_values[$courier->getName().'_price_vat'] ?> zł</td></tr>
    <tr>
        <td  style="float: right;"><?php echo link_to(image_tag('zmien.jpg'),'shipping/calculate') ?></td>
    </tr>
</table>
<div style="clear: both;"></div>
<div style="float: right; "></div>
<div style="clear: both;"></div>
<?php } ?>


     </div>
 </div>
</div>
<?php } ?>


