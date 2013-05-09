<?php

/**
 * AdminUsers form base class.
 *
 * @method AdminUsers getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAdminUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'activity'     => new sfWidgetFormInputCheckbox(),
      'username'     => new sfWidgetFormInputText(),
      'password'     => new sfWidgetFormInputText(),
      'password_ask' => new sfWidgetFormInputText(),
      'password_rep' => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'surname'      => new sfWidgetFormInputText(),
      'postcode'     => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'street'       => new sfWidgetFormInputText(),
      'street_nr'    => new sfWidgetFormInputText(),
      'local_nr'     => new sfWidgetFormInputText(),
      'tel'          => new sfWidgetFormInputText(),
      'bank_account' => new sfWidgetFormInputText(),
      'blocked'      => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'activity'     => new sfValidatorBoolean(array('required' => false)),
      'username'     => new sfValidatorString(array('max_length' => 255)),
      'password'     => new sfValidatorString(array('max_length' => 255)),
      'password_ask' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'password_rep' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255)),
      'name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'surname'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postcode'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street_nr'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'local_nr'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'tel'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'bank_account' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'blocked'      => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('admin_users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdminUsers';
  }


}
