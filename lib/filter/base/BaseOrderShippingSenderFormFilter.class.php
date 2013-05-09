<?php

/**
 * OrderShippingSender filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseOrderShippingSenderFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_company'        => new sfWidgetFormFilterInput(),
      'name'              => new sfWidgetFormFilterInput(),
      'surname'           => new sfWidgetFormFilterInput(),
      'postcode'          => new sfWidgetFormFilterInput(),
      'city'              => new sfWidgetFormFilterInput(),
      'street'            => new sfWidgetFormFilterInput(),
      'street_nr'         => new sfWidgetFormFilterInput(),
      'local_nr'          => new sfWidgetFormFilterInput(),
      'tel'               => new sfWidgetFormFilterInput(),
      'company_name'      => new sfWidgetFormFilterInput(),
      'company_nip'       => new sfWidgetFormFilterInput(),
      'company_post_code' => new sfWidgetFormFilterInput(),
      'company_city'      => new sfWidgetFormFilterInput(),
      'company_street'    => new sfWidgetFormFilterInput(),
      'company_home_nr'   => new sfWidgetFormFilterInput(),
      'company_local_nr'  => new sfWidgetFormFilterInput(),
      'order_id'          => new sfWidgetFormPropelChoice(array('model' => 'OrderShipping', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_company'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'              => new sfValidatorPass(array('required' => false)),
      'surname'           => new sfValidatorPass(array('required' => false)),
      'postcode'          => new sfValidatorPass(array('required' => false)),
      'city'              => new sfValidatorPass(array('required' => false)),
      'street'            => new sfValidatorPass(array('required' => false)),
      'street_nr'         => new sfValidatorPass(array('required' => false)),
      'local_nr'          => new sfValidatorPass(array('required' => false)),
      'tel'               => new sfValidatorPass(array('required' => false)),
      'company_name'      => new sfValidatorPass(array('required' => false)),
      'company_nip'       => new sfValidatorPass(array('required' => false)),
      'company_post_code' => new sfValidatorPass(array('required' => false)),
      'company_city'      => new sfValidatorPass(array('required' => false)),
      'company_street'    => new sfValidatorPass(array('required' => false)),
      'company_home_nr'   => new sfValidatorPass(array('required' => false)),
      'company_local_nr'  => new sfValidatorPass(array('required' => false)),
      'order_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'OrderShipping', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('order_shipping_sender_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderShippingSender';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'is_company'        => 'Number',
      'name'              => 'Text',
      'surname'           => 'Text',
      'postcode'          => 'Text',
      'city'              => 'Text',
      'street'            => 'Text',
      'street_nr'         => 'Text',
      'local_nr'          => 'Text',
      'tel'               => 'Text',
      'company_name'      => 'Text',
      'company_nip'       => 'Text',
      'company_post_code' => 'Text',
      'company_city'      => 'Text',
      'company_street'    => 'Text',
      'company_home_nr'   => 'Text',
      'company_local_nr'  => 'Text',
      'order_id'          => 'ForeignKey',
    );
  }
}
