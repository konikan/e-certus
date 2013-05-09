<?php

/**
 * ShippingTypesPrices form base class.
 *
 * @method ShippingTypesPrices getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingTypesPricesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'type_id'               => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypes', 'add_empty' => false)),
      'packaging_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'price'                 => new sfWidgetFormInputText(),
      'initial_weight'        => new sfWidgetFormInputText(),
      'final_weight'          => new sfWidgetFormInputText(),
      'is_prom'               => new sfWidgetFormInputCheckbox(),
      'prom_price'            => new sfWidgetFormInputText(),
      'is_dynamic_price'      => new sfWidgetFormInputCheckbox(),
      'dynamic_price'         => new sfWidgetFormInputText(),
      'dynamic_price_what_if' => new sfWidgetFormInputText(),
      'show'                  => new sfWidgetFormInputCheckbox(),
      'is_available'          => new sfWidgetFormInputCheckbox(),
      'notice'                => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'type_id'               => new sfValidatorPropelChoice(array('model' => 'ShippingTypes', 'column' => 'id')),
      'packaging_type_id'     => new sfValidatorPropelChoice(array('model' => 'PackagingTypes', 'column' => 'id', 'required' => false)),
      'price'                 => new sfValidatorNumber(array('required' => false)),
      'initial_weight'        => new sfValidatorNumber(),
      'final_weight'          => new sfValidatorNumber(),
      'is_prom'               => new sfValidatorBoolean(array('required' => false)),
      'prom_price'            => new sfValidatorNumber(array('required' => false)),
      'is_dynamic_price'      => new sfValidatorBoolean(array('required' => false)),
      'dynamic_price'         => new sfValidatorNumber(array('required' => false)),
      'dynamic_price_what_if' => new sfValidatorNumber(array('required' => false)),
      'show'                  => new sfValidatorBoolean(array('required' => false)),
      'is_available'          => new sfValidatorBoolean(array('required' => false)),
      'notice'                => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_types_prices[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypesPrices';
  }


}
