<?php

/**
 * ShippingTypesGroups form base class.
 *
 * @method ShippingTypesGroups getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingTypesGroupsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'courier_id'  => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false)),
      'service_id'  => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'name_tariff' => new sfWidgetFormInputText(),
      'short_name'  => new sfWidgetFormInputText(),
      'code'        => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'type'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'courier_id'  => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id')),
      'service_id'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'name_tariff' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'short_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'code'        => new sfValidatorString(array('max_length' => 255)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'type'        => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_types_groups[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypesGroups';
  }


}
