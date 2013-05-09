<?php

/**
 * Countries form base class.
 *
 * @method Countries getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCountriesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'name'                 => new sfWidgetFormInputText(),
      'short'                => new sfWidgetFormInputText(),
      'currency'             => new sfWidgetFormInputText(),
      'zones_countries_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Zones')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 255)),
      'short'                => new sfValidatorString(array('max_length' => 255)),
      'currency'             => new sfValidatorString(array('max_length' => 255)),
      'zones_countries_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Zones', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('countries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Countries';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['zones_countries_list']))
    {
      $values = array();
      foreach ($this->object->getZonesCountriess() as $obj)
      {
        $values[] = $obj->getZoneId();
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
    $c->add(ZonesCountriesPeer::COUNTRY_ID, $this->object->getPrimaryKey());
    ZonesCountriesPeer::doDelete($c, $con);

    $values = $this->getValue('zones_countries_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ZonesCountries();
        $obj->setCountryId($this->object->getPrimaryKey());
        $obj->setZoneId($value);
        $obj->save();
      }
    }
  }

}
