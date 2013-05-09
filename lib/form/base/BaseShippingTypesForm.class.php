<?php

/**
 * ShippingTypes form base class.
 *
 * @method ShippingTypes getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingTypesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'group_id'              => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypesGroups', 'add_empty' => false)),
      'packaging_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'name'                  => new sfWidgetFormInputText(),
      'short_name'            => new sfWidgetFormInputText(),
      'is_active'             => new sfWidgetFormInputCheckbox(),
      'show_in_tariff'        => new sfWidgetFormInputCheckbox(),
      'price'                 => new sfWidgetFormInputText(),
      'initial_weight'        => new sfWidgetFormInputText(),
      'final_weight'          => new sfWidgetFormInputText(),
      'is_prom'               => new sfWidgetFormInputCheckbox(),
      'prom_price'            => new sfWidgetFormInputText(),
      'is_dynamic_price'      => new sfWidgetFormInputCheckbox(),
      'dynamic_price'         => new sfWidgetFormInputText(),
      'dynamic_price_what_if' => new sfWidgetFormInputText(),
      'show'                  => new sfWidgetFormInputCheckbox(),
      'is_international'      => new sfWidgetFormInputCheckbox(),
      'is_available'          => new sfWidgetFormInputCheckbox(),
      'notice'                => new sfWidgetFormTextarea(),
      'country_id'            => new sfWidgetFormPropelChoice(array('model' => 'Countries', 'add_empty' => true)),
      'discounts_list'        => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Users')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'group_id'              => new sfValidatorPropelChoice(array('model' => 'ShippingTypesGroups', 'column' => 'id')),
      'packaging_type_id'     => new sfValidatorPropelChoice(array('model' => 'PackagingTypes', 'column' => 'id', 'required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'short_name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'             => new sfValidatorBoolean(array('required' => false)),
      'show_in_tariff'        => new sfValidatorBoolean(array('required' => false)),
      'price'                 => new sfValidatorNumber(array('required' => false)),
      'initial_weight'        => new sfValidatorNumber(),
      'final_weight'          => new sfValidatorNumber(),
      'is_prom'               => new sfValidatorBoolean(array('required' => false)),
      'prom_price'            => new sfValidatorNumber(array('required' => false)),
      'is_dynamic_price'      => new sfValidatorBoolean(array('required' => false)),
      'dynamic_price'         => new sfValidatorNumber(array('required' => false)),
      'dynamic_price_what_if' => new sfValidatorNumber(array('required' => false)),
      'show'                  => new sfValidatorBoolean(array('required' => false)),
      'is_international'      => new sfValidatorBoolean(array('required' => false)),
      'is_available'          => new sfValidatorBoolean(array('required' => false)),
      'notice'                => new sfValidatorString(array('required' => false)),
      'country_id'            => new sfValidatorPropelChoice(array('model' => 'Countries', 'column' => 'id', 'required' => false)),
      'discounts_list'        => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Users', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypes';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['discounts_list']))
    {
      $values = array();
      foreach ($this->object->getDiscountss() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('discounts_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveDiscountsList($con);
  }

  public function saveDiscountsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['discounts_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(DiscountsPeer::TYPE_ID, $this->object->getPrimaryKey());
    DiscountsPeer::doDelete($c, $con);

    $values = $this->getValue('discounts_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Discounts();
        $obj->setTypeId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
