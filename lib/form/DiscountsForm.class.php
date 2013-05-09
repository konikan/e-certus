<?php

/**
 * Discounts form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class DiscountsForm extends BaseDiscountsForm
{
  public function configure()
  {
      $c = new Criteria();
      $c->addJoin(ShippingTypesGroupsPeer::ID, ShippingTypesPeer::GROUP_ID);
      $c->addAscendingOrderByColumn(ShippingTypesGroupsPeer::COURIER_ID);
      $this->widgetSchema['type_id']    = new sfWidgetFormPropelChoice(array('model' => 'ShippingTypes', 'add_empty' => true, 'criteria'=>$c));
      $this->widgetSchema['discount_type'] = new sfWidgetFormChoice(array('choices' => array('1'=>'Procentowy', '2'=>'Kwotowy')));

      $this->setValidators(array(
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => true)),
      'type_id'  => new sfValidatorPropelChoice(array('model' => 'ShippingTypes', 'column' => 'id', 'required' => true)),
      'discount' => new sfValidatorNumber(array('required' => false)),
      'active'   => new sfValidatorBoolean(array('required' => false)),
      'discount_amount' => new sfValidatorNumber(array('required' => false)),
      'discount_type'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    

  }
}
