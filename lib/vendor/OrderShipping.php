<?php

/**
 * Skeleton subclass for representing a row from the 'order_shipping' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Aug 30 14:40:56 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OrderShipping extends BaseOrderShipping {

   public function  __toString() {
       return $this->getId().'/'.$this->getCreatedAt('Y');
   }

   public function getSender()
   {
       $senders = $this->getOrderShippingSenders();
       if(isset($senders[0]))
       {
           return $senders[0];
       }
   }

   public function getRecipient()
   {
       $recipients = $this->getOrderShippingRecipients();
       if(isset($recipients[0]))
       {
           return $recipients[0];
       }
   }

   public function getTextStatus()
   {
       switch ($this->getStatus())
       {
           case 0:
               return "Nowe";
               break;
           case 1:
               return "Przekazane do firmy kurierskiej";
               break;
           case 2:
               return "Zrealizowane";
               break;
           case 3:
               return "Anulowane";
               break;
           default:
               return $this->getStatus();
               break;
       }
   }


  public function generate_DHL_LN()
  {
      //pobierz wolny numer listu
       $list_num = DhlNumbersPeer::getFreeNumber();
       if($list_num)
       {
           $numer = $list_num->getListNumber();
           $suma_kontrolna = $this->getCourier()->prepare_DHL_LN($numer);
           $numer_listu = (string)$numer.(string)$suma_kontrolna;
           $this->setListNumber($numer_listu);
           $this->save();
           $list_num->setFree(0);
           $list_num->setUsed(1);
           $list_num->setOrderId($this->getId());
           $list_num->setTimeOfUse(time());
           $list_num->save();


       }
  }

/*
 * Metoda zleca zamówienie kuriera
 */
  public function requestCourier()
  {
       //Nowe zamówienie jeszcze nie zlecane do firmy kurierskiej
            if($this->getStatus() == 0)
            {

                //Kurier obsługujacy zamowienie
                $courier = $this->getCourier();
                //Jezeli kurier to firma DHL wykonujemy zledania dla dhla

                /*
                 * INTEGRACJA Z FIRMA KURIERSKA DHL
                 */
                if(strtoupper($courier->getName()) == 'DHL')
                {
                    //generujemy numer listu przewozowego
                    $this->generate_DHL_LN();
                    //jezeli zlecil zamowienie kuriera
                    if(!$this->getSelfGiving())
                    {
                        //wysyłamy zlecenie do firmy kurierskiej
                        //TODO: Przeniesc ta akcje do modelu zamowien
                        $courier->DHL_order_courier($this->getId());
                        //TODO:
                        //Wyslij email z bledem
                        //
                        //generujemy plik z nadaniem i umieszczamy go naserwerze
                        $courier->generate_DHL_DWP_FILE($this->getId(), true);
                    }

                    
                }
                //KONIEC DHL

                /*
                 * INTEGRACJA Z FIRMA KURIERSKA UPS
                 * TODO: W fazie wdrażania!!!!
                 */
                if(strtoupper($courier->getName()) == 'UPS')
                {
                   //$this->error_code = 10;

                  if($this->getSelfGiving() == 1)
                         $this->executeToUPS(false);
                  else
                      $this->executeToUPS(true);
                  



                }
                //KONIEC UPS

                

            }
  }

  public function sendEmailOrderInformation()
  {
      
  }

  /*
   * Copyright: Paweł Zawada
   *
   * Autor: Paweł Zawada
   * Wszelkie prawa zastrzeżone.
   *
   * Metoda odpowada za zalogowanie sie do serwisu ups.com
   *
   */

  function login_to_UPS()
  {
    //Logowanie do ups
    $cookie_file = sfConfig::get('sf_lib_dir').'/vendor/cookie.txt';
    $c = curl_init('https://wwwapps.ups.com/cclamp/login');

    curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_URL, 'https://wwwapps.ups.com/cclamp/login');
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, 'userid=konikan&password=princess&autoPopID=on&sret=http://www.ups.com/content/pl/pl/index.jsx?WT.svl=BrndMrk&uret=http://www.ups.com/content/pl/pl/index.jsx?WT.svl=BrndMrk&ctxcc=pl_PL');
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

    //print_r(curl_getinfo($c));

    $s = curl_exec($c);
    curl_close($c);

    return $cookie_file;
    }
     /*
   * Copyright: Paweł Zawada
   *
   * Autor: Paweł Zawada
   * Wszelkie prawa zastrzeżone.
   *
   * Nowa metoda  zalogowanie sie do serwisu ups.com
   * 15-07-2011
   *
   */

 public static function login_to_UPS_v2()
 {
    //Logowanie do ups
    try
    {
        $cookie_file = sfConfig::get('sf_lib_dir').'/vendor/cookie.txt';

        $step1 = 'lang=null&langc=null&loc=pl_PL&method=null&next=Nast%C4%99pny&rememberMe=1&returnto=http%3A%2F%2Fwww.ups.com%2Fcontent%2Fpl%2Fpl%2Findex.jsx%3FWT.svl%3DBrndMrk&sysid=null&uid=konikan';
        $step2 = 'lang=null&langc=null&loc=pl_PL&login=Zaloguj&method=null&password=princess&returnto=http%3A%2F%2Fwww.ups.com%2Fcontent%2Fpl%2Fpl%2Findex.jsx%3FWT.svl%3DBrndMrk&sysid=null';


        $c = curl_init('https://www.ups.com/one-to-one/login');

        curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_URL, 'https://www.ups.com/one-to-one/login');
        curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $step1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        //print_r(curl_getinfo($c));

        $s = curl_exec($c);
        curl_close($c);

        $c = curl_init('https://www.ups.com/one-to-one/login');

        curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_URL, 'https://www.ups.com/one-to-one/login');
        curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $step2);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        //print_r(curl_getinfo($c));

        $s = curl_exec($c);
        curl_close($c);
        //echo $s;
        //$ret = $this->curlRead('https://www.ups.com/uis/create?loc=pl_PL&WT.svl=PNRO_L1', $cookie_file, false);
        return $cookie_file;

    }
    catch (Exception $e) {
        //echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
   
    }
    
    public static function cleanUPSShippingForm()
    {
        $cookie_file = sfConfig::get('sf_lib_dir').'/vendor/cookie.txt';
        //$ret = OrderShipping::curlRead('https://www.ups.com/uis/create?loc=pl_PL', $cookie_file, false);
    }

    /**
     *
     * Copyright: Paweł Zawada
     * Autor: Paweł Zawada
     *
     * Wszelkie prawa zastrzeżone.
     *
     * Metoda odpowiada za wywołanie adresu url
     *
     * @param <type> $url
     * @param <type> $cookie_file
     * @param <type> $post
     * @param <type> $post_data
     * @return <type>
     */

    public static function curlRead($url, $cookie_file, $post = false, $post_data = array())
    {
        $curl = curl_init($url);
    //            curl_setopt($curl, CURLOPT_URL, 'https://www.ups.com/uis/create?loc=pl_PL');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, $post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.122 Safari/534.30");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); /* SAME cookiefile */
        if ($post && count($post_data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }

        $xxx = curl_exec($curl);

        curl_close($curl);
        return $xxx;
    }

    /**
     * Copyright: Paweł Zawada
     * Autor: Paweł Zawada
     *
     * Wszelkie prawa zastrzeżone.
     *
     * Metoda odpowaiada za wypełnienie oraz wysłanie formularza przygotowania przesyłki
     * na stronie ups.com.
     * Metoda w zależności od podanych parametrów zamawia kuriera, pobiera numer przesyłki oraz list przewozowy
     */
    function executeToUPS($requestPickup=true, $options_array=array())
    {
        
        // $cookie_file = sfConfig::get('sf_lib_dir').'/vendor/cookie.txt';

       $cookie_file = OrderShipping::login_to_UPS_v2();
        try {
            $ret = $this->curlRead('https://www.ups.com/uis/create?loc=pl_PL', $cookie_file, false);

        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
        }

        
        
      

        $sender                 =   $this->getSender();
        $consignee              =   $this->getRecipient();
        if($this->getIsInternational()!=1 )
        {
            $service_type           =   $this->getShippingTypes();
            $service_type_group     =   $service_type->getShippingTypesGroups();
            $order_shipping_options       =   $this->getOrderShippingOptionss();
            $packageType            =   $this->getPackagingTypes();
        }
        else
        {
             $order_shipping_options       =   $this->getOrderShippingZonesServicessJoinZonesServices();
            $packageType            =   $this->getPackagingTypes();
        }
        $time = time();

        //Ustalenie niezbednych zmiennych
        //--------------------------------------------------------------------------------------------------------------------------
        //Odbiorca
        $consigneeAddress_city                                          =strtoupper($this->replacePolishChars($consignee->getCity()));
        $consigneeAddress_contactName                                   =$this->replacePolishChars($consignee->getContactName());
        $consigneeAddress_email						=$consignee->getEmail();
        $consigneeAddress_name						=$this->replacePolishChars($consignee->getRecipientName());
        $consigneeAddress_postalCode                                    =str_replace('-', '',$consignee->getPostcode());
        $consigneeAddress_street					=$this->replacePolishChars($consignee->getAddress());
        $consigneeAddress_telephone					=$consignee->getTel();
        //echo $consigneeAddress_city;
        //echo $consigneeAddress_contactName;
        //echo $consigneeAddress_name;
        //Nadawca
        $shipFromAddress_city						=       strtoupper($this->replacePolishChars($sender->getCity()));
        $shipFromAddress_contactName                                    =	$this->replacePolishChars($sender->getContactName());
        $shipFromAddress_email						=	$sender->getEmail();
        $shipFromAddress_name						=	strtoupper($this->replacePolishChars($sender->getSenderName()));;
        $shipFromAddress_postalCode					=	str_replace('-', '',$sender->getPostcode());
        $shipFromAddress_street						=	$this->replacePolishChars($sender->getStreet().' '.$sender->getStreetNr());
        $shipFromAddress_telephone					=	$sender->getTel();
        $shipToCityHist                                                 =	strtoupper($this->replacePolishChars($consignee->getCity()));
        $shipToPostalHist                                               =	strtoupper($this->replacePolishChars($sender->getCity()));
        $shipToStateHist                                                =	str_replace('-', '',$sender->getPostcode());
        $additionalHandlingPackageCount                                 =	'0';
        if($shipFromAddress_contactName == '')
        {
            $shipFromAddress_contactName = $shipFromAddress_name;
        }
        //Parametry opcji
        $have_ADDITIONAL = false;
        $shipmentBean_declaredValue_insuredAmount                       =	'';
        $shipperAddress_contactName					=	$this->replacePolishChars($sender->getContactName());
        $serviceBean_service						=	$service_type_group->getServiceId();
        $shipmentBean_packageType					=	$packageType->getServiceId();
        if(isset($requestPickup) && $requestPickup==true)
                $pickupAction                                           =	'OnCallPickupRequest';
        else
                $pickupAction                                           =	'';
        $shipmentBean_weight						=	$this->getNormalWeight();
        $packageCount                                                   =       $this->getNumberOfPackages();
        $transportationPayer_accountString                              =	'10_W5R494';
        $oncallPickup_pickupDate					=	'';
       
        foreach ($order_shipping_options as $order_option)
        {
            $option=$order_option->getShippingOptions();
            //Ubezpieczenie
            if($option->getCode() == 'ins' || $option->getServiceId() == 'shipmentBean.declaredValue.insuredAmount')
            {
                $shipmentBean_declaredValue_insuredAmount   = number_format($order_option->getAmount(),0,'.','');
            }
            //Pobranie
            if($option->getCode() == 'cash_on_delivery' || $option->getServiceId() == 'SHIP_COLLECT_ON_DELIVERY')
            {
                $shipmentOption_collectOnDeliveryAmount   =	$order_option->getAmount();
                $options_array['SHIP_COLLECT_ON_DELIVERY'] = true;
            }
            //Uzyskaj potwierdzenie doręczenia
            if($option->getCode() == 'POD' || $option->getServiceId() == 'SHIP_DELIVERY_CONFIRMATION')
            {
                
                $options_array['SHIP_DELIVERY_CONFIRMATION'] = true;
            }
            //Zwrot potwierdzonych dokumentów (ROD)
            if($option->getCode() == 'POD' || $option->getServiceId() == 'RETURN_OF_DOCUMENTS')
            {
               
                $options_array['RETURN_OF_DOCUMENTS'] = true;
            }

            
        }
        //Zamowienie kuriera
        if($this->getSelfGiving() != 1)
        {
            $oncallPickup_pickupDate = str_replace('-', '', $this->getDateOfReceipt());
            $have_ADDITIONAL = true;
        }
        //Ubezpieczenie

        
        

        //--------------------------------------------------------------------------------------------------------------------------

        //Ustalenie Nadawcy
        //W fazie implementacji
$step_0 = 'ActionOriginPair=EditShipFrom_ShippingPage___EditAddress
&Address1=
&Address2=
&Address3=
&City=
&Company=
&ContactName=
&Country=
&Email=
&Ext=
&Fax=
&Other=
&Phone=
&PostalCode=
&RedirectHref=
&State=
&address.addr2=
&address.addr3=
&address.city='.$shipFromAddress_city.'
&address.contactName='.$shipFromAddress_contactName.'
&address.country=PL
&address.email='.$shipFromAddress_email.'
&address.extension=
&address.name='.$shipFromAddress_name.'
&address.postalCode='.$shipFromAddress_postalCode.'
&address.state=
&address.street='.$shipFromAddress_street.'
&address.telephone='.$shipFromAddress_telephone.'
&addressOption.addressBookId=00
&addressOption.collapsed=true
&addressOption.nickName=
&addressOption.saveOption=
&app-context=/uis
&loc=pl_PL
&shipFrom=
&shipFromCityHist=
&shipFromLocale=pl_PL
&shipFromLocale=UIS
&shipFromPolDiv3=
&shipFromPostalHist=
&shipFromStateHist=
';
$step_0 = str_replace("\n","",$step_0);
//echo $step_0;
 //$ret = $this->curlRead('https://www.ups.com/uis/create?ActionOriginPair=EditShipFrom_ShippingPage___EditAddress&loc=pl_PL', $cookie_file, true, $step_0 );
//echo $ret;
//
//KROK PIERWSZY WYPELNIENIA FORMULARZA
$country = 'PL';
if($this->getIsInternational() == true){$country = strtoupper($this->getCountries()->getShort());}

$step_1='ActionOriginPair=Next___CreateAShipment
&Address1=
&Address2=
&Address3=
&City=
&Company=
&ContactName=
&Country=
&Email=
&Ext=
&Fax=
&Other=
&Phone=
&PostalCode=
&RedirectHref=
&State=
&addressBookNickname=
&app-context=/uis
&associatedAccount.accountString=00_99
&associatedAccount.thirdPartyAccount.country=LV
&businessPurpose=true
&consigneeAddress.addr2=
&consigneeAddress.addr3=
&consigneeAddress.city='.$consigneeAddress_city.'
&consigneeAddress.contactName='.trim($consigneeAddress_contactName).'
&consigneeAddress.country=PL
&consigneeAddress.email=
&consigneeAddress.extension=
&consigneeAddress.name='.trim($consigneeAddress_name).'
&consigneeAddress.postalCode='.$consigneeAddress_postalCode.'
&consigneeAddress.state=
&consigneeAddress.street='.$consigneeAddress_street.'
&consigneeAddress.telephone=
&consigneeOption.addressBookId=
&consigneeOption.collapsed=false
&consigneeOption.nickName=
&consigneeOption.saveOption=
&dutiesPayer.accountString=00_99
&dutiesPayer.thirdPartyAccount.country=LV
&isSelectedDistro=false
&loc=pl_PL
&packageCount='.$packageCount.'
&reviewDetails=true
&samePackageAttribute=true
&serviceBean.service='.$serviceBean_service.'
&shipFromAddress.addr2=
&shipFromAddress.addr3=
&shipFromAddress.city='.$shipFromAddress_city.'
&shipFromAddress.contactName='.$shipFromAddress_contactName.'
&shipFromAddress.country='.$country.'
&shipFromAddress.email='.$shipFromAddress_email.'
&shipFromAddress.extension=
&shipFromAddress.name='.$shipFromAddress_name.'
&shipFromAddress.postalCode='.$shipFromAddress_postalCode.'
&shipFromAddress.residential=false
&shipFromAddress.state=
&shipFromAddress.street='.$shipFromAddress_street.'
&shipFromAddress.telephone='.$shipFromAddress_telephone.'
&shipFromOption.addressBookId=00
&shipTo=
&shipToCityHist=
&shipToLocale=pl_PL
&shipToLocale=UIS
&shipToPolDiv3=
&shipToPostalHist=
&shipToStateHist=
&shipmentBean.additionalHandlingPackageCount=0
&shipmentBean.customsValue=
&shipmentBean.declaredValue.insuredAmount='.$shipmentBean_declaredValue_insuredAmount.'
&shipmentBean.dimWeight=
&shipmentBean.largePackageCount=0
&shipmentBean.movementReferenceNumber=
&shipmentBean.packageType='.$shipmentBean_packageType.'
&shipmentBean.reference.value%231=
&shipmentBean.reference.value%232=
&shipmentBean.weight='.$shipmentBean_weight.'
&shipperAddress.contactName='.$shipFromAddress_contactName.'
&shipperAddress.name='.$shipFromAddress_name.'
&shipperAddress.street='.$shipFromAddress_street.'
&shipperAddress.email='.$shipFromAddress_email.'
&shipperAddress.postalCode='.$shipFromAddress_postalCode.'
&shipperAddress.telephone='.$shipFromAddress_telephone.'
&shipperAddress.country=PL
&shipperAddress.country=PL
&shipperAddress.state=
&shipperCityHist=
&shipperLocale=pl_PL
&shipperLocale=UIS
&shipperOption.addressBookId=
&shipperOption.collapsed=true
&shipperPolDiv3=
&shipperPostalHist=
&shipperSameAsShipFrom=true
&shipperStateHist=
&transportationPayer.accountString='.$transportationPayer_accountString.'
&transportationPayer.thirdPartyAccount.country=LV
&pickupAction='.$pickupAction.'';




        //uslugi dodatkowe

        //$options_array = array('SHIP_COLLECT_ON_DELIVERY');
        
        foreach($options_array as $key=>$value)
        {
                if($value == true)
                {
                        $step_1 .='&shipmentServiceOption='.$key;
                        $have_ADDITIONAL = true;

                }
        }
        
        //Usun znaki nowej linii;
        //$step_1 = $this->buildUPSquery();
        $step_1 = str_replace("\n","",$step_1);
        //echo $step_1;
        //Wyślij formularz
        try
        {
            $ret = $this->curlRead('https://www.ups.com/uis/create', $cookie_file, true, $step_1 );
        }
        catch (Exception $e)
        {

        }
        //
        //KONIEC KROKU PIERWSZEGO
        //

        


        //W przypadku planowania kuriera, badz dodatkowych opcji wypelnieny posreni formularz
if($have_ADDITIONAL == true)
{
//echo "DUPA";
$step_1a='ActionOriginPair=Next___AdditionalShippingOptions
&RedirectHref=
&app-context=/uis
&loc=pl_PL
&oncallPickup.earlyTimeAmPm=1
&oncallPickup.earlyTimeHour=01
&oncallPickup.earlyTimeMin=00
&oncallPickup.latestTimeHour=05
&oncallPickup.latestTimeMin=00
&oncallPickup.pickupAddress.addr2=
&oncallPickup.pickupAddress.addr3=
&oncallPickup.pickupAddress.city='.$shipFromAddress_city.'
&oncallPickup.pickupAddress.contactName='.$shipFromAddress_contactName.'
&oncallPickup.pickupAddress.country=PL
&oncallPickup.pickupAddress.email='.$shipFromAddress_email.'
&oncallPickup.pickupAddress.extension=
&oncallPickup.pickupAddress.name='.$shipFromAddress_name.'
&oncallPickup.pickupAddress.postalCode='.$shipFromAddress_postalCode.'
&oncallPickup.pickupAddress.state=
&oncallPickup.pickupAddress.street='.trim($shipFromAddress_street).'
&oncallPickup.pickupAddress.telephone='.$shipFromAddress_telephone.'
&oncallPickup.pickupDate='.$oncallPickup_pickupDate.'
&oncallPickup.pickupLocation=
&oncallPickup.pickupReferenceNumber=
&shipmentOption.proactiveResponse=
&shipmentOption.refrigeration=false';
if(isset($shipmentOption_collectOnDeliveryAmount))
{
$step_1a .='&shipmentOption.collectOnDeliveryAmount='.$shipmentOption_collectOnDeliveryAmount.'
&shipmentOption.collectOnDeliveryCurrency=PLN
&shipmentOption.collectOnDeliveryPaymentMethod=01';
}

//Usuwamy znaki nowej linii
$step_1a = str_replace("\n","",$step_1a);
//$step_1a = trim($step_1a);
//echo $step_1a;
//Wyslanie formularza
try
{
    $ret = $this->curlRead('https://www.ups.com/uis/create', $cookie_file, true, $step_1a);
}
 catch (Exception $e)
 {
     
 }
//echo $ret;

}

//
//KROK 3 WYSLANIE KONCOWEGO FORMULARZA
//

$step_2 = 'ActionOriginPair=ShipNow___ReviewShipment
&loc=pl_PL
&RedirectHref=
&app-context=/uis
&selectedAccessory=
&consignee.contactName='.$consigneeAddress_contactName.'
&consignee.name='.$consigneeAddress_name.'
&consignee.street='.$consigneeAddress_street.'
&consignee.addr2=
&consignee.addr3=
&consignee.postalCode='.$consigneeAddress_postalCode.'
&consignee.city='.$consigneeAddress_city.'
&consignee.state=
&consignee.country=PL
&consignee.telephone=
&consignee.extension=
&consignee.email=
&consignee.residential=false
&shipFrom.contactName='.$shipFromAddress_contactName.'
&shipFrom.name='.$shipFromAddress_name.'
&shipFrom.street='.$shipFromAddress_street.'
&shipFrom.addr2=
&shipFrom.addr3=
&shipFrom.postalCode='.$shipFromAddress_postalCode.'
&shipFrom.city='.$shipFromAddress_city.'
&shipFrom.state=
&shipFrom.country=PL
&shipFrom.telephone='.$shipFromAddress_telephone.'
&shipFrom.extension=
&shipFrom.email='.$shipFromAddress_email.'
&shipFrom.residential=false
&shipper.contactName='.$shipFromAddress_contactName.'
&shipper.name='.$shipFromAddress_name.'
&shipper.street='.$shipFromAddress_street.'
&shipper.addr2=
&shipper.addr3=
&shipper.postalCode='.$shipFromAddress_postalCode.'
&shipper.city='.$shipFromAddress_city.'
&shipper.state=
&shipper.country=PL
&shipper.telephone='.$shipFromAddress_telephone.'
&shipper.extension=
&shipper.email='.$shipFromAddress_email.'
&shipper.residential=false
&service='.$serviceBean_service.'
';

//Usun znaki nowej linii
$step_2 = str_replace("\n","",  $step_2);


//Potwierdzenie zamowienia
$ret = $this->curlRead('https://www.ups.com/uis/create', $cookie_file, true, $step_2);

echo $ret;
if(preg_match('|"(shipment_[0-9]{8,13}:label[0-9])"|',$ret, $match1))
{
    //print_r($match1);
}
 $ret = str_ireplace("\n", "", $ret);
            if (preg_match('|secBody.+div|', $ret, $match)) {
                preg_match('|dd.*>([0-9A-Z]+)</dd|', $match[0], $num_arr);
                //echo '<pre>';
                //var_dump($num_arr);
               // echo '</pre>';
                $num = $num_arr[0];
            } else {
                $num = "nope";
            }
            // Jezeli uzyskalismy numer nadania no to jest ok
             if($num != '' && $num != 'nope')
            {
                $this->setListNumber($num);
                $this->setStatus(1);
                $this->save();
            
            //echo '<h2>Numer nadania: '.$num.'</h2>';

            if (preg_match("|viewPrint.*'(\d+)',\s*'([^']*)',\s1,\s*'pl_PL|", $ret, $match)) {
               // echo '<pre>';
               // var_dump($match);
              //  echo '</pre>';
               
                $pid = $match[2];
                //https://www.ups.com/uis/create?ActionOriginPair=Print___Receipt&PrinterID=SVM0MDY0MjM2OQ%3D%3D8759&loc=pl_PL&labelMask=0-&labelType=GIF&printInstructionsOnLabel=A&receiptType=GIF&sampleLabel=false&parent=true&1299878387598
                //$link = "https://www.ups.com/uis/Label?FNC=getImage__Adummy_html___{$time}___image/png___&labelMask=0&labelType=png&parent=false&printInstructionsOnLabel=A&PrinterID=$pid&.&appid=UIS";
                

                $img_file = fopen(sfConfig::get('sf_upload_dir')."/$num.png",'w');
                fwrite($img_file, $ret);
                fclose($img_file);
                 
                
    }
    $link = 'https://www.ups.com/uis/create?ActionOriginPair=default___PrintWindowPage&key=labelWindow&type=html&loc=pl_PL&instr=A&doc='.$match1[1];
    //'https://www.ups.com/uis/create?ActionOriginPair=default___PrintWindowPage&key=labelWindow&type=html&loc=pl_PL&doc=shipment_1999781525:label0'
    $ret_label = $this->curlRead($link, $cookie_file);
         
                //echo $ret_label;
                sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
      
        $config = sfTCPDFPluginConfigHandler::loadConfig();

      // pdf object
      $pdf = new sfTCPDF();


      $pdf->SetHeaderMargin(0);
      $pdf->SetFooterMargin(0);
    
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $text = strip_tags($ret_label, '<div></div><table></table><tbody></tbody><tr></tr><td></td><b></b><center></center>');
     //echo $text;

      // set JPEG quality
        //$pdf->s(75);
      try
      {
          $ups_label = $this->curlRead('https://www.ups.com/uis/Label?key='.$match1[1].'&labelType=png&.',$cookie_file);

      //echo $ups_label;
      $img_file = fopen(sfConfig::get('sf_data_dir').'/UPS/'.$this->getId().'.png','w');
                fwrite($img_file, $ups_label);
                fclose($img_file);
      
      $pdf->Image(sfConfig::get('sf_data_dir').'/UPS/'.$this->getId().'.png', 30, 145, 152, 70, 'PNG', '', '', false, 150, '', false, false, 1, false, false, false  );
      $pdf->writeHTML($text, true, false, true, false, '');
      $pdf->Output(sfConfig::get('sf_data_dir').'/UPS/'.$this->getId().'.pdf','F');
      }
        catch (Exception $e)
        {

        }
                //echo $ret;
    //$cookie_file = $this->login_to_UPS_v2();
    //$cookie_file = $this->login_to_UPS_v2();
//echo "DUPA";
            }
            //Jezeli nie uzyskalismy numeru nadania
            //sprobuj jeszcze raz
            // logujas sie na nowo
            else
            {
                //$this->login_to_UPS_v2();
                //$this->executeToUPS();
            }

}
    //Koniec metody wypelniajacej formularz na ups.com

    /**
     *Copyright Pawel Zawada
     *Autor: Pawel Zawada
     *
     * Wszystkie prawa zastrzezone.
     *
     *
     * Metoda prasuje wynik wypelenienia formularza na ups.com
     * i zwraca numer przesylki (listu/etykiety)
     * @param <type> $ret
     */
    function getParseListNumber($ret='')
    {

    }


    /*
     * Metoda podmienia polskie litery na standardowe litery
     */
    public function replacePolishChars($text='', $from = 'utf8')
    {
        //remove_pl by tosiek - http://tosiek.pl/
	if($from == 'utf8') {
		$from = array(
			"\xc4\x85", "\xc4\x87", "\xc4\x99",
			"\xc5\x82", "\xc5\x84", "\xc3\xb3",
			"\xc5\x9b", "\xc5\xba", "\xc5\xbc",
			"\xc4\x84", "\xc4\x86", "\xc4\x98",
			"\xc5\x81", "\xc5\x83", "\xc3\x93",
			"\xc5\x9a", "\xc5\xb9", "\xc5\xbb",
		);
	}elseif($from == 'latin2') {
		$from = array(
			"\xb1", "\xe6", "\xea",
			"\xb3", "\xf1", "\xf3",
			"\xb6", "\xbc", "\xbf",
			"\xa1", "\xc6", "\xca",
			"\xa3", "\xd1", "\xd3",
			"\xa6", "\xac", "\xaf",
		);
	}elseif($from == 'cp1250') {
		$from = array(
			"\xb9", "\xe6", "\xea",
			"\xb3", "\xf1", "\xf3",
			"\x9c", "\x9f", "\xbf",
			"\xa5", "\xc6", "\xca",
			"\xa3", "\xd1", "\xd3",
			"\x8c", "\x8f", "\xaf",
		);
	}
	$clear = array(
		"\x61", "\x63", "\x65",
		"\x6c", "\x6e", "\x6f",
		"\x73", "\x7a", "\x7a",
		"\x41", "\x43", "\x45",
		"\x4c", "\x4e", "\x4f",
		"\x53", "\x5a", "\x5a",
	);
	if(is_array($text)) {
		foreach($text as $key => $value) {
			$array[str_replace($from, $clear, $key)]= str_replace($from, $clear, $value);
		}
		return $array;
	}else {
		return str_replace($from, $clear, $text);
	}

    }


  public  function send_email($order_id, $with_order_info=true ,$with_list=true, $add_msq=false, $to_admin=false, $body='')
  {
    //Mail creation

    


    $mail_config = ConfigPeer::getConfig('mailer');
    $order = OrderShippingPeer::retrieveByPK($order_id);

    if(isset($mail_config['mailer_email']) && isset($mail_config['mailer_host']) && isset($mail_config['mailer_email']) && isset($mail_config['mailer_port']))
    {
        //Create the Transport the call setUsername() and setPassword()
        $transport = Swift_SmtpTransport::newInstance($mail_config['mailer_host'],$mail_config['mailer_port'] )
            ->setUsername($mail_config['mailer_username'])
            ->setPassword($mail_config['mailer_password']);

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);



        $order_sender = $order->getOrderShippingSenders();
        //print_r($order_sender);
    $message = Swift_Message::newInstance($mail_config['mailer_subject'])
        ->setFrom(array($mail_config['mailer_email'] => $mail_config['mailer_name']))
        ->setTo(array($order_sender[0]->getEmail() => $order_sender[0]->getEmail()))

        ->setContentType('text/html')
       ;
       if($with_order_info)
       {
           if($add_msq)
                $message->setBody($add_msq.$body);
           else
               $message->setBody($body);

       }
       else if($add_msq)
                $message->setBody($add_msq);


       if($order->getCourier() == 'DHL' && $order->getListNumber()!="" && $with_list)
        {
        //$message->attach(Swift_Attachment::fromPath('http://site.tld/logo.png'));
        $message ->attach(Swift_Attachment::fromPath('http://'.$_SERVER['HTTP_HOST'].sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/page/listDHL?order_id='.$order_id)->setFilename('DHL_'.$order->getListNumber().'.pdf'));
        //Send the email

        }
        if($order->getCourier() == 'UPS' && $order->getListNumber()!="" && $with_list)
        {
            $message ->attach(Swift_Attachment::fromPath(sfConfig::get('sf_data_dir').'/UPS/'.$order->getId().'.png')->setFilename('UPS_'.$order->getId().'.png'));

        }
       //

        $mailer->send($message);
    }
  }
  
  private function buildUPSquery()
  {
      $query = 'ActionOriginPair=Next___CreateAShipment
          &Address1=
          &Address2=
          &Address3=
          &City=
          &Company=
          &ContactName=
          &Country=
          &Email=
          &Ext=
          &Fax=
          &Other=
          &Phone=
          &PostalCode=
          &RedirectHref=
          &State=
          &addressBookNickname=
          &app-context=%2Fuis&consigneeAddress.addr2=
          &consigneeAddress.addr3=
          &consigneeAddress.city=ZLAWIES WIELKA
          &consigneeAddress.contactName=PIetrzak Waldemar
          &consigneeAddress.country=PL
          &consigneeAddress.email=
          &consigneeAddress.extension=
          &consigneeAddress.name=Pietrazak Waldemar
          &consigneeAddress.postalCode=87134
          &consigneeAddress.state=
          &consigneeAddress.street=Rozgarty, Kwiatowa 39
          &consigneeAddress.telephone=
          &consigneeOption.addressBookId=
          &consigneeOption.collapsed=false
          &consigneeOption.nickName=
          &consigneeOption.saveOption=%20
          &isSelectedDistro=false
          &loc=pl_PL
          &packageCount=1
          &previousPkgType=02
          &reviewDetails=true
          &samePackageAttribute=true
          &serviceBean.service=065
          &shipFromAddress.addr2=
          &shipFromAddress.addr3=
          &shipFromAddress.city=Przedecz
          &shipFromAddress.contactName=Pawel%20Zawada
          &shipFromAddress.country=PL
          &shipFromAddress.email=konikan.84%40gmail.com
          &shipFromAddress.extension=
          &shipFromAddress.name=Pawel Zawada
          &shipFromAddress.postalCode=62635
          &shipFromAddress.residential=false
          &shipFromAddress.state=
          &shipFromAddress.street=Ornastowskiego 10
          &shipFromAddress.telephone=609510311
          &shipFromOption.addressBookId=00
          &shipTo=
          &shipToCityHist=ZLAWIES%20WIELKA
          &shipToLocale=pl_PL
          &shipToLocale=UIS
          &shipToPolDiv3=
          &shipToPostalHist=87134
          &shipToStateHist=
          &shipmentBean.declaredValue.insuredAmount=
          &shipmentBean.dimWeight=1
          &shipmentBean.packageType=04
          &shipmentBean.pkgHeight=
          &shipmentBean.pkgLength=
          &shipmentBean.pkgWidth=
          &shipmentBean.reference.value%231=
          &shipmentBean.reference.value%232=
          &shipmentBean.weight=1
          &shipperAddress.contactName=Pawel Zawada
          &shipperAddress.country=PL
          &shipperAddress.country=PL
          &shipperAddress.state=
          &shipperCityHist=
          &shipperLocale=pl_PL
          &shipperLocale=UIS
          &shipperOption.addressBookId=00
          &shipperOption.collapsed=true
          &shipperOption.nickName=
          &shipperOption.saveOption=%20
          &shipperPolDiv3=
          &shipperPostalHist=
          &shipperSameAsShipFrom=true
          &shipperStateHist=
          &transportationPayer.accountString=10_W5R494
          &uri=create';
  
      return $query;
  }

  public function shiopViaUPS_step1()
  {

  }

} // OrderShipping
