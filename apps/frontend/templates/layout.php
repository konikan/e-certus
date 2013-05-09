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
      <script type="text/javascript"  >
// zegar cyfrowy

function funClock(){
  var runTime = new Date();
  var hours = runTime.getHours();
  var minutes = runTime.getMinutes();
  var seconds = runTime.getSeconds();
  if (hours <= 9) hours = "0" + hours;
  if (minutes <= 9) minutes = "0" + minutes;
  if (seconds <= 9) seconds = "0" + seconds;
  movingtime = hours + ":" + minutes + ":" + seconds;
  if(e=document.getElementById('go')) e.innerHTML = movingtime;
  setTimeout("funClock()",1000);
}

//window.onload = funClock; // załaduj funkcje
      </script>

      <div class="main_content">
          <div class="top">
              <div style="float: right; margin-right: 190px; height: 30px;">
                  <div style="float: left; margin-top: 5px;">
                      <object width="150" height="150"><param name="movie" value="http://www.csalim.com/clocks/419705.swf"><embed src="http://www.csalim.com/clocks/419705.swf" width="65" height="65"></embed></object>
                  </div>
                  <div style="float: left; margin: 2px 0px 0px 5px; font-weight: bold;"><?php echo date("Y-m-d"); ?>
                  <br/>
                  <?php

$tmp['date'] = date("Y-m-d");
$tmp['day_of_week']['en'] = date('l', strtotime($tmp['date']));

// Przy ustawionej dacie 09-07-2009 wyjdzie w rezultacie Tuesday
//echo $tmp['day_of_week']['en'];

// Jeżeli chcemy aby dzień tygodnia był po polsku
switch($tmp['day_of_week']['en'])
{
 case 'Monday': $tmp['day_of_week']['pl'] = 'Poniedziałek'; break;
 case 'Tuesday': $tmp['day_of_week']['pl'] = 'Wtorek'; break;
 case 'Wednesday': $tmp['day_of_week']['pl'] = 'Środa'; break;
 case 'Thursday': $tmp['day_of_week']['pl'] = 'Czwartek'; break;
 case 'Friday': $tmp['day_of_week']['pl'] = 'Piątek'; break;
 case 'Saturday': $tmp['day_of_week']['pl'] = 'Sobota'; break;
 case 'Sunday': $tmp['day_of_week']['pl'] = 'Niedziela'; break;
}

echo $tmp['day_of_week']['pl'];
?>
                 
                  </div>
              </div>

              <div class="menu">
                  <div class="nadaj"><?php echo link_to('Nadaj przesyłkę','shipping/packageDimensions') ?></div>
                  <div class="koszt"><?php echo link_to('Aktualności','page/index?name=page_info') ?></div>
                  <div class="cennik"><?php echo link_to('Cenniki','page/index?name=page_tariff') ?></div>
                  <div class="firma"><?php echo link_to('O nas','page/index?name=page_about') ?></div>
                  <div class="pomoc"><?php echo link_to('Pomoc','questions/index') ?></div>
                  <div class="kontakt"><?php echo link_to('Kontakt','page/index?name=page_contact') ?></div>
              </div>
              <a href="<?php echo url_for('shipping/packageDimensions'
                      ) ?>" style="width: 500px; height: 135px; display: block; float: right; margin-top: 54px; position: absolute;margin-left: 499px;"></a>
          </div>
          
          <div class="content">
            <div class="left">
                <div class="box1_top">
                    <div class="box_title">Użytkownik:</div>
                    <div class="box1">
                        <?php  ?>
                        <?php include_slot('login', get_component('login', 'loginForm')); ?>
                

                </div>

                </div>
                
                
                
                   
                <?php include_component('shipping', 'shippingInfo') ?>
                
               
                
                <div class="box2_top">
                    <div class="box_title">Namierzanie przesyłki:</div>
                <div class="box2">

 <div class="user_info">
                    <form action="<?php echo url_for('shipping/search') ?>" method="post">
                   
                        
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                    <label for="shipping_search_dhl" >DHL:</label>
                                </td>
                                <td><input type="text" name="shipping_search_dhl"  /></td>
                        <td>
                        <input type="image" src="<?php echo image_path('szukaj.jpg') ?>" value="szukaj" />
                        </td>
                            </tr>
                        </table >
                             </form>
                    <form action="http://wwwapps.ups.com/etracking/tracking.cgi" enctype="application/x-www-form-urlencoded" target="_blank" method="post">
                        <table cellpadding="0" cellspacing="0">
                      <tr>
                          <td>
                    <label for="shipping_search_ups" >UPS:</label>
                          </td>
                          <td>
                       <input name="tracknum" size="20" type="text" class="sw_form_long" />
                       <input type="hidden" name="loc" value="pl_PL"/>
                          </td>
                          <td>
                        <input type="image" src="<?php echo image_path('szukaj.jpg') ?>" value="szukaj" />
                          </td>
                      </tr>
                        </table>




                                    
                        </form>
                        </div>
 
                    
                   
                    <?php //include_slot('box3'); ?>
                    <div style="clear: both;"></div>

                    
                    <div style="padding: 0px 0px 0px 0px;float: left; margin: 0px 0px 0px 0px;position: relative;"  >
                    <div id="flashcontent" >
                    
                    </div>
                    <script type="text/javascript">
                    swfobject.embedSWF("<?php echo sfContext::getInstance()->getRequest()->getRelativeUrlRoot() ?>/images/c6.swf", "flashcontent", "260", "200", "9.0.0");
                    </script>
                    </div>
                    <div  style="padding: 0px 0px 0px 0px;">
                        <?php echo image_tag('spedycja.jpg'); ?>
                    </div>
                    
                </div>
                </div>
                
                
          </div>

          <div class="center">
              <!--
              <div class="top"></div>
              -->
              <div >
                    <?php echo $sf_content ?>
              </div>

          </div>
              <div style="clear: both;"></div>

               
          </div>
         
          <div class="bootom">
               <div class="down_menu">
                   
                   <?php echo link_to('Nadaj przesyłkę','shipping/calculate') ?>
                   <?php echo link_to('Aktualności','page/index?name=page_info') ?>
                   <?php echo link_to('Cenniki','page/index?name=page_tariff') ?>
                   <?php echo link_to('O nas','page/index?name=page_about') ?>
                   <?php echo link_to('Pomoc','questions/index') ?>
                   <?php echo link_to('Kontakt','page/index?name=page_contact') ?>
                   <?php echo link_to('Regulamin','page/index?name=page_reg') ?>
                   <?php echo link_to('Zasady pakowania','page/index?name=page_rules') ?>
                  
               </div>
          </div>
      </div>
  </body>
</html>
