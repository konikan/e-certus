<?php

/**
 * Config form base class.
 *
 * @method Config getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseConfigForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'name'       => new sfWidgetFormInputHidden(),
      'value'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'name'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getName()), 'empty_value' => $this->getObject()->getName(), 'required' => false)),
      'value'      => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Config';
  }


}
