<?php

/**
 * Users form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class UsersForm extends BaseUsersForm
{
  public function configure()
  {
      $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(new sfValidatorPropelUnique
(array('model' => 'Users', 'column' => array('email'), 'required' =>
true), array('invalid'=> 'Użytkownik o takim adresie już istnieje')),
             
              )));

     $this->widgetSchema['password'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['password_ask'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['password_rep'] = new sfWidgetFormInputHidden();

      $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['surname'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['postcode'] = new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Musisz podać kod pocztowy'));
      $this->validatorSchema['city'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
      $this->validatorSchema['street'] = new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Musisz podać nazwę ulicy'));
      $this->validatorSchema['email'] = new sfValidatorEmail(array('max_length' => 255, 'required' => true), array('required' => 'Musisz podać adres e-mail', 'invalid'=>'Podaj poprawny adres email.'));

      $this->widgetSchema['name']->setLabel('Imię');
      $this->widgetSchema['surname']->setLabel('Nazwisko');
      //$this->widgetSchema['contact_name']->setLabel('Osoba kontaktowa');
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
      $this->widgetSchema['is_cash_on_delivery']->setLabel('Pobranie');

  }

  public function checkCompany(sfValidator $validator, array $values)
  {
    // if the field "name" is not editable, it does not exist in $values
    if (array_key_exists('is_company', $values) && $values['is_company'] == 'on')
    {
      $error = new sfValidatorError($validator,
          'The password must not be the same as the name');

      // throw an error schema so the error appears at the field "password"
      throw new sfValidatorErrorSchema($validator, array('is_company', $error));
    }
  }

}
