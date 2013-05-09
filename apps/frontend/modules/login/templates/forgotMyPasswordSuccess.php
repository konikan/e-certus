<div class="std">
    <h1>Przypomnienie hasła</h1>
    <form action="<?php echo url_for('login/forgotMyPassword'); ?>" method="post">
<table>
<?php echo $form; ?>
</table>
        <input type="submit" value="Przypomnij" />
    </form>

</div>