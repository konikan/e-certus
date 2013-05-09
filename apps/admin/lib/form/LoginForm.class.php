<?php

class LoginForm extends BaseForm
{
    public function configure()
    {
        $this->widgetSchema['username']    =   new sfWidgetFormInput();
        $this->widgetSchema['password'] =   new sfWidgetFormInputPassword();
        $this->widgetSchema->setNameFormat('login[%s]');

        $this->validatorSchema['username'] =   new sfValidatorString(array('required' => true), array('required' => 'Musisz podać login'));
        $this->validatorSchema['password'] =   new sfValidatorString(array('required' => true), array('required' => 'Musisz podać  hasło'));

        $this->widgetSchema['username']->setLabel('Użytkownik');
        $this->widgetSchema['password']->setLabel('Hasło');

        //$this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again'));
    }
}

?>
