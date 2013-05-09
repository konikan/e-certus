<?php

/**
 * UserSender form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class UserSenderForm extends BaseUserSenderForm
{
  public function configure()
  {

      $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'is_company'        => new sfValidatorBoolean(array('required' => false)),
      'sender_name'       => new sfValidatorString(array('max_length' => 255), array('required' => 'Podaj nazwę nadawcy')),
      'contact_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'surname'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postcode'          => new sfValidatorString(array('max_length' => 6, 'required' => true), array('required' => 'Podaj kod pocztowy', 'max_length'=>'Max. 6 znaków')),
      'city'              => new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Podaj miejscowość')),
      'address'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'            => new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Podaj nazwę ulicy')),
      'street_nr'         => new sfValidatorString(array('max_length' => 10, 'required' => true), array('required' => 'Podaj numer domu')),
      'local_nr'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'tel'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'             => new sfValidatorEmail(array( 'required' => true), array('required' => 'Podaj adres e-mail', 'invalid'=>'Podaj poprawny adres e-mail')),
      'company_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_nip'       => new sfValidatorString(array('max_length' => 255, 'required' => false), array('required' => 'Podaj NIP firmy')),
      'company_post_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_city'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_street'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_home_nr'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'company_local_nr'  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));
    $this->validatorSchema['save'] = new sfValidatorPass();
       $this->widgetSchema->setLabels(array(

      'user_id'           => 'Uzytkownik',
      'created_at'        => 'Utworsono',
      'updated_at'        => 'Modyfikowano',
      'is_company'        => 'Firma',
      'sender_name'       => 'Nazwa nadawcy',
      'contact_name'      => 'Osoba kontaktowa',
      'name'              => 'Imię',
      'surname'           => 'Nazwisko',
      'postcode'          => 'Kod pocztowy',
      'city'              => 'Miejscowość',
      'address'           => 'Adres',
      'street'            => 'Ulica',
      'street_nr'         => 'Numer domu',
      'local_nr'          => 'Numer lokalu',
      'tel'               => 'Telefon',
      'email'             => 'e-mail',
      'company_name'      => 'Nazwa firmy',
      'company_nip'       => 'NIP',
      'company_post_code' => 'Kod pocztowy',
      'company_city'      => 'Miejscowość',
      'company_street'    => 'Ulica',
      'company_home_nr'   => 'Numer domu',
      'company_local_nr'  => 'Numer lokalu',
    ));
  }
}
