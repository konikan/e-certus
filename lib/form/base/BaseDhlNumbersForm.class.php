<?php

/**
 * DhlNumbers form base class.
 *
 * @method DhlNumbers getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDhlNumbersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'list_number' => new sfWidgetFormInputHidden(),
      'free'        => new sfWidgetFormInputCheckbox(),
      'used'        => new sfWidgetFormInputCheckbox(),
      'time_of_use' => new sfWidgetFormDateTime(),
      'order_id'    => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'list_number' => new sfValidatorChoice(array('choices' => array($this->getObject()->getListNumber()), 'empty_value' => $this->getObject()->getListNumber(), 'required' => false)),
      'free'        => new sfValidatorBoolean(array('required' => false)),
      'used'        => new sfValidatorBoolean(array('required' => false)),
      'time_of_use' => new sfValidatorDateTime(array('required' => false)),
      'order_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dhl_numbers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DhlNumbers';
  }


}
