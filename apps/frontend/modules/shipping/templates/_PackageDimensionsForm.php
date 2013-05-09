<?php if(isset($form)): ?>

<form action="<?php echo url_for('shipping/packageDimensions') ?>" method="POST" name="package_dimension">
    <table class="dimensions_form">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
          <input type="image" value="Dalej"  src="<?php echo image_path('dalej.jpg') ?>"/>
      </td>
    </tr>
  </table>
</form>
<?php endif; ?>
