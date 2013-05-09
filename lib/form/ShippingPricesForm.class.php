<?php

/**
 * ShippingPrices form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class ShippingPricesForm extends BaseShippingPricesForm
{
  public function configure()
  {
      $this->widgetSchema['courier_id'] = new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false));
      $this->widgetSchema['product_id'] = new sfWidgetFormPropelChoice(array('model' => 'ShippingProducts', 'add_empty' => false));
  }
}
