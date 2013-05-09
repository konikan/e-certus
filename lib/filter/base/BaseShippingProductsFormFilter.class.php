<?php

/**
 * ShippingProducts filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingProductsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'          => new sfWidgetFormPropelChoice(array('model' => 'ShippingPricesGroups', 'add_empty' => true)),
      'packaging_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'weight_from'       => new sfWidgetFormFilterInput(),
      'weight_to'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'group_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ShippingPricesGroups', 'column' => 'id')),
      'packaging_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PackagingTypes', 'column' => 'id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'is_active'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'weight_from'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'weight_to'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('shipping_products_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingProducts';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'group_id'          => 'ForeignKey',
      'packaging_type_id' => 'ForeignKey',
      'name'              => 'Text',
      'is_active'         => 'Boolean',
      'weight_from'       => 'Number',
      'weight_to'         => 'Number',
    );
  }
}
