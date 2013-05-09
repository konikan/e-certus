<?php

/**
 * ShippingTypes filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingTypesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'              => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypesGroups', 'add_empty' => true)),
      'type_id'               => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypes', 'add_empty' => true)),
      'packaging_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
      'name'                  => new sfWidgetFormFilterInput(),
      'is_active'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'show_in_tariff'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'price'                 => new sfWidgetFormFilterInput(),
      'initial_weight'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'final_weight'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_prom'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'prom_price'            => new sfWidgetFormFilterInput(),
      'is_dynamic_price'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dynamic_price'         => new sfWidgetFormFilterInput(),
      'dynamic_price_what_if' => new sfWidgetFormFilterInput(),
      'show'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_available'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notice'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'group_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ShippingTypesGroups', 'column' => 'id')),
      'type_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ShippingTypes', 'column' => 'id')),
      'packaging_type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PackagingTypes', 'column' => 'id')),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'is_active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'show_in_tariff'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'price'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'initial_weight'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'final_weight'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_prom'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'prom_price'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_dynamic_price'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dynamic_price'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dynamic_price_what_if' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'show'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_available'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notice'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_types_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypes';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'group_id'              => 'ForeignKey',
      'type_id'               => 'ForeignKey',
      'packaging_type_id'     => 'ForeignKey',
      'name'                  => 'Text',
      'is_active'             => 'Boolean',
      'show_in_tariff'        => 'Boolean',
      'price'                 => 'Number',
      'initial_weight'        => 'Number',
      'final_weight'          => 'Number',
      'is_prom'               => 'Boolean',
      'prom_price'            => 'Number',
      'is_dynamic_price'      => 'Boolean',
      'dynamic_price'         => 'Number',
      'dynamic_price_what_if' => 'Number',
      'show'                  => 'Boolean',
      'is_available'          => 'Boolean',
      'notice'                => 'Text',
    );
  }
}
