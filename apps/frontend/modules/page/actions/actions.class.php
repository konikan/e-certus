<?php

/**
 * page actions.
 *
 * @package    e-certus
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
      $name = $request->getParameter('name');

      $pages = ConfigPeer::getConfig($name);
        //print_r($pages);
        if( isset($pages[$name]))
        {
            $this->text = $pages[$name];
        }
  }

  public function executeShippingInfo(sfWebRequest $request)
  {

     $pages = ConfigPeer::getConfig('page_info');
        //print_r($pages);
        if( isset($pages['page_info']))
        {
            $this->text = $pages['page_info'];
        }

     


    
  }


  public function executeGetBarCode39(sfWebRequest $request)
  {


      $this->setLayout(false);

      if($request->hasParameter('code'))
      {
            require(sfConfig::get('sf_lib_dir').'/vendor/barcodegen.1d-php5.v2.1.0/class/BCGFont.php');
            require(sfConfig::get('sf_lib_dir').'/vendor/barcodegen.1d-php5.v2.1.0/class/BCGColor.php');
            require(sfConfig::get('sf_lib_dir').'/vendor/barcodegen.1d-php5.v2.1.0/class/BCGDrawing.php');
            require(sfConfig::get('sf_lib_dir').'/vendor/barcodegen.1d-php5.v2.1.0/class/BCGcode39.barcode.php');

            $font = new BCGFont(sfConfig::get('sf_lib_dir').'/vendor/barcodegen.1d-php5.v2.1.0/class/font/Arial.ttf', 18);
            $color_black = new BCGColor(0, 0, 0);
            $color_white = new BCGColor(255, 255, 255);

            $code = new BCGcode39();

            $code->setScale(2);
            //$code->setThickness(30);
            $code->setForegroundColor($color_black);
            $code->setBackgroundColor($color_white);
            //$code->setFont($font);
            $code->setChecksum(false);
            $code->setLabel(false);
            //$code->setDisplayChecksum(false);
            $code->parse($request->getParameter('code'));

            // Drawing Part
            $drawing = new BCGDrawing('', $color_white);

            $drawing->setBarcode($code);
            $drawing->draw();

             $response = $this->getResponse();

            $response->setContentType('image/png');

            //$this->getResponse()->setContent($content) ->setHeader('Content-Type', );



            header('Content-Type: image/png');

            $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
            return sfView::SUCCESS;


           
      }
       return sfView::NONE;
  }

  public function executeListDHL(sfWebRequest $request)
  {

      sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
      
        $config = sfTCPDFPluginConfigHandler::loadConfig();

      // pdf object
      $pdf = new sfTCPDF();

      // settings
      //$pdf->SetFont("FreeSerif", "", 12);
      //$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
      //$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      //$pdf->SetHeaderData(null);
      //$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetHeaderMargin(0);
      $pdf->SetFooterMargin(0);
      //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      // init pdf doc
      $pdf->AliasNbPages();
      $pdf->AddPage();
      

      // set JPEG quality
        $pdf->setJPEGQuality(75);

      
      $pdf->Image(url_for('page/prepareImage?order_id='.$request->getParameter('order_id').'&to=1',true), 30, 5, 152, 70, 'JPEG', '', '', false, 150, '', false, false, 1, false, false, false );
      $pdf->Image(url_for('page/prepareImage?order_id='.$request->getParameter('order_id').'&to=2',true), 30, 75, 152, 70, 'JPEG', '', '', false, 150, '', false, false, 1, false, false, false );
      $pdf->Image(url_for('page/prepareImage?order_id='.$request->getParameter('order_id').'&to=3',true), 30, 145, 152, 70, 'JPEG', '', '', false, 150, '', false, false, 1, false, false, false );
      //$pdf->Image(url_for('page/prepareImage?order_id='.$request->getParameter('order_id').'&to=4',true), 30, 215, 152, 70, 'JPEG', '', '', false, 150, '', false, false, 1, false, false, false );


      // output
      $pdf->Output();

      // Stop symfony process
      //throw new sfStopException();


  }

  public function executePrepareImage(sfWebRequest $request)
  {
    if($request->hasParameter('order_id'))
    {

        $order = OrderShippingPeer::retrieveByPK($request->getParameter('order_id'));
        

        $sender = $order->getSender();
        $recipient = $order->getRecipient();
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');


        $image = imagecreatefromjpeg(sfConfig::get('sf_lib_dir').'/vendor/LIST_DHL.jpg');
        $barcode = imagecreatefrompng(url_for('page/getBarCode39?code='.$order->getListNumber(), true));

        // Copy
        imagecopy($image, $barcode, 240, 45, 0, 0,  imagesx($barcode),imagesy($barcode));

        $white = imagecolorallocate($image, 255, 255, 255);
        $grey = imagecolorallocate($image, 128, 128, 128);
        $black = imagecolorallocate($image, 0, 0, 0);
        // The text to draw
        $to = $request->getParameter('to');
        if($to==1)
        {
            $text = $this->PLttf('List przewozowy - EGZEMPLARZ DLA ODBIORCY');
        }
        else if($to == 2)
        {
            $text = $this->PLttf('List przewozowy - EGZEMPLARZ DLA DHL (ZAŁĄCZNIK DO DWP)');
        }
        else if($to == 3)
        {
            $text = $this->PLttf('List przewozowy - EGZEMPLARZ DLA DHL (ZAŁĄCZNIK DO DRP)');
        }
         else if($to == 4)
        {
            $text = $this->PLttf('List przewozowy - EGZEMPLARZ DLA NADAWCY');
        }
        else
        {
            $text = $this->PLttf('List przewozowy');
        }

        
        // Replace path by your own font path
        $font = sfConfig::get('sf_lib_dir').'/vendor/arial.ttf';

        // Add some shadow to the text
       imagettftext($image, 14, 0, 30, 31, $black, $font, $text);

        imagettftext($image, 14, 0, 296, 131, $black, $font, $order->getListNumber());

        if(isset ($sender))
        {
           // echo $sender;
             imagettftext($image, 14, 0, 65, 335, $black, $font, $this->PLttf($sender));
             imagettftext($image, 14, 0, 65, 355, $black, $font, $this->PLttf($sender->getStreet().' '.$sender->getStreetNr()));
             imagettftext($image, 14, 0, 65, 375, $black, $font, $this->PLttf(str_replace('-', '', $sender->getPostcode()).' '.$sender->getCity()));
        }

        if(isset ($recipient))
        {
           // echo $sender;
             imagettftext($image, 14, 0, 65, 245, $black, $font, $this->PLttf($recipient));
             imagettftext($image, 14, 0, 65, 265, $black, $font, $this->PLttf($recipient->getAddress()));
             imagettftext($image, 14, 0, 65, 285, $black, $font, $this->PLttf(str_replace('-', '', $recipient->getPostcode()).' '.$recipient->getCity()));
        }

        $weight = $order->getWeight();
        //echo $order->getPackagingTypes();
        if($order->getPackagingTypes()->getServiceId() == 'PK')
        {
            imagettftext($image, 14, 0, 55, 175, $black, $font, $order->getNumberOfPackages());
            imagettftext($image, 14, 0, 195, 175, $black, $font,'0' );
            imagettftext($image, 14, 0, 105, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 145, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 250, 175, $black, $font, '0');
        }
        else
        {
        imagettftext($image, 14, 0, 55, 175, $black, $font, '0');
        if($weight<=5)
        {
            
                imagettftext($image, 14, 0, 195, 175, $black, $font,'0' );
                imagettftext($image, 14, 0, 105, 175, $black, $font, $order->getNumberOfPackages());
                imagettftext($image, 14, 0, 145, 175, $black, $font, '0');
                imagettftext($image, 14, 0, 250, 175, $black, $font, '0');
            
        }
        else if($weight<=10){
            imagettftext($image, 14, 0, 195, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 105, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 145, 175, $black, $font, $order->getNumberOfPackages());
            imagettftext($image, 14, 0, 250, 175, $black, $font, '0');
        }
        else if($weight<=20){
            imagettftext($image, 14, 0, 195, 175, $black, $font, $order->getNumberOfPackages());
            imagettftext($image, 14, 0, 105, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 145, 175, $black, $font, '0');
            imagettftext($image, 14, 0, 250, 175, $black, $font, '0');
        }
        else if($weight<=31.5){
            imagettftext($image, 14, 0, 80, 150, $black, $font, $order->getNumberOfPackages());
        }

            }
        //paleta 200 narazie nie obługiwane
       imagettftext($image, 14, 0, 40, 218, $black, $font, '0');
        //paleta 400 narazie nie obługiwane
       imagettftext($image, 14, 0, 75, 218, $black, $font, '0');
       // //paleta 600 narazie nie obługiwane
       imagettftext($image, 14, 0, 110, 218, $black, $font, '0');
       ///paleta 800 narazie nie obługiwane
       imagettftext($image, 14, 0, 145, 218, $black, $font, '0');
        ///paleta 1000 narazie nie obługiwane
       imagettftext($image, 14, 0, 180, 218, $black, $font, '0');


        //Numer SAP
        imagettftext($image, 14, 0, 518, 430, $black, $font, $order->getCourier()->getClientNr());

        //Drukowanie opcji

        $options = $order->getOrderShippingOptionss();
        $type = $order->getShippingTypes();
        $group = $type->getShippingTypesGroups();


        $group_name = $group->getCode();
        //Usługi termonowe
        if($group_name == 'DHL09' || $group_name == 'DHL12' ||  $group_name == 'EX_17_22' || $group_name == 'EX_SOB')
        {
             imagettftext($image, 14, 0, 475, 218, $black, $font, $group->getShortName() );
        }

        if($group_name == 'DHL09' )
        {
             imagettftext($image, 12, 0, 30, 130, $black, $font, $this->PLttf('DHL DOMESTIC EXPRESS 9:00') );
        }
        else if($group_name == 'DHL12' )
        {
            imagettftext($image, 12, 0, 30, 130, $black, $font, $this->PLttf('DHL DOMESTIC EXPRESS 12:00') );
        }
        else
        {
            imagettftext($image, 12, 0, 30, 130, $black, $font, $this->PLttf('PRZESYŁKA KRAJOWA') );
        }


        $line_height = 55;

            imagettftext($image, 8, 0, 613, $line_height, $black, $font, $this->PLttf($type->getShortName()));
            imagettftext($image, 14, 0, 597, $line_height, $black, $font, 'X');
        
        $line_height += 22;
        imagettftext($image, 8, 0, 613, $line_height, $black, $font, $this->PLttf('OPŁATA PALIWOWA'));
        imagettftext($image, 14, 0, 597, $line_height, $black, $font, 'X');
        $line_height += 22;
        foreach ($options as $option)
        {
            $shipping_option = $option->getShippingOptions();
            if($shipping_option->getServiceId() == 'COD')
            {
                imagettftext($image, 12, 0, 870, 210, $black, $font, $option->getAmount());
                imagettftext($image, 14, 0, 814, 193, $black, $font, 'X');
            }
            if($shipping_option->getCode() == 'ins')
            {
                imagettftext($image, 12, 0, 870, 148, $black, $font, $option->getAmount());

            }
            imagettftext($image, 8, 0, 613, $line_height, $black, $font, $this->PLttf($shipping_option->getShortName()));
            imagettftext($image, 14, 0, 597, $line_height, $black, $font, 'X');
            $line_height += 22;

        }

        // Output PNG
        header("Content-type: image/jpg");
        imagejpeg($image);
        imagedestroy($image);

        return sfView::SUCCESS;
    }
    else
        return sfView::ERROR;

  }


  private function PLttf($text)
    {
        $znaki = Array (
          "ą"=>"&#261;",
          "Ą"=>"&#260;",
          "ę"=>"&#281;",
          "Ę"=>"&#280;",
          "ł"=>"&#322;",
          "Ł"=>"&#321;",
          "Ń"=>"&#323;",
          "ń"=>"&#324;",
          "Ś"=>"&#346;",
          "ś"=>"&#347;",
          "Ź"=>"&#377;",
          "ź"=>"&#378;",
          "Ż"=>"&#379;",
          "ż"=>"&#380;",
          "Ć"=>"&#262;",
          "ć"=>"&#263;",
          "Ľ"=>"&#378;",
          "?"=>"&#377;",
          "?"=>"&#261;",
          "ˇ"=>"&#260;",
          "?"=>"&#347;",
          "?"=>"&#346;",
          "ó"=>"&#243;",
          "Ó"=>"&#211;",
          );


        return strtr($text,$znaki);
    }


    public function  executeRules(sfWebRequest $request) {
       $courier_name = strtoupper($request->getParameter('name'));

       $c = new Criteria();
       $c->add(CourierPeer::NAME,$courier_name);

       $this->courier = CourierPeer::doSelectOne($c);
    }

}
