<div style="margin: 30px 0px 0px 0px;">
<center>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<form action="<?php echo url_for('user/login') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
        <td colspan="2" align="right">
            <input type="submit" value="Zaloguj" />
      </td>
    </tr>
  </table>
</form>
</center>
</div>

