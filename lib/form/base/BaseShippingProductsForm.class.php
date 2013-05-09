<?php

/**
 * ShippingProducts form base class.
 *
 * @method ShippingProducts getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingProductsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'group_id'          => new sfWidgetFormPropelChoice(array('model' => 'ShippingPricesGroups', 'add_empty' => true)),
      'packaging_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'name'              => new sfWidgetFormInputText(),
      'is_active'         => new sfWidgetFormInputCheckbox(),
      'weight_from'       => new sfWidgetFormInputText(),
      'weight_to'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'group_id'          => new sfValidatorPropelChoice(array('model' => 'ShippingPricesGroups', 'column' => 'id', 'required' => false)),
      'packaging_type_id' => new sfValidatorPropelChoice(array('model' => 'PackagingTypes', 'column' => 'id', 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'is_active'         => new sfValidatorBoolean(array('required' => false)),
      'weight_from'       => new sfValidatorNumber(array('required' => false)),
      'weight_to'         => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingProducts';
  }


}
