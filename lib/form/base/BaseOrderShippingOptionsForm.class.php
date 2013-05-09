<?php

/**
 * OrderShippingOptions form base class.
 *
 * @method OrderShippingOptions getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseOrderShippingOptionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'order_id'     => new sfWidgetFormInputHidden(),
      'option_id'    => new sfWidgetFormInputHidden(),
      'option_value' => new sfWidgetFormInputText(),
      'option_price' => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'order_id'     => new sfValidatorPropelChoice(array('model' => 'OrderShipping', 'column' => 'id', 'required' => false)),
      'option_id'    => new sfValidatorPropelChoice(array('model' => 'ShippingOptions', 'column' => 'id', 'required' => false)),
      'option_value' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'option_price' => new sfValidatorNumber(array('required' => false)),
      'amount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_shipping_options[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderShippingOptions';
  }


}
