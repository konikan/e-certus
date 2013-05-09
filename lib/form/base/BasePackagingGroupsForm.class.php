<?php

/**
 * PackagingGroups form base class.
 *
 * @method PackagingGroups getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePackagingGroupsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'desc'       => new sfWidgetFormTextarea(),
      'available'  => new sfWidgetFormInputCheckbox(),
      'max_width'  => new sfWidgetFormInputText(),
      'max_height' => new sfWidgetFormInputText(),
      'max_length' => new sfWidgetFormInputText(),
      'max_weight' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'desc'       => new sfValidatorString(array('required' => false)),
      'available'  => new sfValidatorBoolean(array('required' => false)),
      'max_width'  => new sfValidatorNumber(array('required' => false)),
      'max_height' => new sfValidatorNumber(array('required' => false)),
      'max_length' => new sfValidatorNumber(array('required' => false)),
      'max_weight' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('packaging_groups[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PackagingGroups';
  }


}
