<?php
class UserLoginForm extends BaseForm
{
    public function configure()
    {
        $this->widgetSchema['email']    =   new sfWidgetFormInput();
        $this->widgetSchema['password'] =   new sfWidgetFormInputPassword();
        $this->widgetSchema->setNameFormat('login[%s]');

        $this->validatorSchema['email'] =   new sfValidatorEmail(array('required' => true), array('required' => 'Musisz podać adres e-mail'));
        $this->validatorSchema['password'] =   new sfValidatorString(array('required' => true), array('required' => 'Musisz podać adres hasło'));

        $this->widgetSchema['email']->setLabel('E-mail');
        $this->widgetSchema['password']->setLabel('Hasło');
    }
}

?>
