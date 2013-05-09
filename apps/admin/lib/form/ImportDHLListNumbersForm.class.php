<?php

class ImportDHLListNumbersForm extends BaseForm
{
    public function configure()
    {
        $this->widgetSchema['start_number']     =   new sfWidgetFormInput();
        $this->widgetSchema['end_number']       =   new sfWidgetFormInput();
        $this->widgetSchema->setNameFormat('list_nr[%s]');

        $this->validatorSchema['start_number'] =   new sfValidatorInteger(array('required' => true), array('required' => 'Musisz podać numer początkowy'));
        $this->validatorSchema['end_number'] =   new sfValidatorInteger(array('required' => true), array('required' => 'Musisz podać numer końcowy'));

        $this->widgetSchema['start_number']->setLabel('Numer początkowy');
        $this->widgetSchema['end_number']->setLabel('Numer końcowy');
    }
}

?>
