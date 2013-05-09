<?php

/**
 * OrderShipping form base class.
 *
 * @method OrderShipping getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseOrderShippingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                 => new sfWidgetFormInputHidden(),
      'user_id'                            => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'is_international'                   => new sfWidgetFormInputCheckbox(),
      'number'                             => new sfWidgetFormInputText(),
      'created_at'                         => new sfWidgetFormDateTime(),
      'updated_at'                         => new sfWidgetFormDateTime(),
      'status'                             => new sfWidgetFormInputText(),
      'outher_order_number'                => new sfWidgetFormInputText(),
      'list_number'                        => new sfWidgetFormInputText(),
      'courier_id'                         => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'width'                              => new sfWidgetFormInputText(),
      'height'                             => new sfWidgetFormInputText(),
      'length'                             => new sfWidgetFormInputText(),
      'normal_weight'                      => new sfWidgetFormInputText(),
      'weight'                             => new sfWidgetFormInputText(),
      'type_id'                            => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypes', 'add_empty' => true)),
      'zone_id'                            => new sfWidgetFormPropelChoice(array('model' => 'Zones', 'add_empty' => true)),
      'country_id'                         => new sfWidgetFormPropelChoice(array('model' => 'Countries', 'add_empty' => true)),
      'packaging_type_id'                  => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'date_of_receipt'                    => new sfWidgetFormDate(),
      'receipt_time_start'                 => new sfWidgetFormTime(),
      'receipt_time_end'                   => new sfWidgetFormTime(),
      'self_giving'                        => new sfWidgetFormInputCheckbox(),
      'self_giving_date'                   => new sfWidgetFormDate(),
      'is_paid'                            => new sfWidgetFormInputCheckbox(),
      'paid_type'                          => new sfWidgetFormInputText(),
      'number_of_packages'                 => new sfWidgetFormInputText(),
      'amount'                             => new sfWidgetFormInputText(),
      'vat'                                => new sfWidgetFormInputText(),
      'vat_amount'                         => new sfWidgetFormInputText(),
      'total_amount'                       => new sfWidgetFormInputText(),
      'notes'                              => new sfWidgetFormTextarea(),
      'order_shipping_options_list'        => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'ShippingOptions')),
      'order_shipping_zones_services_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'ZonesServices')),
    ));

    $this->setValidators(array(
      'id'                                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'                            => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'is_international'                   => new sfValidatorBoolean(array('required' => false)),
      'number'                             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'                         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                         => new sfValidatorDateTime(array('required' => false)),
      'status'                             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'outher_order_number'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'list_number'                        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'courier_id'                         => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id', 'required' => false)),
      'width'                              => new sfValidatorNumber(array('required' => false)),
      'height'                             => new sfValidatorNumber(array('required' => false)),
      'length'                             => new sfValidatorNumber(array('required' => false)),
      'normal_weight'                      => new sfValidatorNumber(array('required' => false)),
      'weight'                             => new sfValidatorNumber(array('required' => false)),
      'type_id'                            => new sfValidatorPropelChoice(array('model' => 'ShippingTypes', 'column' => 'id', 'required' => false)),
      'zone_id'                            => new sfValidatorPropelChoice(array('model' => 'Zones', 'column' => 'id', 'required' => false)),
      'country_id'                         => new sfValidatorPropelChoice(array('model' => 'Countries', 'column' => 'id', 'required' => false)),
      'packaging_type_id'                  => new sfValidatorPropelChoice(array('model' => 'PackagingTypes', 'column' => 'id', 'required' => false)),
      'date_of_receipt'                    => new sfValidatorDate(array('required' => false)),
      'receipt_time_start'                 => new sfValidatorTime(array('required' => false)),
      'receipt_time_end'                   => new sfValidatorTime(array('required' => false)),
      'self_giving'                        => new sfValidatorBoolean(array('required' => false)),
      'self_giving_date'                   => new sfValidatorDate(array('required' => false)),
      'is_paid'                            => new sfValidatorBoolean(array('required' => false)),
      'paid_type'                          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'number_of_packages'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'amount'                             => new sfValidatorNumber(array('required' => false)),
      'vat'                                => new sfValidatorNumber(array('required' => false)),
      'vat_amount'                         => new sfValidatorNumber(array('required' => false)),
      'total_amount'                       => new sfValidatorNumber(array('required' => false)),
      'notes'                              => new sfValidatorString(array('required' => false)),
      'order_shipping_options_list'        => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'ShippingOptions', 'required' => false)),
      'order_shipping_zones_services_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'ZonesServices', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_shipping[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderShipping';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['order_shipping_options_list']))
    {
      $values = array();
      foreach ($this->object->getOrderShippingOptionss() as $obj)
      {
        $values[] = $obj->getOptionId();
      }

      $this->setDefault('order_shipping_options_list', $values);
    }

    if (isset($this->widgetSchema['order_shipping_zones_services_list']))
    {
      $values = array();
      foreach ($this->object->getOrderShippingZonesServicess() as $obj)
      {
        $values[] = $obj->getServiceId();
      }

      $this->setDefault('order_shipping_zones_services_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveOrderShippingOptionsList($con);
    $this->saveOrderShippingZonesServicesList($con);
  }

  public function saveOrderShippingOptionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['order_shipping_options_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(OrderShippingOptionsPeer::ORDER_ID, $this->object->getPrimaryKey());
    OrderShippingOptionsPeer::doDelete($c, $con);

    $values = $this->getValue('order_shipping_options_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new OrderShippingOptions();
        $obj->setOrderId($this->object->getPrimaryKey());
        $obj->setOptionId($value);
        $obj->save();
      }
    }
  }

  public function saveOrderShippingZonesServicesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['order_shipping_zones_services_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(OrderShippingZonesServicesPeer::ORDER_ID, $this->object->getPrimaryKey());
    OrderShippingZonesServicesPeer::doDelete($c, $con);

    $values = $this->getValue('order_shipping_zones_services_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new OrderShippingZonesServices();
        $obj->setOrderId($this->object->getPrimaryKey());
        $obj->setServiceId($value);
        $obj->save();
      }
    }
  }

}
