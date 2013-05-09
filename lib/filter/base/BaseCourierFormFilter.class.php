<?php

/**
 * Courier filter form base class.
 *
 * @package    e-certus
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCourierFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'available' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'client_nr' => new sfWidgetFormFilterInput(),
      'api_key'   => new sfWidgetFormFilterInput(),
      'login'     => new sfWidgetFormFilterInput(),
      'pass'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'available' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'client_nr' => new sfValidatorPass(array('required' => false)),
      'api_key'   => new sfValidatorPass(array('required' => false)),
      'login'     => new sfValidatorPass(array('required' => false)),
      'pass'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('courier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courier';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'available' => 'Boolean',
      'client_nr' => 'Text',
      'api_key'   => 'Text',
      'login'     => 'Text',
      'pass'      => 'Text',
    );
  }
}
