<?php
if(isset($user))
{

?>
<div>
    <?php echo $mail_add_text ?>
</div>
<br/>
<a href="<?php echo url_for('register/active?user='.$user->getId(), true) ?>"><?php echo url_for('register/active?user='.$user->getId(), true) ?></a>
<?php } ?>
