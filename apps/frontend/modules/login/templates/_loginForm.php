<?php if(!isset($user)): ?>
<form action="<?php echo url_for('login/index') ?>" method="POST">
    <table class="login">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
          <input type="image" value="Zaloguj"  src="<?php echo image_path('zaloguj_sie.jpg') ?>"/>
          
                    <?php echo link_to(image_tag('zarejestruj_1.jpg'),'register/index') ?>
          <br/>
          <?php echo link_to('Zapomniałem hasła','login/forgotMyPassword') ?>
               
      </td>
    </tr>
  </table>
</form>

<?php else: ?>
<?php include_component('user', 'info') ?>
<?php endif; ?>
