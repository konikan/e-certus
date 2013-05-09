<style type="text/css">
.hide
{
 display:none;
}
.show
{
    display: block;
}
</style>

<script type="text/javascript">
function showhide(element_id)
{
    element = document.getElementById(element_id);
    if(element)
    {
        if(element.className != 'hide')
        {
            element.className = 'hide';
        }
        else
        {
            element.className = 'show';
        }
    }
}
</script>
<div class="std" style="padding-left: 5px;">
<h1>Pomoc</h1>
<?php if(isset($questions)){ ?>
<!--
<script >
	$(function() {
		$( "#accordion" ).accordion({ active: false, alwaysOpen: true,autoheight: true });
	});
	</script>
-->
<div id="accordion" style="font-size: 12px;">
    <?php
    
    foreach ($questions as $question)
    {
    ?>

    <h3 onclick="showhide('childous_<?php echo $question->getId() ?>')" style="cursor: pointer; display: block;"><?php echo $question->getQuestion() ?></h3>
    <div class="hide" id="childous_<?php echo $question->getId() ?>" >
            <?php echo $question->getReply() ?>
        </div>

    <?php } ?>
        </div>
<?php } ?>
</div>