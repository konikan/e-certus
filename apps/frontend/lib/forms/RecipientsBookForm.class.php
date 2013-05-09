<?php

class RecipientsBookForm extends UserRecipientForm
{
    public function configure()
  {
        $this->widgetSchema['created_at']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['updated_at']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['user_id']         =   new sfWidgetFormInputHidden();
        //$this->widgetSchema['address']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['company_name']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['name']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['surname']         =   new sfWidgetFormInputHidden();
        $this->widgetSchema['company_street']       =   new sfWidgetFormInputHidden();
        $this->widgetSchema['street']       =   new sfWidgetFormInputHidden();
        $this->widgetSchema['street_nr']       =   new sfWidgetFormInputHidden();
        $this->widgetSchema['local_nr']       =   new sfWidgetFormInputHidden();


        $this->widgetSchema['company_home_nr']      =   new sfWidgetFormInputHidden();
        $this->widgetSchema['company_local_nr']     =   new sfWidgetFormInputHidden();
        $this->widgetSchema['company_post_code']    =   new sfWidgetFormInputHidden();
        $this->widgetSchema['company_city']         =   new sfWidgetFormInputHidden();
        

    $this->widgetSchema['recipient_name']->setLabel('Nazwa odbiorcy');
    $this->widgetSchema['is_company']->setLabel('Frima');
    $this->widgetSchema['city']->setLabel('Miasto');
    $this->widgetSchema['contact_name']->setLabel('Osoba kontaktowa');
    $this->widgetSchema['company_nip']->setLabel('NIP');
    $this->widgetSchema['postcode']->setLabel('Kod pocztowy');
    $this->widgetSchema['street_nr']->setLabel('Numer domu');
    $this->widgetSchema['local_nr']->setLabel('Numer lokalu');
    $this->widgetSchema['street']->setLabel('Ulica');
}
}
?>
