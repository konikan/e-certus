<?php

/**
 * ShippingTypesPrices filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingTypesPricesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type_id'               => new sfWidgetFormPropelChoice(array('model' => 'ShippingTypes', 'add_empty' => true)),
      'packaging_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'PackagingTypes', 'add_empty' => true)),
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
      'type_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ShippingTypes', 'column' => 'id')),
      'packaging_type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PackagingTypes', 'column' => 'id')),
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

    $this->widgetSchema->setNameFormat('shipping_types_prices_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypesPrices';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'type_id'               => 'ForeignKey',
      'packaging_type_id'     => 'ForeignKey',
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
