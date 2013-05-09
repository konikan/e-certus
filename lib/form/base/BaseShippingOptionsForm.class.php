<?php

/**
 * ShippingOptions form base class.
 *
 * @method ShippingOptions getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseShippingOptionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'courier_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => false)),
      'code'                        => new sfWidgetFormInputText(),
      'short_name'                  => new sfWidgetFormInputText(),
      'name'                        => new sfWidgetFormInputText(),
      'service_id'                  => new sfWidgetFormInputText(),
      'is_public_access'            => new sfWidgetFormInputCheckbox(),
      'is_available'                => new sfWidgetFormInputCheckbox(),
      'show_in_calculate'           => new sfWidgetFormInputCheckbox(),
      'show_in_tariff'              => new sfWidgetFormInputCheckbox(),
      'cash_on_delivery'            => new sfWidgetFormInputCheckbox(),
      'commission'                  => new sfWidgetFormInputText(),
      'price'                       => new sfWidgetFormInputText(),
      'insurance'                   => new sfWidgetFormInputCheckbox(),
      'free_insurance_limit'        => new sfWidgetFormInputText(),
      'additional_amount'           => new sfWidgetFormInputCheckbox(),
      'notice'                      => new sfWidgetFormTextarea(),
      'type'                        => new sfWidgetFormInputText(),
      'is_international'            => new sfWidgetFormInputCheckbox(),
      'country_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Countries', 'add_empty' => true)),
      'order_shipping_options_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'OrderShipping')),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'courier_id'                  => new sfValidatorPropelChoice(array('model' => 'Courier', 'column' => 'id')),
      'code'                        => new sfValidatorString(array('max_length' => 255)),
      'short_name'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'                        => new sfValidatorString(array('max_length' => 255)),
      'service_id'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_public_access'            => new sfValidatorBoolean(array('required' => false)),
      'is_available'                => new sfValidatorBoolean(array('required' => false)),
      'show_in_calculate'           => new sfValidatorBoolean(array('required' => false)),
      'show_in_tariff'              => new sfValidatorBoolean(array('required' => false)),
      'cash_on_delivery'            => new sfValidatorBoolean(array('required' => false)),
      'commission'                  => new sfValidatorNumber(array('required' => false)),
      'price'                       => new sfValidatorNumber(array('required' => false)),
      'insurance'                   => new sfValidatorBoolean(array('required' => false)),
      'free_insurance_limit'        => new sfValidatorNumber(array('required' => false)),
      'additional_amount'           => new sfValidatorBoolean(array('required' => false)),
      'notice'                      => new sfValidatorString(array('required' => false)),
      'type'                        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_international'            => new sfValidatorBoolean(array('required' => false)),
      'country_id'                  => new sfValidatorPropelChoice(array('model' => 'Countries', 'column' => 'id', 'required' => false)),
      'order_shipping_options_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'OrderShipping', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_options[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingOptions';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['order_shipping_options_list']))
    {
      $values = array();
      foreach ($this->object->getOrderShippingOptionss() as $obj)
      {
        $values[] = $obj->getOrderId();
      }

      $this->setDefault('order_shipping_options_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveOrderShippingOptionsList($con);
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
    $c->add(OrderShippingOptionsPeer::OPTION_ID, $this->object->getPrimaryKey());
    OrderShippingOptionsPeer::doDelete($c, $con);

    $values = $this->getValue('order_shipping_options_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new OrderShippingOptions();
        $obj->setOptionId($this->object->getPrimaryKey());
        $obj->setOrderId($value);
        $obj->save();
      }
    }
  }

}
