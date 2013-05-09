<?php

/**
 * Project form base class.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseFormPropel extends sfFormPropel
{
  public function setup()
  {
  }


      public function getErrors()

      {

      $errors = array();



      // individual widget errors

      foreach ($this as $form_field)

      {

      if ($form_field->hasError())

      {

      $error_obj = $form_field->getError();

      if ($error_obj instanceof sfValidatorErrorSchema)

      {

      foreach ($error_obj->getErrors() as $error)

      {

      // if a field has more than 1 error, it'll be over-written

      $errors[$form_field->getName()] = $error->getMessage();

      }

      }

      else

      {

      $errors[$form_field->getName()] = $error_obj->getMessage();

      }

      }

      }



      // global errors

      foreach ($this->getGlobalErrors() as $validator_error)

      {

      $errors[] = $validator_error->getMessage();

      }



      return $errors;

      }
}
