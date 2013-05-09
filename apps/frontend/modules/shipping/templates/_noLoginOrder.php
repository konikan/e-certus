<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="std" style="padding-bottom: 10px;" >
			
			<div style="border-right: 1px solid silver;  float: left;width: 300px; padding-left: 30px;">

                                <!-- Login Form -->
                                <form action="<?php echo url_for('login/index') ?>" method="POST">
                                <h2>Zaloguj się</h2>
                                <table>
				<?php echo $login_form; ?>
                                </table>
                                <div style="float: left;"> <input type="image" value="Zaloguj"  src="<?php echo image_path('zaloguj_sie.jpg') ?>"/></div>
                                </form>

		<form method="post" action="<?php echo url_for('shipping/order') ?>">
                         
			

                             <div style="float: left; margin-left: 10px;"><input type="submit" value=""  style="background-image: url('<?php echo image_path('zarejestruj_1.jpg') ?>'); width: 86px; height: 30px; border: none;"  name="quick_register"/></div>
                       
	
                        </div>
		
                        <div style=" float: left; width:300px; padding-left: 30px; ">
                            
                            <h2>Nadaj szybko paczkę</h2>
				<!-- Register Form -->
                                
                                <table>
                                    <?php echo $sender_form; ?>
                                </table>
                                <input type="submit" style="background-image: url('<?php echo image_path('nadaj_szybko_paczke.jpg') ?>'); width: 121px; height: 30px;" name="quick_sender" value="" />
                               
                            </form>
			</div>
		
</div>