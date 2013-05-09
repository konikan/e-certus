<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
      <div style="float: left; width: 250px; border: 1px solid sienna;">
        <ul class="menu">
          <li><?php echo link_to('Kurierzy','couriers/index') ?></li>
          <li><?php echo link_to('Rodzaje opakowań','packaging_types/index') ?></li>
          <li><?php echo link_to('Grupy wysyłek','shipping_types_groups/index') ?></li>
          <li><?php echo link_to('Rodzaje/Ceny wysyłek','shipping_types/index') ?></li>
           <li><?php echo link_to('Opcje wysyłek','shipping_options/index') ?></li>
           <li><?php echo link_to('Stawki ubezpieczeń','insurance_rates/index') ?></li>
           <li><?php echo link_to('Klienci','customers/index') ?></li>
           <li><?php echo link_to('Zamówienia','orders/index') ?></li>
           <li><?php echo link_to('Treści','config/index') ?></li>
           <li><?php echo link_to('Porady','questions/index') ?></li>
           <li><?php echo link_to('Oferty specjalne','special_offers/index') ?></li>
        </ul>
      </div>
      <center>
        <div style="color: red;"><?php echo $sf_user->getFlash('error') ?></div>
        <div style="color: green;"><?php echo $sf_user->getFlash('notice') ?></div>
      </center>
      <div style="float: left;width: 770px;  ">
        <?php echo $sf_content ?>
    </div>
     
  </body>
</html>
