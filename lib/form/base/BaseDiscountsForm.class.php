<?php

/**
 * Discounts form base class.
 *
 * @method Discounts getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDiscountsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormInputHidden(),
      'type_id'  => new sfWidgetFormInputHidden(),
      'discount' => new sfWidgetFormInputText(),
      'active'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'type_id'  => new sfValidatorPropelChoice(array('model' => 'ShippingTypes', 'column' => 'id', 'required' => false)),
      'discount' => new sfValidatorNumber(array('required' => false)),
      'active'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('discounts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Discounts';
  }


}
