<?php

/**
 * ShippingTypesGroups form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class ShippingTypesGroupsForm extends BaseShippingTypesGroupsForm
{
  public function configure()
  {
      $this->widgetSchema->setLabels(array(

      'courier_id'  => 'Firma kurierska',
      'service_id'  => 'Identyfikator serwisowy',
      'name'        => 'Nazwa grupy',
      'name_tariff' => 'Nazwa cennikowa',
      'code'        => 'Kod usługi',
      'is_active'   => 'Aktywna',
      'type'        => 'Typ',
    ));
  }
}
