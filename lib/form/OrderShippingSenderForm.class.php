<?php

/**
 * OrderShippingSender form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class OrderShippingSenderForm extends BaseOrderShippingSenderForm
{
  public function configure()
  {

      $this->widgetSchema['company_name'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['company_street'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['company_home_nr'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['company_local_nr'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['company_post_code'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['company_city'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['address'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['surname'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['order_id'] = new sfWidgetFormInputHidden();


       $this->widgetSchema->setLabels(array(
            'id'                => 'Identyfikator',
            'created_at'        => 'Utworzono',
            'updated_at'        => 'Modyfikowano',
            'is_company'        => 'Firma',
            'sender_name'       => 'Nazwa nadawcy',
            'contact_name'      => 'Osoba kontaktowa',
            'name'              => 'Imię',
            'surname'           => 'Nazwisko',
            'postcode'          => 'Kod pocztowy',
            'city'              => 'Miejscowość',
            'street'            => 'Ulica',
            'street_nr'         => 'Numer domu',
            'local_nr'          => 'Numer lokalu',
            'tel'               => 'Telefon',
            'email'             => 'E-mail',
            'address'           => 'Adres',
            'company_name'      => 'Nazwa firmy',
            'company_nip'       => 'Nazwa firmy',
            'company_post_code' => 'Kod pocztowy',
            'company_city'      => 'Miasto',
            'company_street'    => 'Ulica',
            'company_home_nr'   => 'Numer domu',
            'company_local_nr'  => 'Numer lokalu',
            'order_id'          => 'Numer zamówienia',
    ));

  }
}
