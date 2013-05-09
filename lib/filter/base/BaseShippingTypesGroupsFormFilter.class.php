<?php

/**
 * ShippingTypesGroups filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseShippingTypesGroupsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'courier_id'  => new sfWidgetFormPropelChoice(array('model' => 'Courier', 'add_empty' => true)),
      'service_id'  => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'name_tariff' => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'type'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'courier_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Courier', 'column' => 'id')),
      'service_id'  => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'name_tariff' => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'type'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('shipping_types_groups_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingTypesGroups';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'courier_id'  => 'ForeignKey',
      'service_id'  => 'Text',
      'name'        => 'Text',
      'name_tariff' => 'Text',
      'is_active'   => 'Boolean',
      'type'        => 'Number',
    );
  }
}
