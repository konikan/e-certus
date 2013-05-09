<?php

/**
 * PackagingTypes form base class.
 *
 * @method PackagingTypes getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePackagingTypesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'group_id'   => new sfWidgetFormPropelChoice(array('model' => 'PackagingGroups', 'add_empty' => true)),
      'courier_id' => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'name'       => new sfWidgetFormInputText(),
      'service_id' => new sfWidgetFormInputText(),
      'desc'       => new sfWidgetFormTextarea(),
      'max_width'  => new sfWidgetFormInputText(),
      'max_height' => new sfWidgetFormInputText(),
      'max_length' => new sfWidgetFormInputText(),
      'max_weight' => new sfWidgetFormInputText(),
      'max_lenght' => new sfWidgetFormInputText(),
      'available'  => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'group_id'   => new sfValidatorPropelChoice(array('model' => 'PackagingGroups', 'column' => 'id', 'required' => false)),
      'courier_id' => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'service_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'desc'       => new sfValidatorString(array('required' => false)),
      'max_width'  => new sfValidatorNumber(array('required' => false)),
      'max_height' => new sfValidatorNumber(array('required' => false)),
      'max_length' => new sfValidatorNumber(array('required' => false)),
      'max_weight' => new sfValidatorNumber(array('required' => false)),
      'max_lenght' => new sfValidatorNumber(array('required' => false)),
      'available'  => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('packaging_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PackagingTypes';
  }


}
