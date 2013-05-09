<?php

/**
 * ShippingPrices filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingPricesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'courier_id'            => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'product_id'            => new sfWidgetFormPropelChoice(array('model' => 'ShippingProducts', 'add_empty' => true)),
      'service_id'            => new sfWidgetFormFilterInput(),
      'price'                 => new sfWidgetFormFilterInput(),
      'prom_price'            => new sfWidgetFormFilterInput(),
      'is_dynamic_price'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dynamic_price'         => new sfWidgetFormFilterInput(),
      'dynamic_price_what_if' => new sfWidgetFormFilterInput(),
      'show'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_default'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_prom'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_available'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notice'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'courier_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Courier', 'column' => 'id')),
      'product_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ShippingProducts', 'column' => 'id')),
      'service_id'            => new sfValidatorPass(array('required' => false)),
      'price'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prom_price'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_dynamic_price'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dynamic_price'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dynamic_price_what_if' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'show'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_default'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_prom'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_available'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notice'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_prices_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingPrices';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'courier_id'            => 'ForeignKey',
      'product_id'            => 'ForeignKey',
      'service_id'            => 'Text',
      'price'                 => 'Number',
      'prom_price'            => 'Number',
      'is_dynamic_price'      => 'Boolean',
      'dynamic_price'         => 'Number',
      'dynamic_price_what_if' => 'Number',
      'show'                  => 'Boolean',
      'is_default'            => 'Boolean',
      'is_prom'               => 'Boolean',
      'is_available'          => 'Boolean',
      'notice'                => 'Text',
    );
  }
}
