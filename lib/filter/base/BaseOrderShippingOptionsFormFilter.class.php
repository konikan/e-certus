<?php

/**
 * OrderShippingOptions filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseOrderShippingOptionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'option_value' => new sfWidgetFormFilterInput(),
      'option_price' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'option_value' => new sfValidatorPass(array('required' => false)),
      'option_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('order_shipping_options_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderShippingOptions';
  }

  public function getFields()
  {
    return array(
      'order_id'     => 'ForeignKey',
      'option_id'    => 'ForeignKey',
      'option_value' => 'Text',
      'option_price' => 'Number',
    );
  }
}
