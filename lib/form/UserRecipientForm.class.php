<?php

/**
 * UserRecipient form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class UserRecipientForm extends BaseUserRecipientForm
{
  public function configure()
  {


      $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'is_company'        => new sfValidatorBoolean(array('required' => false)),
      'recipient_name'    => new sfValidatorString(array('max_length' => 255), array('required' => 'Podaj nazwę odbiorcy')),
      'contact_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'surname'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postcode'          => new sfValidatorString(array('max_length' => 6, 'required' => true), array('required' => 'Podaj kod pocztowy', 'max_length'=>'Max. 6 znaków')),
      'city'              => new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Podaj miejscowość')),
      'address'           => new sfValidatorString(array('max_length' => 255), array('required' => 'Podaj adres')),
      'street'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street_nr'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'local_nr'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'tel'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_nip'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_post_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_city'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_street'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_home_nr'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'company_local_nr'  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));
     $this->widgetSchema->setLabels(array(

      'user_id'           => 'Uzytkownik',
      'created_at'        => 'Utworzono',
      'updated_at'        => 'Modyfikowano',
      'is_company'        => 'Firma',
      'recipient_name'    => 'Nazwa odbiorcy',
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
