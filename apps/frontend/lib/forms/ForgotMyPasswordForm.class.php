<?php
class ForgotMyPasswordForm extends BaseForm
{
    public function configure()
    {
        $this->widgetSchema['email']    =   new sfWidgetFormInput();
        $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
  'public_key' => '6LeRxcISAAAAAKCIhcuAhaiiExZMStYfpK06gzCy'
));

$this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
  'private_key' =>'6LeRxcISAAAAAIJHkkD-6iY-fUCB4v_0C5RRlluV'
));

$this->validatorSchema['email'] = new sfValidatorEmail(array('required'=>true), array('required'=>'Pole wymagane', 'invalid'=>'Błędny adres e-mail'));
        $this->widgetSchema->setNameFormat('forgot[%s]');

       

        $this->widgetSchema['email']->setLabel('Twój e-mail:');
        $this->widgetSchema['captcha']->setLabel('Wprowadź tekst z obrazka:');
        
    }
}
?>
