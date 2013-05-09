<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class NewOrderShippingForm extends BaseForm
{
    public function configure()
    {
       

        $this->widgetSchema['order_courier'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['order_courier'] =  new sfValidatorPass();

        $this->widgetSchema['accept_courier_rules'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['accept_courier_rules'] =  new sfValidatorBoolean(array('required' => true), array('required' => 'Wymagana akceptacja'));

        $this->widgetSchema['order_courier']->setLabel("Zamów kuriera po odbór przesyłki");
        $this->setDefault('order_courier', 'on');
        $sender_form = new UserSenderForm();
        $recipient_form = new UserRecipientForm();

        $this->embedForm('sender', $sender_form);
        $this->embedForm('recipient', $recipient_form);

        $this->widgetSchema['search_sender'] = new sfWidgetFormInput();
        $this->widgetSchema['search_sender']->setLabel("Szukaj nadawcy:");
      //  $this->widgetSchema['sender']['sender_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
     //   $this->widgetSchema['sender']['sender_id']->setOption('renderer_options', array(
    //        'model' => 'UserSender',
     //       'url'   => $this->getOption('url'),
     //   ));
        $this->validatorSchema['search_sender'] = new sfValidatorPass();
        $this->widgetSchema['sender']['country'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['created_at'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['updated_at'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_name'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_nip'] = new sfWidgetFormInput();
        $this->widgetSchema['sender']['company_post_code'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_city'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_street'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_home_nr'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_local_nr'] = new sfWidgetFormInputHidden();
        //$this->widgetSchema['sender']['is_company'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['name'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['surname'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender_save'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema['sender']['bank_name'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['bank_account'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['sender']['company_nip']->setLabel('NIP');
        $this->widgetSchema['sender']['bank_name']->setLabel('Nazwa banku');
        $this->widgetSchema['sender']['bank_account']->setLabel('Numer konta');
        
        $this->validatorSchema['sender_save'] = new sfValidatorPass();
        $this->validatorSchema['sender']['address'] = new sfValidatorPass();
        $this->validatorSchema['sender']['bank_name'] = new sfValidatorPass();
        $this->validatorSchema['sender']['bank_account'] = new sfValidatorPass();
        $this->validatorSchema['sender']['save'] = new sfValidatorBoolean(array('required' => false));

         $this->widgetSchema['sender_save']->setLabel("Zapisz nadawcę");

        $this->widgetSchema['search_recipient'] = new sfWidgetFormInput();
        $this->widgetSchema['recipient']['company_name'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_nip'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_post_code'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_city'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_street'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_home_nr'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['company_local_nr'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['is_company'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['name'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['surname'] = new sfWidgetFormInputHidden();
       
        $this->widgetSchema['recipient']['street'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['street_nr'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['local_nr'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient_save'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema['recipient_save']->setLabel('Zapisz odbiorcę');

        $this->validatorSchema['recipient_save'] = new sfValidatorPass();
        $this->validatorSchema['recipient']['country'] = new sfValidatorPass();
         $this->validatorSchema['recipient']['tel'] = new sfValidatorString(array('required' => true), array('required' => 'Wprowadź numer tel'));
        $this->validatorSchema['search_recipient'] = new sfValidatorPass();
         $this->widgetSchema['search_recipient']->setLabel('Szukaj odbiorcy:');

        $this->widgetSchema['recipient']['created_at'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['address']->setLabel("Ulica");
        $this->widgetSchema['recipient']['updated_at'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['recipient']['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema->setNameFormat('order[%s]');


    
    }

     public function getErrors()

      {

      $errors = array();



      // individual widget errors

      foreach ($this as $form_field)

      {

      if ($form_field->hasError())

      {

      $error_obj = $form_field->getError();

      if ($error_obj instanceof sfValidatorErrorSchema)

      {

      foreach ($error_obj->getErrors() as $error)

      {

      // if a field has more than 1 error, it'll be over-written

      $errors[$form_field->getName()] = $error->getMessage();

      }

      }

      else

      {

      $errors[$form_field->getName()] = $error_obj->getMessage();

      }

      }

      }



      // global errors

      foreach ($this->getGlobalErrors() as $validator_error)

      {

      $errors[] = $validator_error->getMessage();

      }



      return $errors;

      }
}
?>
