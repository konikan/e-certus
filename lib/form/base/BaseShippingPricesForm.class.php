<?php

/**
 * ShippingPrices form base class.
 *
 * @method ShippingPrices getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingPricesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'courier_id'            => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false)),
      'product_id'            => new sfWidgetFormPropelChoice(array('model' => 'ShippingProducts', 'add_empty' => false)),
      'service_id'            => new sfWidgetFormInputText(),
      'price'                 => new sfWidgetFormInputText(),
      'prom_price'            => new sfWidgetFormInputText(),
      'is_dynamic_price'      => new sfWidgetFormInputCheckbox(),
      'dynamic_price'         => new sfWidgetFormInputText(),
      'dynamic_price_what_if' => new sfWidgetFormInputText(),
      'show'                  => new sfWidgetFormInputCheckbox(),
      'is_default'            => new sfWidgetFormInputCheckbox(),
      'is_prom'               => new sfWidgetFormInputCheckbox(),
      'is_available'          => new sfWidgetFormInputCheckbox(),
      'notice'                => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'courier_id'            => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id')),
      'product_id'            => new sfValidatorPropelChoice(array('model' => 'ShippingProducts', 'column' => 'id')),
      'service_id'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price'                 => new sfValidatorNumber(array('required' => false)),
      'prom_price'            => new sfValidatorNumber(array('required' => false)),
      'is_dynamic_price'      => new sfValidatorBoolean(array('required' => false)),
      'dynamic_price'         => new sfValidatorNumber(array('required' => false)),
      'dynamic_price_what_if' => new sfValidatorNumber(array('required' => false)),
      'show'                  => new sfValidatorBoolean(array('required' => false)),
      'is_default'            => new sfValidatorBoolean(array('required' => false)),
      'is_prom'               => new sfValidatorBoolean(array('required' => false)),
      'is_available'          => new sfValidatorBoolean(array('required' => false)),
      'notice'                => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_prices[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingPrices';
  }


}
