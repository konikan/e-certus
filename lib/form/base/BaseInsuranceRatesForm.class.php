<?php

/**
 * InsuranceRates form base class.
 *
 * @method InsuranceRates getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseInsuranceRatesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'courier_id'   => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false)),
      'amount_start' => new sfWidgetFormInputText(),
      'amount_end'   => new sfWidgetFormInputText(),
      'price'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'courier_id'   => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id')),
      'amount_start' => new sfValidatorNumber(),
      'amount_end'   => new sfValidatorNumber(),
      'price'        => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('insurance_rates[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InsuranceRates';
  }


}
