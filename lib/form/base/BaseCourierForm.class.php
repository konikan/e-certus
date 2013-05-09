<?php

/**
 * Courier form base class.
 *
 * @method Courier getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCourierForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'available'       => new sfWidgetFormInputCheckbox(),
      'client_nr'       => new sfWidgetFormInputText(),
      'api_key'         => new sfWidgetFormInputText(),
      'login'           => new sfWidgetFormInputText(),
      'pass'            => new sfWidgetFormInputText(),
      'petrol_charge'   => new sfWidgetFormInputText(),
      'start_work_time' => new sfWidgetFormTime(),
      'end_work_time'   => new sfWidgetFormTime(),
      'desc'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'available'       => new sfValidatorBoolean(array('required' => false)),
      'client_nr'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'api_key'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'login'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pass'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'petrol_charge'   => new sfValidatorNumber(array('required' => false)),
      'start_work_time' => new sfValidatorTime(array('required' => false)),
      'end_work_time'   => new sfValidatorTime(array('required' => false)),
      'desc'            => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('courier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courier';
  }


}
