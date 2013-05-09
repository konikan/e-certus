<?php

/**
 * Zones form base class.
 *
 * @method Zones getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseZonesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'courier_id'           => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false)),
      'name'                 => new sfWidgetFormInputText(),
      'zones_countries_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Countries')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'courier_id'           => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id')),
      'name'                 => new sfValidatorString(array('max_length' => 255)),
      'zones_countries_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Countries', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('zones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Zones';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['zones_countries_list']))
    {
      $values = array();
      foreach ($this->object->getZonesCountriess() as $obj)
      {
        $values[] = $obj->getCountryId();
      }

      $this->setDefault('zones_countries_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveZonesCountriesList($con);
  }

  public function saveZonesCountriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['zones_countries_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ZonesCountriesPeer::ZONE_ID, $this->object->getPrimaryKey());
    ZonesCountriesPeer::doDelete($c, $con);

    $values = $this->getValue('zones_countries_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ZonesCountries();
        $obj->setZoneId($this->object->getPrimaryKey());
        $obj->setCountryId($value);
        $obj->save();
      }
    }
  }

}
