<?php

/**
 * ZonesCountries form base class.
 *
 * @method ZonesCountries getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseZonesCountriesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'zone_id'    => new sfWidgetFormInputHidden(),
      'country_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'zone_id'    => new sfValidatorPropelChoice(array('model' => 'Zones', 'column' => 'id', 'required' => false)),
      'country_id' => new sfValidatorPropelChoice(array('model' => 'Countries', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('zones_countries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ZonesCountries';
  }


}
