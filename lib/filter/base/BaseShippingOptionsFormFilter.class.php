<?php

/**
 * ShippingOptions filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingOptionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'courier_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'name'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'                        => new sfWidgetFormFilterInput(),
      'value'                       => new sfWidgetFormFilterInput(),
      'service_id'                  => new sfWidgetFormFilterInput(),
      'price'                       => new sfWidgetFormFilterInput(),
      'is_default'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'order_shipping_options_list' => new sfWidgetFormPropelChoice(array('model' => 'OrderShipping', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'courier_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Courier', 'column' => 'id')),
      'name'                        => new sfValidatorPass(array('required' => false)),
      'type'                        => new sfValidatorPass(array('required' => false)),
      'value'                       => new sfValidatorPass(array('required' => false)),
      'service_id'                  => new sfValidatorPass(array('required' => false)),
      'price'                       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_default'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'order_shipping_options_list' => new sfValidatorPropelChoice(array('model' => 'OrderShipping', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_options_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addOrderShippingOptionsListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(OrderShippingOptionsPeer::OPTION_ID, ShippingOptionsPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(OrderShippingOptionsPeer::ORDER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(OrderShippingOptionsPeer::ORDER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'ShippingOptions';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'courier_id'                  => 'ForeignKey',
      'name'                        => 'Text',
      'type'                        => 'Text',
      'value'                       => 'Text',
      'service_id'                  => 'Text',
      'price'                       => 'Number',
      'is_default'                  => 'Boolean',
      'order_shipping_options_list' => 'ManyKey',
    );
  }
}
