<?php

/**
 * OrderShipping filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseOrderShippingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'                      => new sfWidgetFormFilterInput(),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'                      => new sfWidgetFormFilterInput(),
      'courier_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'packaging_type_id'           => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'amount'                      => new sfWidgetFormFilterInput(),
      'vat'                         => new sfWidgetFormFilterInput(),
      'vat_amount'                  => new sfWidgetFormFilterInput(),
      'total_amount'                => new sfWidgetFormFilterInput(),
      'outher_order_number'         => new sfWidgetFormFilterInput(),
      'order_shipping_options_list' => new sfWidgetFormPropelChoice(array('model' => 'ShippingOptions', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'number'                      => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'status'                      => new sfValidatorPass(array('required' => false)),
      'courier_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Courier', 'column' => 'id')),
      'packaging_type_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PackagingTypes', 'column' => 'id')),
      'amount'                      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vat'                         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vat_amount'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_amount'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'outher_order_number'         => new sfValidatorPass(array('required' => false)),
      'order_shipping_options_list' => new sfValidatorPropelChoice(array('model' => 'ShippingOptions', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_shipping_filters[%s]');

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

    $criteria->addJoin(OrderShippingOptionsPeer::ORDER_ID, OrderShippingPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(OrderShippingOptionsPeer::OPTION_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(OrderShippingOptionsPeer::OPTION_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'OrderShipping';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'number'                      => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
      'status'                      => 'Text',
      'courier_id'                  => 'ForeignKey',
      'packaging_type_id'           => 'ForeignKey',
      'amount'                      => 'Number',
      'vat'                         => 'Number',
      'vat_amount'                  => 'Number',
      'total_amount'                => 'Number',
      'outher_order_number'         => 'Text',
      'order_shipping_options_list' => 'ManyKey',
    );
  }
}
