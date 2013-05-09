<?php

/**
 * Courier form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class CourierForm extends BaseCourierForm
{
  public function configure()
  {
       $this->widgetSchema['desc'] = new sfWidgetFormTextareaTinyMCE();

      $this->widgetSchema->setLabels(array(
      'name'          => 'Nazwa',
      'available'     => 'Dostępny',
      'client_nr'     => 'Numer klienta',
      'api_key'       => 'Klucz API',
      'login'         => 'Login',
      'pass'          => 'Hasło',
      'petrol_charge' => 'Opłata paliwowa',
    ));
  }
}
