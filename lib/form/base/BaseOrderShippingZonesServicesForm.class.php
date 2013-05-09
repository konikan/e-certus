<?php

/**
 * OrderShippingZonesServices form base class.
 *
 * @method OrderShippingZonesServices getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseOrderShippingZonesServicesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'order_id'     => new sfWidgetFormInputHidden(),
      'service_id'   => new sfWidgetFormInputHidden(),
      'option_value' => new sfWidgetFormInputText(),
      'option_price' => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'order_id'     => new sfValidatorPropelChoice(array('model' => 'OrderShipping', 'column' => 'id', 'required' => false)),
      'service_id'   => new sfValidatorPropelChoice(array('model' => 'ZonesServices', 'column' => 'id', 'required' => false)),
      'option_value' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'option_price' => new sfValidatorNumber(array('required' => false)),
      'amount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_shipping_zones_services[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderShippingZonesServices';
  }


}
