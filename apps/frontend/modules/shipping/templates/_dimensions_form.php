<?php if(isset($form)): ?>
 <?php if ($form->hasErrors()): ?>
  <tr>
    <td colspan="4">
      
    </td>
  </tr>
<?php endif; ?>
<script type="text/javascript" >
  function setValues(r_id){
        if(r_id == 1)
        {
            document.getElementById('package_dimension_wy').value = 1;
            document.getElementById('package_dimension_wg').value = 1;
            document.getElementById('package_dimension_sz').value = 25;
            document.getElementById('package_dimension_dl').value = 35;
        }
        if(r_id == 2)
        {
            document.getElementById('package_dimension_wy').value = '';
            document.getElementById('package_dimension_wg').value = '';
            document.getElementById('package_dimension_sz').value = '';
            document.getElementById('package_dimension_dl').value = '';
        }
        if(r_id == 3)
        {
            document.getElementById('package_dimension_wy').value = 180;
            document.getElementById('package_dimension_wg').value = '';
            document.getElementById('package_dimension_sz').value = 120;
            document.getElementById('package_dimension_dl').value = 80;
        }
    }
</script>
  <div class="dimensions_form">
      <div style="font-size: 16px; border: 1px solid silver; margin: 10px 10px 0px 10px;">
      <b>Szybka wycena</b>
      </div>
      <div class="inside">
<form action="<?php echo url_for('shipping/packageDimensions') ?>" method="POST" name="package_dimension">
  <?php echo $form->renderHiddenFields() ?>
    <table >
      <?php echo $form['typ']->renderRow() ?>
        <?php echo $form['kraj']->renderRow(array('style'=>"width:160px;")) ?>
    <?php echo $form['r_wysylki']->renderRow(array('onchange'=>"setValues(this.value);")) ?>
    <?php echo $form['ilosc_paczek']->renderRow() ?>
    <?php echo $form['wg']->renderRow() ?>
    <?php echo $form['wy']->renderRow() ?>
    <?php echo $form['sz']->renderRow() ?>
    <?php echo $form['dl']->renderRow() ?>
    
  </table>
    <div style="clear: both;"></div>
    <div style="float: right;"><input type="image" value="Dalej"  src="<?php echo image_path('dalej.jpg') ?>"/></div>
</form>
      </div>
  </div>

<?php endif; ?>
