
<?php if (isset($form)):?>
    <?php include_partial('shipping/dimensions_form',array('form'=>$form)) ?>
<?php endif;?>
<div class="film">
    <?php use_javascript("flowplayer-3.2.6.min.js") ?>
  <a
      href="<?php echo image_path("certus.flv") ?>"
			 style="display:block;width:426px;height:298px;"
			 id="player">
		</a>

		<!-- this will install flowplayer inside previous A- tag. -->
		<script>
                    flowplayer("player", "<?php echo image_path("flowplayer-3.2.7.swf"); ?>");
		</script>
</div>
<div style="clear: both;"></div>
<?php if(isset($main_page)){ ?>

<div class="main_page">
 <?php    echo $main_page; ?>

</div>
<?php }?>
<?php if(isset($text_box1)){ ?>
<?php slot('box1') ?>
 <?php    echo $text_box1; ?>
<?php end_slot() ?>

<?php }?>

