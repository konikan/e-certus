<?php

/**
 * PackagingTypes filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePackagingTypesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'desc'       => new sfWidgetFormFilterInput(),
      'max_width'  => new sfWidgetFormFilterInput(),
      'max_height' => new sfWidgetFormFilterInput(),
      'max_length' => new sfWidgetFormFilterInput(),
      'max_weight' => new sfWidgetFormFilterInput(),
      'available'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'desc'       => new sfValidatorPass(array('required' => false)),
      'max_width'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'max_height' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'max_length' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'max_weight' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'available'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('packaging_types_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PackagingTypes';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'desc'       => 'Text',
      'max_width'  => 'Number',
      'max_height' => 'Number',
      'max_length' => 'Number',
      'max_weight' => 'Number',
      'available'  => 'Boolean',
    );
  }
}
