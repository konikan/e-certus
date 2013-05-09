<?php
class RegisterUserForm extends UsersForm
{
  public function configure()
  {
      $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();

      $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
      $this->widgetSchema['password_rep'] = new sfWidgetFormInputPassword();

      $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['surname'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['postcode'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['city'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['email'] = new sfValidatorEmail(array('max_length' => 255, 'required' => true), array('required' => 'Musisz podać adres e-mail', 'invalid'=>'Podaj poprawny adres email.'));

      $this->validatorSchema->setPostValidator(new sfValidatorPropelUnique
(array('model' => 'Users', 'column' => array('email'), 'required' =>
true), array('invalid'=> 'Użytkownik o takim adresie już istnieje')));

      $this->widgetSchema['password']->setLabel('Hasło');
      $this->widgetSchema['password_rep']->setLabel('Powtórz hasło');
      $this->widgetSchema['name']->setLabel('Imię');
      $this->widgetSchema['surname']->setLabel('Nazwisko');
      $this->widgetSchema['postcode']->setLabel('Kod pocztowy');
      $this->widgetSchema['street']->setLabel('Ulica');
      $this->widgetSchema['street_nr']->setLabel('Numer domu');
      $this->widgetSchema['local_nr']->setLabel('Numer lokalu');
      $this->widgetSchema['city']->setLabel('Miejscowość');
      $this->widgetSchema['tel']->setLabel('Telefon');
      $this->widgetSchema['is_company']->setLabel('Firma');
      $this->widgetSchema['city']->setLabel('Miasto');
      $this->widgetSchema['postcode']->setLabel('Kod pocztowy');
      $this->widgetSchema['street']->setLabel('Ulica');
      $this->widgetSchema['street_nr']->setLabel('Numer domu');
      $this->widgetSchema['local_nr']->setLabel('Numer lokalu');
      $this->widgetSchema['tel']->setLabel('Telefon');
      $this->widgetSchema['company_name']->setLabel('Nazwa firmy');
      $this->widgetSchema['company_street']->setLabel('Ulica');
      $this->widgetSchema['company_home_nr']->setLabel('Numer domu');
      $this->widgetSchema['company_city']->setLabel('Miasto');
      $this->widgetSchema['company_local_nr']->setLabel('Numer lokalu');
      $this->widgetSchema['company_post_code']->setLabel('Kod pocztowy');
      $this->widgetSchema['company_nip']->setLabel('NIP');

      $this->widgetSchema['bank_name']->setLabel('Nazwa banku');
      $this->widgetSchema['bank_account']->setLabel('Numer rachunku');
      
      

      $this->widgetSchema->moveField('password_rep', 'after', 'password');
    $this->mergePostValidator(
      new sfValidatorSchemaCompare(
        'password', sfValidatorSchemaCompare::EQUAL, 'password_rep',
        array(), array('invalid' => 'Password and re-type password
must be the same.')));
  }
}

?>
