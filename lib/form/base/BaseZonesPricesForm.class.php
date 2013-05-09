<?php

/**
 * ZonesPrices form base class.
 *
 * @method ZonesPrices getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseZonesPricesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'zone_id'        => new sfWidgetFormPropelChoice(array('model' => 'Zones', 'add_empty' => false)),
      'is_active'      => new sfWidgetFormInputCheckbox(),
      'initial_weight' => new sfWidgetFormInputText(),
      'final_weight'   => new sfWidgetFormInputText(),
      'price'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'zone_id'        => new sfValidatorPropelChoice(array('model' => 'Zones', 'column' => 'id')),
      'is_active'      => new sfValidatorBoolean(array('required' => false)),
      'initial_weight' => new sfValidatorNumber(),
      'final_weight'   => new sfValidatorNumber(),
      'price'          => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('zones_prices[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ZonesPrices';
  }


}
