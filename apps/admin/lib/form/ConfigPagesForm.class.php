<?php
class ConfigPagesForm extends BaseForm
{
  public function configure()
  {

      $tiny_conf =  array(
        'width'=>'700',
        'height'=>'450',
        'config'=>'
	   	language: "en",
        plugins: "advimage,advlink,media,contextmenu",
        plugins: "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
     	theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak",
        file_browser_callback: "ajaxfilemanager"',


  	);
  	$this->setWidgets(array(
            'page_main'             => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_info'             => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_tariff'           => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_about'            => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_help'             => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_contact'          => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_rules'            => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box1_def'         => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box2_def'         => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box1_step0'       => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box1_step1'       => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box1_step2'       => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_box1_step3'       => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_order_success'    => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_active_mail'      => new sfWidgetFormTextareaTinyMCE($tiny_conf),
            'page_vat_tax'               => new sfWidgetFormInput(),
      	
    ));
    
    $this->widgetSchema->setLabels(array(
            'page_main'             => 'Strona główna',
            'page_info'             => 'Informacje',
            'page_tariff'           => 'Cennik',
            'page_about'            => 'O firmie',
            'page_help'             => 'Pomoc',
            'page_contact'          => 'Kontakt',
            'page_rules'            => 'Zasady pakowania',
            'page_box1_def'         => 'Box1 domyślnie',
            'page_box2_def'         => 'Box2 domyślnie',
            'page_box1_step0'       => 'Box1 krok0',
            'page_box1_step1'       => 'Box1 krok1',
            'page_box1_step2'       => 'Box1 krok2',
            'page_box1_step3'       => 'Box1 krok3',
            'page_order_success'    => 'Poprawne zamówienie',
            'page_vat_tax'               => 'Podatek VAT',
            'page_active_mail'      =>  'Mail aktywacyjny'
	));
	$this->widgetSchema->setNameFormat('page[%s]');
	
	$this->setValidators(array(
            'page_main'             => new sfValidatorString(array('required' => false)),
            'page_info'             => new sfValidatorString(array('required' => false)),
            'page_tariff'           => new sfValidatorString(array('required' => false)),
            'page_about'            => new sfValidatorString(array('required' => false)),
            'page_help'             => new sfValidatorString(array('required' => false)),
            'page_contact'          => new sfValidatorString(array('required' => false)),
            'page_rules'            => new sfValidatorString(array('required' => false)),
            'page_box1_def'         => new sfValidatorString(array('required' => false)),
            'page_box2_def'         => new sfValidatorString(array('required' => false)),
            'page_box1_step0'       => new sfValidatorString(array('required' => false)),
            'page_box1_step1'       => new sfValidatorString(array('required' => false)),
            'page_box1_step2'       => new sfValidatorString(array('required' => false)),
            'page_box1_step3'       => new sfValidatorString(array('required' => false)),
            'page_order_success'    => new sfValidatorString(array('required' => false)),
            'page_vat_tax'               => new sfValidatorString(array('required' => true)),
            'page_active_mail'      => new sfValidatorString(array('required' => false)),
		
    ));
	$this->widgetSchema->setFormFormatterName('table');
    
    $this->setDefaults(ConfigPeer::getConfig('page'));
  	
  	
  	 
    
  }
}
?>