<?php

/**
 * OrderShipping form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class OrderShippingForm extends BaseOrderShippingForm
{
  public function configure()
  {
       unset(
      $this['order_shipping_options_list']

    );

        $payments = array(""=>"", 1 => 'Płatność online', 2 => 'Przelew bankowy', 3 => 'Kredyt');
        $status = array(""=>"", 0 => 'Nowe', 1 => 'Przekazane do firmy kurierskiej', 2 => 'Zrealizowane', 3=>'Anulowane');
        $this->widgetSchema['paid_type'] =  new sfWidgetFormSelect(array('choices' => $payments));
        $this->widgetSchema['status'] =  new sfWidgetFormSelect(array('choices' => $status));
      $sender = $this->getObject()->getSender();
      if(!$sender)
      {
        $sender =  new OrderShippingSender();
      }
      $sender->setOrderShipping($this->getObject());

      $recipient = $this->getObject()->getRecipient();
      if(!$recipient)
      {
          $recipient = new OrderShippingRecipient();
      }
      $recipient->setOrderShipping($this->getObject());

     $options = $this->getObject()->getOrderShippingOptionss();

     foreach ($options as $option)
     {
         $this->embedForm('option_'.$option->getOptionId(), new OrderShippingOptionsForm($option));
     }

      $this->embedForm('sender', new OrderShippingSenderForm($sender));
      $this->embedForm('recipient', new OrderShippingRecipientForm($recipient));


      $this->widgetSchema->setLabels(array(
      'id'                          => 'Identyfikator',
      'user_id'                     => 'Użytkownik',
      'number'                      => 'Numer',
      'created_at'                  =>  'Data utowrzenia',
      'updated_at'                  => 'Data modyfikacji',
      'status'                      =>  'Status',
      'outher_order_number'         =>  'Zewnętrzny numer zamówienia',
      'list_number'                 => 'Numer listu przewozowego',
      'courier_id'                  => 'Kurier',
      'width'                       => 'Szerokość',
      'height'                      => 'Wysokość',
      'length'                      => 'Długość',
      'normal_weight'               => 'Dekralowana waga',
      'weight'                      => 'Waga',
      'type_id'                     => 'Rodzaj usługi',
      'packaging_type_id'           => 'Rodzaj opakowania',
      'date_of_receipt'             => 'Data odbioru',
      'receipt_time_start'          => 'Czas od (odbioru)',
      'receipt_time_end'            => 'Czas do (odbioru)',
      'self_giving'                 => 'Nadanie samodzielne',
      'self_giving_date'            => 'Data nadania',
      'is_paid'                     => 'Zapłacono',
      'paid_type'                   => 'Rodzaj płatności',
      'number_of_packages'          => 'Ilość przesyłek',
      'amount'                      => 'Wartość netto',
      'vat'                         => 'Vat',
      'vat_amount'                  => 'Kwota Vat',
      'total_amount'                => 'Wartość brutto',
      'order_shipping_options_list' => 'Opcje',
    ));

  }
}
