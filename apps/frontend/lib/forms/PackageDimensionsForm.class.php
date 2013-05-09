<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PackageDimensionsForms
 *
 * @author pawel
 */
class PackageDimensionsForm extends BaseForm {
    //put your code here
    protected static $rodzaje_wysylki = array('1' =>'Koperta', '2'=>'Paczka', '3'=>'Paleta');
    protected $ilosc_paczek = array();

    public function configure()
  {

        for($i=1;$i<=10;$i++)
        {
            $this->ilosc_paczek[$i] = $i;
        }

    $choices = array('1' => "krajowa", '2'=>'międzynarodowa');
    $this->setWidgets(array(
        'typ'           =>  new sfWidgetFormChoice(array(
  'choices'  => $choices,
  'expanded' => true,

)),
        'kraj'          =>  new sfWidgetFormPropelChoice(array('model' => 'Countries')),
        'r_wysylki'     =>  new sfWidgetFormPropelChoice(array('model' => 'PackagingGroups', 'add_empty' => false, 'peer_method'=>'getAvailableGroups')),
        'ilosc_paczek'  =>  new sfWidgetFormSelect(array('choices'=>$this->ilosc_paczek), array()),
        'wy'            =>  new sfWidgetFormInputText(array(),array('size'=>3)),
        'dl'            =>  new sfWidgetFormInputText(array(),array('size'=>3)),
        'sz'            =>  new sfWidgetFormInputText(array(),array('size'=>3)),
        'wg'            =>  new sfWidgetFormInputText(array(),array('size'=>3)),
        

    ));

    $this->widgetSchema->setNameFormat('package_dimension[%s]');


     $this->setValidators(array(
        'typ'           =>  new sfValidatorNumber(array('required' => true, 'max'=>2, 'min'=>1), array('required' => 'Określ czy przesyłka jest międzynarodowa')),
        'kraj'          =>  new sfValidatorPass(),
        'wy'            =>  new sfValidatorNumber(array('required' => true, 'max'=>140), array('required' => 'Musisz podać wysokość przesyłki')),
        'dl'            =>  new sfValidatorNumber(array('required' => true, 'max'=>60), array('required' => 'Musisz podać długość przesyłki')),
        'sz'            =>  new sfValidatorNumber(array('required' => true), array('required' => 'Musisz podać szerokość przesyłki')),
        'wg'            =>  new sfValidatorNumber(array('required' => true), array('required' => 'Musisz podać wagę przesyłki')),
        'r_wysylki'     =>  new sfValidatorPropelChoice(array('model' => 'PackagingGroups', 'column' => 'id', 'required' => true, )),
        'ilosc_paczek'  =>  new sfValidatorNumber(array('required' => true), array('required' => 'Musisz podać ilość paczek')),
    ));


    $this->widgetSchema->setLabels(array(
        'wy'            =>  'Wysokość [cm]',
        'dl'            =>  'Długość [cm]',
        'sz'            =>  'Szerokość [cm]',
        'wg'            =>  'Waga [kg]',
        'r_wysylki'     =>  'Rodzaj przesyłki',
        'ilosc_paczek'  =>  'Ilość paczek',
    ));


    $this->setDefault('r_wysylki', 2);
    $this->setDefault('typ', 1);
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
?>
