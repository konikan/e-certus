<?php

/**
 * UserSender form base class.
 *
 * @method UserSender getObject() Returns the current form's model object
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserSenderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'is_company'        => new sfWidgetFormInputCheckbox(),
      'is_default'        => new sfWidgetFormInputCheckbox(),
      'sender_name'       => new sfWidgetFormInputText(),
      'contact_name'      => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'surname'           => new sfWidgetFormInputText(),
      'postcode'          => new sfWidgetFormInputText(),
      'city'              => new sfWidgetFormInputText(),
      'country'           => new sfWidgetFormInputText(),
      'address'           => new sfWidgetFormInputText(),
      'street'            => new sfWidgetFormInputText(),
      'street_nr'         => new sfWidgetFormInputText(),
      'local_nr'          => new sfWidgetFormInputText(),
      'tel'               => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'company_name'      => new sfWidgetFormInputText(),
      'company_nip'       => new sfWidgetFormInputText(),
      'company_post_code' => new sfWidgetFormInputText(),
      'company_city'      => new sfWidgetFormInputText(),
      'company_street'    => new sfWidgetFormInputText(),
      'company_home_nr'   => new sfWidgetFormInputText(),
      'company_local_nr'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'is_company'        => new sfValidatorBoolean(array('required' => false)),
      'is_default'        => new sfValidatorBoolean(array('required' => false)),
      'sender_name'       => new sfValidatorString(array('max_length' => 255)),
      'contact_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'surname'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postcode'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'country'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'address'           => new sfValidatorString(array('max_length' => 255)),
      'street'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street_nr'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'local_nr'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'tel'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_nip'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_post_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_city'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_street'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_home_nr'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'company_local_nr'  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_sender[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserSender';
  }


}
