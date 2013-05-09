<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'activity'            => new sfWidgetFormInputCheckbox(),
      'email'               => new sfWidgetFormInputText(),
      'password'            => new sfWidgetFormInputText(),
      'password_ask'        => new sfWidgetFormInputText(),
      'password_rep'        => new sfWidgetFormInputText(),
      'is_company'          => new sfWidgetFormInputCheckbox(),
      'name'                => new sfWidgetFormInputText(),
      'surname'             => new sfWidgetFormInputText(),
      'postcode'            => new sfWidgetFormInputText(),
      'city'                => new sfWidgetFormInputText(),
      'street'              => new sfWidgetFormInputText(),
      'street_nr'           => new sfWidgetFormInputText(),
      'local_nr'            => new sfWidgetFormInputText(),
      'tel'                 => new sfWidgetFormInputText(),
      'company_name'        => new sfWidgetFormInputText(),
      'company_nip'         => new sfWidgetFormInputText(),
      'company_post_code'   => new sfWidgetFormInputText(),
      'company_city'        => new sfWidgetFormInputText(),
      'company_street'      => new sfWidgetFormInputText(),
      'company_home_nr'     => new sfWidgetFormInputText(),
      'company_local_nr'    => new sfWidgetFormInputText(),
      'bank_name'           => new sfWidgetFormInputText(),
      'bank_account'        => new sfWidgetFormInputText(),
      'blocked'             => new sfWidgetFormInputCheckbox(),
      'is_cash_on_delivery' => new sfWidgetFormInputCheckbox(),
      'prepaid_balance'     => new sfWidgetFormInputText(),
      'is_prepaid'          => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'discounts_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'ShippingTypes')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'activity'            => new sfValidatorBoolean(array('required' => false)),
      'email'               => new sfValidatorString(array('max_length' => 255)),
      'password'            => new sfValidatorString(array('max_length' => 255)),
      'password_ask'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'password_rep'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_company'          => new sfValidatorBoolean(array('required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'surname'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postcode'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street_nr'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'local_nr'            => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'tel'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_nip'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_post_code'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_city'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_street'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_home_nr'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'company_local_nr'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'bank_name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'bank_account'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'blocked'             => new sfValidatorBoolean(array('required' => false)),
      'is_cash_on_delivery' => new sfValidatorBoolean(array('required' => false)),
      'prepaid_balance'     => new sfValidatorNumber(array('required' => false)),
      'is_prepaid'          => new sfValidatorBoolean(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
      'discounts_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'ShippingTypes', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['discounts_list']))
    {
      $values = array();
      foreach ($this->object->getDiscountss() as $obj)
      {
        $values[] = $obj->getTypeId();
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
    $c->add(DiscountsPeer::USER_ID, $this->object->getPrimaryKey());
    DiscountsPeer::doDelete($c, $con);

    $values = $this->getValue('discounts_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Discounts();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setTypeId($value);
        $obj->save();
      }
    }
  }

}
