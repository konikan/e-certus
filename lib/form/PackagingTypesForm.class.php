<?php

/**
 * PackagingTypes form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class PackagingTypesForm extends BasePackagingTypesForm
{
  public function configure()
  {
      $this->widgetSchema->setLabels(array(

      'group_id'   => 'Grupa',
      'courier_id' => 'Firma kurierska',
      'name'       => 'Nazwa opakowania',
      'service_id' => 'Identyfikator serwisowy',
      'desc'       => 'Opis',
      'max_width'  => 'Maksymalna szerowkość',
      'max_height' => 'Maksymalna wysokość',
      'max_length' => 'Maksymalna długość',
      'max_weight' => 'Maksymalna waga',
      'max_lenght' => 'Maksymalna suma wymiarów',
      'available'  => 'Dostępne',
    ));
  }
}
