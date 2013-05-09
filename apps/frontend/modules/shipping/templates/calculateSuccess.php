
<?php //echo $ajax ?>
<script type="text/javascript" >
function setIns(cashId,insId)
{
    cash_check = document.getElementById(cashId);
    ins_check = document.getElementById(insId);
    if(cash_check.checked == true)
    {
       ins_check.checked = true;
       amount_cash = document.getElementById(cashId+'_amount').value;
       amount_ins =  document.getElementById(insId+'_amount').value;
       if(amount_cash >= amount_ins)
       {
           document.getElementById(insId+'_amount').value =  document.getElementById(cashId+'_amount').value;
       }

       
    }
    else if(cash_check.checked == false) {
        document.getElementById(cashId+'_amount').value = "";
    }
}

</script>
<?php if(isset($form) && isset($couriers) && (!isset($ajax) || $ajax == false) ): ?>
<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<?php if(isset($text_box1)){ ?>
<?php slot('box1') ?>
 <?php    echo $text_box1; ?>
<?php end_slot() ?>

<?php }?>
<?php include_partial('shipping/steps', array('sel'=>1)) ?>
    <div style="float: left;"></div>
    <div style="float: right;">
        

    </div>
<div style="clear: both;"></div>
<div class="select_shipping">
<?php echo form_remote_tag(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true, 'name'=>$form->getName(), 'id'=>$form->getName()),array('name'=>$form->getName(), 'id'=>$form->getName())) ?>
<?php if($package_dimension['typ'] == 1) { ?>
 <?php echo $form->renderHiddenFields(false) ?>
<?php $shipping_options2 = $shipping_options; ?>
 <center>
    <?php foreach ($couriers as $courier): ?>

     <div <?php echo (count($couriers)>1)?'style="float: left;"':'' ?>>
        <table class="calculate">
                <tr >
                    <td align="center" colspan="2" style="border: 0px solid silver;">
                        <div style="font-weight: bold; font-size: 12pt;"><?php echo $courier->getName(); //echo image_tag(strtolower($courier->getName().'_logo.gif')) ?></div>
                        Waga do wyceny: <div style="font-weight: bold; " id="<?php echo $courier->getName()?>_weight"><?php echo $package_dimension[$courier->getName().'_weight']?> kg.</div>
                        <?php $is = 0; ?>
                           
                        <?php foreach ($shipping_types as $st){

                            if($st->getCourierId() == $courier->getId()){
                                $types = $st->getShippingTypessByWeight($package_dimension[$courier->getName().'_weight']);
                                if(isset($types) && sizeof($types)>0)
                                    $is = 1;
                                break;
                            }
                            else
                            {
                                continue;
                            }
                        }
                            ?>
                        <?php if($is == 0): ?>
                            <div>Wybrana przesyłka nie dostępna w tej firmie kurierskiej.</div>
                           </td>
                </tr>
        </table>
        <?php else: ?>

                        
                        Cena netto: <div style="font-weight: bold; font-size: 12pt;" id="<?php echo $courier->getName()?>_tprice"><?php echo (isset($values))?number_format($values[$courier->getName().'_price'],2,',','').' zł':'' ?></div>
                        Cena brutto: <div style="font-weight: bold; font-size: 12pt;" id="<?php echo $courier->getName()?>_tprice_vat"><?php echo (isset($values))?number_format($values[$courier->getName().'_price_vat'],2,',','').' zł':'' ?></div>
                        <div><input style="background-image: url('<?php echo image_path('wybierz.jpg') ?>'); width: 121px; height: 30px;" type="button" name="<?php echo 'sel_'.$courier->getId() ?>" value="" onclick="document.getElementById('<?php echo $form->getName() ?>_sel').value=<?php echo $courier->getId() ?>;this.form.submit();" /></div>
                    
                <tr>
                    <td colspan="2"><?php echo $form[$courier->getName().'_type']->render(array('onclick'=>remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' )))) ?></td>
                </tr>
                
                    <?php
                    $user = $sf_user->getAttribute('user', null);
                        foreach ($shipping_options as $so)
                        {
                            if($so->getCourierId() == $courier->getId() )
                            {
                                if($so->getIsPublicAccess() != 1 && is_null($user))
                                {
                                    continue;
                                }
                                else if(isset($user))
                                {
                                    //echo $user->getIsCashOnDelivery();
                                    if($so->getCode() == "cash_on_delivery"  && $user->getIsCashOnDelivery() != 1)
                                    {
                                        //echo "ok";
                                        continue;
                                    }
                                }

                                ?>
                                <tr>

                                     <?php
                                        $ins_cash = null;
                                        $ins_cash = array();
                                        if($so->getCode() == 'cash_on_delivery')
                                        {

                                             
                                           for ($k=0;$k<count($shipping_options);$k++)
                                           {

                                            if( ( $shipping_options[$k]->getCourierId() == $so->getCourierId() ) &&  ($shipping_options[$k]->getCode() == 'ins') )
                                            {


                                                    $ins_cash['cash_id'] = $so->getId();
                                                    $ins_cash['ins_id'] = $shipping_options[$k]->getId();


                                               }

                                            }
                                           
                                         }

                                         
                                         ?>
                                         
                                       <?php if(isset($ins_cash['cash_id']) && isset($ins_cash['ins_id']) && $ins_cash['cash_id'] != "" && $ins_cash['ins_id'] !=""){  ?>
                                        <td width="20px;"><?php echo $form[$courier->getName().'_option_'.$so->getId()]->render(array('onclick'=>  "setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' )), 'onchange'=> "setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'document.'.$form->getName().'.serialize(this)','method'=>'post' )) )); ?></td>
                                    <?php } else { ?>
                                         <td width="20px;"><?php echo $form[$courier->getName().'_option_'.$so->getId()]->render(array('onclick'=>  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'document.'.$form->getName().'.serialize(this)','method'=>'post' )) )); ?></td>
                                   <?php } ?>
                                  


                                    
                                    <th>
                                        <?php
                                        
                                            echo $form[$courier->getName().'_option_'.$so->getId()]->renderLabel();
                                            if($so->getAdditionalAmount())
                                            {
                                                if(isset($ins_cash['cash_id']) && isset($ins_cash['ins_id']) && $ins_cash['cash_id'] != "" && $ins_cash['ins_id'] !=""){
                                                    echo $form[$courier->getName().'_option_'.$so->getId().'_amount']->render(array('onkeyup'=>"setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' ))));
                                                }
                                                else
                                                {
                                                    echo $form[$courier->getName().'_option_'.$so->getId().'_amount']->render(array('onkeyup'=>  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' ))));
                                                }

                                            }    
                                        ?>
                                    </th>

                                
                                <?php

                                

                                ?>
                                </tr>
                             <?php }
                            
                        }
                    
                    ?>
                
            </table>
            <?php endif; ?>
    </div>
<?php



 

?>

    <?php endforeach; ?>
   

</center>

</div>
<div style="clear: both;"></div>
 <?php }
 else
 {
     foreach ($couriers as $courier){ ?>
 <?php echo $form->renderHiddenFields(false) ?>
<div <?php echo (count($couriers)>1)?'style="float: left;"':'' ?>>
    <table class="calculate">
                <tr >
                    <td align="center" colspan="2" style="border: 0px solid silver;">
                        <div style="font-weight: bold; font-size: 12pt;"><?php echo $courier->getName(); //echo image_tag(strtolower($courier->getName().'_logo.gif')) ?></div>
                        Waga do wyceny: <div style="font-weight: bold; " id="<?php echo $courier->getName()?>_weight"><?php echo $package_dimension[$courier->getName().'_weight']?> kg.</div>
                        
                         <?php if($values[$courier->getName().'_price'] != true): ?>
                            <div>Wybrana przesyłka nie dostępna w tej firmie kurierskiej.</div>
                           </td>
                </tr>
        </table>
        <?php else: ?>
                         Cena netto: <div style="font-weight: bold; font-size: 12pt;" id="<?php echo $courier->getName()?>_tprice"><?php echo (isset($values))?number_format($values[$courier->getName().'_price'],2,',','').' zł':'' ?></div>
                        Cena brutto: <div style="font-weight: bold; font-size: 12pt;" id="<?php echo $courier->getName()?>_tprice_vat"><?php echo (isset($values))?number_format($values[$courier->getName().'_price_vat'],2,',','').' zł':'' ?></div>
                        <div><input style="background-image: url('<?php echo image_path('wybierz.jpg') ?>'); width: 121px; height: 30px;" type="button" name="<?php echo 'sel_'.$courier->getId() ?>" value="" onclick="document.getElementById('<?php echo $form->getName() ?>_sel').value=<?php echo $courier->getId() ?>;this.form.submit();" /></div>
                    
                    </td>
                </tr>
                
                
                 <?php
                    $user = $sf_user->getAttribute('user', null);
                        foreach ($shipping_options as $so)
                        {
                            if($so->getZones()->getCourierId() == $courier->getId() && $values[$courier->getName().'_zone_id'] == $so->getZoneId())
                            {
                                if($so->getIsPublicAccess() != 1 && is_null($user))
                                {
                                    continue;
                                }
                                else if(isset($user))
                                {
                                    //echo $user->getIsCashOnDelivery();
                                    if($so->getCode() == "cash_on_delivery"  && $user->getIsCashOnDelivery() != 1)
                                    {
                                        //echo "ok";
                                        continue;
                                    }
                                }

                                ?>
                                <tr>

                                     <?php
                                        $ins_cash = null;
                                        $ins_cash = array();
                                        if($so->getCode() == 'cash_on_delivery')
                                        {

                                             
                                           for ($k=0;$k<count($shipping_options);$k++)
                                           {

                                            if( ( $shipping_options[$k]->getZones()->getCourierId() == $so->getZones()->getCourierId() ) &&  ($shipping_options[$k]->getCode() == 'ins') )
                                            {


                                                    $ins_cash['cash_id'] = $so->getId();
                                                    $ins_cash['ins_id'] = $shipping_options[$k]->getId();


                                               }

                                            }
                                           
                                         }

                                         
                                         ?>
                                         
                                       <?php if(isset($ins_cash['cash_id']) && isset($ins_cash['ins_id']) && $ins_cash['cash_id'] != "" && $ins_cash['ins_id'] !=""){  ?>
                                        <td width="20px;"><?php echo $form[$courier->getName().'_option_'.$so->getId()]->render(array('onclick'=>  "setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' )), 'onchange'=> "setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'document.'.$form->getName().'.serialize(this)','method'=>'post' )) )); ?><?php  ?></td>
                                    <?php } else { ?>
                                         <td width="20px;"><?php echo $form[$courier->getName().'_option_'.$so->getId()]->render(array('onclick'=>  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'document.'.$form->getName().'.serialize(this)','method'=>'post' )) )); ?></td>
                                   <?php } ?>
                                  


                                    
                                    <th>
                                        <?php
                                        
                                            echo $form[$courier->getName().'_option_'.$so->getId()]->renderLabel();
                                            if($so->getAdditionalAmount())
                                            {
                                                if(isset($ins_cash['cash_id']) && isset($ins_cash['ins_id']) && $ins_cash['cash_id'] != "" && $ins_cash['ins_id'] !=""){
                                                    echo $form[$courier->getName().'_option_'.$so->getId().'_amount']->render(array('onkeyup'=>"setIns('calculate_".$courier->getName()."_option_".$ins_cash['cash_id']."','calculate_".$courier->getName()."_option_".$ins_cash['ins_id']."');".  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' ))));
                                                }
                                                else
                                                {
                                                    echo $form[$courier->getName().'_option_'.$so->getId().'_amount']->render(array('onkeyup'=>  remote_function(array('url' => 'shipping/calculate?ajax=true', 'update'=>'get_sum', 'script'=>true,'with'=>'$(\'calculate\').serialize()','method'=>'post' ))));
                                                }

                                            }    
                                        ?>
                                    </th>

                                
                                <?php

                                

                                ?>
                                </tr>
                             <?php }
                            
                        }
                    
                    ?>
                
                
    </table>
    <?php endif; ?>
</div>

     <?php } ?>
 <?php } ?>
<?php echo "</form>"; ?>
<script type="text/javascript" >
document.getElementById('<?php echo $form->getName() ?>_sel').value="";
</script>
<?php else: ?>
 <?php if(isset ($values)): ?>
<?php foreach ($couriers as $courier): ?>
          <script type="tetext/javascript" >
              /*alert('<?php echo $courier ?>');*/
            document.getElementById('<?php echo $courier->getName() ?>_tprice').innerHTML = '<?php echo number_format($values[$courier->getName().'_price'],2,',','').' zł' ?>';
               document.getElementById('<?php echo $courier->getName() ?>_tprice_vat').innerHTML = '<?php echo number_format($values[$courier->getName().'_price_vat'],2,',','').' zł' ?>';
               
          </script>
                   
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
<div id="get_sum"></div>
