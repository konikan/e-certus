<?php

/**
 * shipping actions.
 *
 * @package    e-certus
 * @subpackage shipping
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class shippingActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
      $user = $this->getUser()->getAttribute('user',null);
      if(isset($user) && $request->hasParameter('rcpt'))
      {
          $c = new Criteria();
          $c->add(UserRecipientPeer::ID, $request->getParameter('rcpt'));
          $c->add(UserRecipientPeer::USER_ID, $user->getId());
          $rcpt = UserRecipientPeer::doSelectOne($c);
          if(isset($rcpt))
          {
              $this->getUser()->setAttribute('rcpt_to', $rcpt);
          }
      }
     $this->form = new PackageDimensionsForm();
  }

  public function executePackageDimensions(sfWebRequest $request)
  {
      $pages = ConfigPeer::getConfig('page_box1_step0');
        //print_r($pages);
        if( isset($pages['page_box1_step0']))
        {
            $this->text_box1 = $pages['page_box1_step0'];
        }
        $pages = ConfigPeer::getConfig('page_main');
        //print_r($pages);
        if( isset($pages['page_main']))
        {
            $this->main_page = $pages['page_main'];
        }


      $this->form = new PackageDimensionsForm();
      if(!$request->hasParameter('rep'))
      {
      $this->getUser()->setAttribute('calculate_values',null);
       $this->getUser()->setAttribute('package_dimension', null);
       $this->getUser()->setAttribute('order',null);
      }
      else
      {
          $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
          if(isset ($package_dimension))
          {
              $this->form->setDefaults($package_dimension);
          }

      }

    
    if ($request->isMethod('post'))
    {
      $values = $request->getParameter($this->form->getName());
      //tu usalamy dodatkwa walidacje w zależności jaki rodziaj przesyłki został wybrany
      if(isset ($values['r_wysylki']))
      {
         $package_t = PackagingGroupsPeer::retrieveByPK($values['r_wysylki']);
         $this->form->setValidator('wy', new sfValidatorNumber(array('required' => true, 'max'=>$package_t->getMaxHeight()), array('required' => 'Wymagane', 'max'=>'Przekroczono (max. '.$package_t->getMaxHeight().'cm)')));
         $this->form->setValidator('sz', new sfValidatorNumber(array('required' => true, 'max'=>$package_t->getMaxWidth()), array('required' => 'Wymagane', 'max'=>'Przekroczono (max. '.$package_t->getMaxWidth().'cm)')));
         $this->form->setValidator('dl', new sfValidatorNumber(array('required' => true, 'max'=>$package_t->getMaxLength()), array('required' => 'Wymagane', 'max'=>'Przekroczono (max. '.$package_t->getMaxLength().'cm)')));

         $this->form->setValidator('wg', new sfValidatorNumber(array('required' => true, 'max'=>$package_t->getMaxWeight()), array('required' => 'Wymagane', 'max'=>'Przekroczono (max. '.$package_t->getMaxWeight().'kg)')));
      }

      //bindujemy formularz danymi
      $this->form->bind($request->getParameter('package_dimension'));
      //Sprawdzamy czy przechodzi aktualną walicacje
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        $this->getUser()->setAttribute('package_dimension', $values);
        $this->redirect('shipping/calculate');
      }
    }

  }


  public function executeCalculate(sfWebRequest $request)
  {
      $pages = ConfigPeer::getConfig('page_box1_step1');
      $user = $this->getUser()->getAttribute('user',null);
      if(!isset($user))
      {
        //$this->getUser()->setAttribute('sender_values',null);
      }
        //print_r($pages);
        if( isset($pages['page_box1_step1']))
        {
            $this->text_box1 = $pages['page_box1_step1'];
        }
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $this->package_dimension = $package_dimension;
      $this->values = $this->getUser()->getAttribute('calculate_values',null);
     
      
      $this->shipping_types     =   ShippingTypesGroupsPeer::getGoupsAndActiveTypesByPGroup($package_dimension['r_wysylki']);
      $this->shipping_options   = ShippingOptionsPeer::doSelect(new Criteria());
      if(isset($package_dimension) && $package_dimension['typ'] == 1)
      {
          $this->couriers = CourierPeer::getActiveCouriers();
        $this->r_wysylki = PackagingGroupsPeer::retrieveByPK($package_dimension['r_wysylki']);
        $this->form = new CalculateShippingForm();
        $this->form->setDefault('sel', null);
       
        foreach ($this->couriers as $courier)
        {
            $this->package_dimension[$courier->getName().'_weight']=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $courier->getName());
            

        }


        if(isset($this->values) && !is_null($this->values))
        {
           
            $this->form->setDefaults($this->values);

            //$this->values = $calculate_values;
        }
        else
        {
            $defs = $this->form->getDefaults();
            $this->values = $this->calculate_process($defs);
            $this->form->setDefaults($this->values);
        }
         $this->form->setDefault('p_group', $package_dimension['r_wysylki']);
        $this->form->setDefault('sel', null);
         if ($request->isMethod('post'))
         {
             if($request->hasParameter('ajax'))
                {
                    //echo $request->getParameter('ajax');
                    $this->ajax = true;
                }
                else
                {
                    $this->ajax = null;
                }

            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid())
            {
                
                $this->values = $this->form->getValues();
                
                //print_r($values);
                //print_r($package_dimension);
                //echo $values['sel'];
                $this->values = $this->calculate_process($this->values);
                
                
               $this->getUser()->setAttribute('calculate_values',$this->values);
               if(isset($this->values['sel']) && $this->values['sel'] != "")
                    {
                        //$this->ajax = null;
                           $this->redirect('shipping/order');
                    }
                    else
                    {
                        //$this->ajax = true;
                    }
              //$this->redirect('shipping/calculate');
            }
         }
      }
      else if(isset($package_dimension) && $package_dimension['typ'] == 2)
      {
          $this->couriers = CourierPeer::getInternationalCouriers();
        $this->form = new CalculateShippingInternationalForm();
        $this->values = $this->getUser()->getAttribute('calculate_values',null);
        $this->shipping_options   = ZonesServicesPeer::doSelect(new Criteria());
        $this->calculate_international($this->values);
        foreach ($this->couriers as $courier)
        {
            $this->package_dimension[$courier->getName().'_weight']=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $courier->getName());
            

        }
        if(isset($this->values) && !is_null($this->values))
        {
           
            $this->form->setDefaults($this->values);

            //$this->values = $calculate_values;
        }
        else
        {
            $defs = $this->form->getDefaults();
            $this->values = $this->calculate_international($defs);
            $this->form->setDefaults($this->values);
        }
        
        if ($request->isMethod('post'))
         {
             if($request->hasParameter('ajax'))
                {
                    //echo $request->getParameter('ajax');
                    $this->ajax = true;
                }
                else
                {
                    $this->ajax = null;
                }

            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid())
            {
                
                $this->values = $this->form->getValues();
                
                //print_r($values);
                //print_r($package_dimension);
                //echo $values['sel'];
                $this->values = $this->calculate_international($this->values);
                
                
               $this->getUser()->setAttribute('calculate_values',$this->values);
               if(isset($this->values['sel']) && $this->values['sel'] != "")
                    {
                        //$this->ajax = null;
                           $this->redirect('shipping/order');
                    }
                    else
                    {
                        //$this->ajax = true;
                    }
              //$this->redirect('shipping/calculate');
            }
         }
      }
      else
      {
          $this->redirect('shipping/packageDimensions');
      }
      
  }


  /**
   *
   * Akcja do okreslenia nadawcy i odbiorcy przesyłki
   * @param sfWebRequest $request
   */
  public function executeOrder(sfWebRequest$request)
  {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
        //Sprawdzamy czy uzytkownik jest zalogowany
        $user = $this->getUser()->getAttribute('user',null);
        $sender_values = $this->getUser()->getAttribute('sender_values',null);
        //print_r($sender_values);
        $this->sender_values = $sender_values;
        $this->login_form   = new UserLoginForm();
            $this->sender_form  = new SendersBookForm();
        if(!isset($user) && !isset($sender_values))
        {
            
            $this->sender_form->setWidget('is_default', new sfWidgetFormInputHidden());
            $this->sender_form->setWidget('bank_name', new sfWidgetFormInputHidden());
            $this->sender_form->setWidget('bank_account', new sfWidgetFormInputHidden());
            $this->sender_form->setWidget('is_company', new sfWidgetFormInputHidden());
            $this->sender_form->setWidget('company_nip', new sfWidgetFormInputHidden());
            $this->sender_form->setValidator('postcode', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            $this->sender_form->setValidator('city', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            $this->sender_form->setValidator('street', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            $this->sender_form->setValidator('sender_name', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            $this->sender_form->setValidator('email', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            $this->sender_form->setValidator('tel', new sfValidatorString(array('required' => true), array('required' => 'Wymagane')));
            
            if($request->isMethod('post') && $request->hasParameter('quick_sender'))
            {
                $this->sender_form->bind($request->getParameter($this->sender_form->getName()));
                if($this->sender_form->isValid())
                {
                    $this->getUser()->setAttribute('sender_values', $request->getParameter($this->sender_form->getName()));
                    $this->redirect('shipping/order');
                }
                
            }
            else if($request->isMethod('post') && $request->hasParameter('quick_register'))
            {
                $this->getUser()->setAttribute('register_values',$request->getParameter($this->sender_form->getName()));
                //print_r($request->getParameter($this->sender_form->getName()));
                $this->redirect('register/index');
            }
        }
       
        $pages = ConfigPeer::getConfig('page_box1_step2');
        //print_r($pages);
        if( isset($pages['page_box1_step2']))
        {
            $this->text_box1 = $pages['page_box1_step2'];
        }
      
        $calculate_values = $this->getUser()->getAttribute('calculate_values',null);
        $this->calculate_values = $calculate_values;
        //print_r($calculate_values);
        $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      
          if(!isset($calculate_values) && !isset($package_dimension))
          {
              $this->redirect('shipping/calculate');
          }

        $courier = CourierPeer::retrieveByPK($calculate_values['sel']);
      
        $this->form = new NewOrderShippingForm(null,array('url' => $this->getController()->genUrl('user/searchSenderAjax')));
         $sender_form = $this->form->getEmbeddedForm('sender');
         $sender_form->setDefaults($sender_values);
         //$sender_form->bind($sender_values);
         $this->form->embedForm('sender', $sender_form);
        $cash_on_delivery = $this->getUser()->getAttribute($courier->getName().'_cash_on_delivery',null);
        if(!is_null($cash_on_delivery) && $cash_on_delivery != "")
        {
            $this->req_bank = 1;
            $sender_form = $this->form->getEmbeddedForm('sender');
            $sender_form->setWidget('bank_name', new sfWidgetFormInput());
            $sender_form->setValidator('bank_name', new sfValidatorString(array('required' => true), array('required' => 'Podaj nazwę banku')));
            $sender_form->getWidget('bank_name')->setLabel('Nazwa banku');
        
            $sender_form->setWidget('bank_account', new sfWidgetFormInput());
            $sender_form->setValidator('bank_account', new sfValidatorString(array('required' => true), array('required' => 'Podaj numer rachunku')));
            $sender_form->getWidget('bank_account')->setLabel('Numer rachunku');
            
            $this->form->embedForm('sender', $sender_form);
         
      }
      
      $this->form->getWidgetSchema()->setLabel('accept_courier_rules','Akceptuję <a href="'.url_for('page/rules?name='.$courier->getName()).'"> regulamin '.$courier->getName().'</a>');
      //$this->form->setDefault('sender',array('sender_name'=>'test'));
      if(isset ($user))
      {
          $default_sender = $user->getDefaultSender();
          if($default_sender)
          {
              $sender_values = $default_sender->toArray(BasePeer::TYPE_FIELDNAME);
               $sender_values['sender_name'] = $default_sender->getSenderName();
          }
          else
          {
              $sender_values = $user->toArray(BasePeer::TYPE_FIELDNAME);
               if($user->getIsCompany())
            {
                $sender_values['sender_name'] = $user->getName().' '.$user->getSurname();
            }
            else
            {
                $sender_values['sender_name'] = $user->getName().' '.$user->getSurname();
            }

            $sender_values['address'] = ($user->getLocalNr() != "")?$user->getStreet()." ".$user->getStreetNr()."/".$user->getLocalNr():$user->getStreet()." ".$user->getStreetNr();
          }
          unset($sender_values['id']);
         $rcpt_to = $this->getUser()->getAttribute('rcpt_to',null);
         if(isset($rcpt_to))
         {
             $rcpt_values = $rcpt_to->toArray(BasePeer::TYPE_FIELDNAME);
             unset($rcpt_values['id']);
            $this->form->setDefault('recipient',$rcpt_values);
         }
          //print_r($sender_values);
          $this->form->setDefault('sender',$sender_values);

          
      }
      $this->order_values = $this->getUser()->getAttribute('order',null);
      if(isset($this->order_values) && !is_null($this->order_values))
      {
          $this->form->setDefaults($this->order_values);
      }
      if ($request->isMethod('post'))
      {
        $req_values = $request->getParameter($this->form->getName());
            if(isset($req_values['sender']['is_company']) && $req_values['sender']['is_company'] == 'on')
            {
                 $sender_form = $this->form->getEmbeddedForm('sender');

                 $sender_form->setValidator('company_nip', new sfValidatorString(array('required' => true), array('required' => 'Podaj NIP firmy')));
                 //$sender_form->
                 $this->form->embedForm('sender', $sender_form);
            }
            if(isset($req_values['accept_courier_rules']))
            {
                //echo "dupa";
            }
        $this->form->bind($request->getParameter($this->form->getName()));
        if ($this->form->isValid())
        {
          $values = $this->form->getValues();
          $this->getUser()->setAttribute('order', $values);

          $this->redirect('shipping/orderSummary');
        }
        else
        {
            if(isset($req_values['accept_courier_rules']) && $req_values['accept_courier_rules'] =='on' )
            {
                $req_values['accept_courier_rules'] = null;
                
            }
        }
    }
  }

  public function executeOrderSummary(sfWebRequest $request)
  {
      $user = $this->getUser()->getAttribute('user', null);
      if($user)
        $this->user = UsersPeer::retrieveByPK($user->getId());
      $pages = ConfigPeer::getConfig('page_box1_step3');
        //print_r($pages);
        if( isset($pages['page_box1_step3']))
        {
            $this->text_box1 = $pages['page_box1_step3'];
        }
        $calculate_values = $this->getUser()->getAttribute('calculate_values',null);
      $this->order_values = $this->getUser()->getAttribute('order',NULL);
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      //print_r($this->order_values);
      $this->courier = CourierPeer::retrieveByPK($calculate_values['sel']);
      if($package_dimension['typ'] == 1)
        $this->shipping_options   = ShippingOptionsPeer::doSelect(new Criteria());
      else
          $this->shipping_options = ZonesServicesPeer::getServicesByCourier($calculate_values['sel'], $calculate_values[$this->courier->getName().'_zone_id']);
      
      //print_r($calculate_values);
      $this->package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $this->calculate_values = $calculate_values;
      if(isset($calculate_values['sel']) && $calculate_values['sel'] != "")
      {
          $this->courier = CourierPeer::retrieveByPK($calculate_values['sel']);
          $weight=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $this->courier->getName());
          if($package_dimension['typ'] == 1)
            $this->type = $this->getPriceForWeight($weight,$calculate_values[$this->courier->getName().'_type'],$package_dimension['r_wysylki']);
          else if($package_dimension['typ'] == 2)
          {
              $this->zones_prices = ZonesPricesPeer::getPriceByWeight($calculate_values['sel'], $weight, $package_dimension['kraj']);
          }
          $this->options = array();
          foreach ($this->shipping_options as $so)
          {
            
                
                if(isset($calculate_values[$this->courier->getName().'_option_'.$so->getId()]) && $calculate_values[$this->courier->getName().'_option_'.$so->getId()] == 'on' )
                {
                    //echo 'ok';
                    $this->options[] = $so;

                    if($so->getAdditionalAmount())
                    {
                        $this->options[$so->getId().'_amount'] = $calculate_values[$this->courier->getName().'_option_'.$so->getId().'_amount'];

                    }
                    
                }
                else continue;
            
        }
        
       // print_r($this->options);

        if($request->isMethod('post') && $request->hasParameter('send'))
        {
            if($request->hasParameter('summary'))
            {
                $this->order_values['summary'] = $request->getParameter('summary');
               

            }
            if($package_dimension['typ'] == 1)
            {
                $order = $this->prepare_order($calculate_values['sel'],$this->type->getId(), $this->order_values, $this->options, $weight);
            }
            else if( $package_dimension['typ'] == 2)
            {
                 $order = $this->prepare_order($calculate_values['sel'],null, $this->order_values, $this->options, $weight);
            }
                if(is_object($order))
           {
               //Przydział numeru listu przewozowego dla DHL
               if($order->getCourier() == 'DHL'  && $order->getIsPaid() == 1 && $order->getStatus() == 0 )
               {
                   $list_num = DhlNumbersPeer::getFreeNumber();
                   if($list_num)
                   {
                       $numer = $list_num->getListNumber();
                       $suma_kontrolna = $order->getCourier()->prepare_DHL_LN($numer);
                       $numer_listu = (string)$numer.(string)$suma_kontrolna;
                       $order->setListNumber($numer_listu);
                       $order->save();
                       $list_num->setFree(0);
                       $list_num->setUsed(1);
                       $list_num->setOrderId($order->getId());
                       $list_num->setTimeOfUse(time());
                       $list_num->save();


                   }
               }
               //$order->send_email($order->getId(), true, false, '', false, $this->getPartial('orderMailBody', array('order'=>$order)));
               //$this->send_email($order->getId());
               
           }
           if($order->getPaidType() == '1')
           {
               $this->redirect('payment/index?order='.$order->getId());
           }
           if($order->getPaidType() == '2')
           {
               $this->redirect('payment/prepaid?order='.$order->getId());
           }
           else
           {
               $this->redirect('shipping/orderSuccess');
           }

        }
      }
      //print_r($calculate_values);
  }


  public function executeOrderSuccess(sfWebRequest $request)
  {
      $pages = ConfigPeer::getConfig('page_order_success');
        //print_r($pages);
        if( isset($pages['page_order_success']))
        {
            $this->text_succes = $pages['page_order_success'];
        }
      $this->getUser()->setAttribute('calculate_values',null);
      $this->getUser()->setAttribute('package_dimension',null);
      $this->getUser()->setAttribute('order',NULL);
  }

  /**
   *
   * @param type $courier_id
   * @param type $shipping_type_id
   * @param type $order_values
   * @param type $order_options
   * @param type $weight
   * @return OrderShipping 
   * funkcja zapisuje zamowienie w bazie danych
   * W przypadku przesylki miedzynarodowej jako wa
   */
  private function prepare_order($courier_id, $shipping_type_id=null, $order_values=null, $order_options=null, $weight=null)
  {
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $courier = CourierPeer::retrieveByPK($courier_id);
      $calculate_values = $this->getUser()->getAttribute('calculate_values',null);
      $total = $calculate_values[$courier->getName().'_price'];
      $vat = $total*$calculate_values['vat'];
      $total_vat =  $calculate_values[$courier->getName().'_price_vat'];
      if($shipping_type_id != null)
      {
        $type = ShippingTypesPeer::retrieveByPK($shipping_type_id);
      }
      $user = $this->getUser()->getAttribute('user', null);
      //Wymiary przesyłki
      

      $order = new OrderShipping();
      $order->setStatus(0);
      $order->setCourierId($courier_id);
      if(isset($user))
        $order->setUserId($user->getId());
        $order->setTypeId($shipping_type_id);
        if($shipping_type_id != null)
        {
        $order->setPackagingTypeId($type->getPackagingTypeId());
        }
      //Okreslamy szerokość przesylki
        $order->setWidth($package_dimension['sz']);
      //Okreslamy wysokość przesyłki
        $order->setHeight($package_dimension['wy']);
      //Określamy długość przeszyłki
        $order->setLength($package_dimension['dl']);
      //Wpisujemy dekralowana wage
        $order->setNormalWeight($package_dimension['wg']);
      //Okreslamy Wagę kalkulowaną
        $order->setWeight($weight);
        if(isset($order_values['order_courier']) && $order_values['order_courier']=='on')
        {
            $order->setReceiptTimeStart($order_values['summary']['time_start']);
            $order->setReceiptTimeEnd($order_values['summary']['time_end']);
            $order->setDateOfReceipt($order_values['summary']['p_date']);
        }
        else if(isset($order_values['summary']['self_giving_date']))
        {
            $order->setSelfGiving(1);
            $order->setSelfGivingDate($order_values['summary']['self_giving_date']);

        }
        if(isset($order_values['summary']['payment_type']))
        {

            $order->setPaidType($order_values['summary']['payment_type']);

        }
        $order->setNumberOfPackages($package_dimension['ilosc_paczek']);
        
        //Przesylka miedzynarodowa
        if($package_dimension['typ'] == 2)
        {
            $zone = ZonesPeer::retrieveByPK($calculate_values[$courier->getName().'_zone_id']);
            $order->setIsInternational(true);
            $order->setCountryId($package_dimension['kraj']);
            $order->setZoneId($zone->getId());
        }
      //Okreslamy kwote zamowienia
        $order->setAmount($total);
        //TODO: dodac ossluge vatu
        $order->setVat(0.23);
        $order->setVatAmount($vat);
        $order->setTotalAmount($total_vat);
        $order->save();

        //Jezeli uzytkownik wybral UPS - koperte oraz uwluge standardowa
        //to zamien na express
        //Ups nie obluguje kopert w trybie standard
        //
        if($shipping_type_id != null)
      {
        $type = $order->getShippingTypes();
        $pack = $type->getPackagingTypes();
        if($type->getShippingTypesGroups()->getCode() == 'standard' && $courier->getName() == 'UPS' && $pack->getServiceId() == '04')
        {
            $express = ShippingTypesPeer::getByServiceId('065',$pack->getId(), $courier->getId());
            if($express)
            {
                $order->setTypeId($express->getId());
                $order->save();
            }
        }
      }
        //Okreslany nadawce przesylki
        $values = $order_values['sender'];
        $order_sender = new OrderShippingSender();
        $order_sender->setOrderId($order->getId());
        $order_sender->setSenderName($values['sender_name']);
        $order_sender->setPostcode($values['postcode']);
        $order_sender->setCity($values['city']);
        $order_sender->setContactName($values['contact_name']);
        $order_sender->setStreet($values['street']);
        $order_sender->setStreetNr($values['street_nr']);
         $order_sender->setLocalNr($values['local_nr']);
         $order_sender->setTel($values['tel']);
         $order_sender->setEmail($values['email']);
         //$order_sender->setBankName($values['bank_name']);
         //$order_sender->setBankAccount($values['bank_account']);

        $order_sender->save();

        //Wstawiamy odbiorcę
        $recipient = new OrderShippingRecipient();
        $values = $order_values['recipient'];
        $recipient->setOrderId($order->getId());
        $recipient->setRecipientName($values['recipient_name']);
        $recipient->setPostcode($values['postcode']);
        $recipient->setCity($values['city']);
        $recipient->setContactName($values['contact_name']);
        $recipient->setAddress($values['address']);
        $recipient->setTel($values['tel']);
        $recipient->setEmail($values['email']);
        $recipient->setCountry($calculate_values[$courier->getName()."_country_short"]);
        $recipient->save();

        //jezeli wybrano zapisz nadawcę
        if($order_values['sender_save'] == "on")
        {
            $user_sender = new UserSender();
            $user_sender->setSenderName($order_sender->getSenderName());
            $user_sender->setPostcode($order_sender->getPostcode());
            $user_sender->setCity($order_sender->getCity());
            $user_sender->setContactName($order_sender->getContactName());
            $user_sender->setStreet($order_sender->getStreet());
            $user_sender->setStreetNr($order_sender->getStreetNr());
            $user_sender->setLocalNr($order_sender->getLocalNr());
            $user_sender->setTel($order_sender->getTel());
            $user_sender->setEmail($order_sender->getEmail());
            //$user_sender->setBankAccount($order_sender->getBankAccount());
            //$user_sender->setBankName($order_sender->getBankName());
            $user_sender->setUserId($order->getUserId());
            
            $user_sender->save();
        }

        //Jeżeli wybrano zapisz odbiorcę
        if($order_values['recipient_save'] == "on")
        {
            $user_recipient = new UserRecipient();
            $user_recipient->setRecipientName($recipient->getName());
            $user_recipient->setContactName($recipient->getContactName());
            $user_recipient->setAddress($recipient->getAddress());

        }
        //Dodajemy opcje krajowe
        if($package_dimension['typ'] == 1)
        {
            foreach($order_options as $option)
            {
                if(is_object($option))
                {
                    $s_option = new OrderShippingOptions();
                    $s_option->setOrderId($order->getId());

                    $s_option->setOptionId($option->getId());
                    if(isset ($order_options[$option->getId().'_amount']))
                    {
                        $s_option->setAmount($order_options[$option->getId().'_amount']);
                    }
                    $s_option->setOptionPrice($option->getPrice());

                    $s_option->save();

                }
            }
        }
    
        //Dodajemy opcje zagraniczne
        if($package_dimension['typ'] == 2)
        {
            foreach($order_options as $option)
            {
                if(is_object($option))
                {
                    $s_option = new OrderShippingZonesServices();
                    $s_option->setOrderId($order->getId());

                    $s_option->setServiceId($option->getId());
                    if(isset ($order_options[$option->getId().'_amount']))
                    {
                        $s_option->setAmount($order_options[$option->getId().'_amount']);
                    }
                    $s_option->setOptionPrice($option->getPrice());

                    $s_option->save();

                }
            }
        }
        return $order;

       // echo 'ok';

  }

    /**
   *
   * @param <type> $wy
   * @param <type> $dl
   * @param <type> $sz
   * @param <type> $wg
   * @param <type> $courier
   * @return <type>
   *
   * Funkcja oblicza wagę przestrzenną dla danej firmy kurierskiej
   * zwraca wiekszą wartośc spośród wagi deklarowanej oraz wagi przestrzennej.
   */

  private function calculate_weight($wy=0,$dl=0,$sz=0,$wg=0,$courier="")
  {
      $res = 0.00;

      if(strtolower($courier) == 'ups')
      {
         $p_weight = ($wy*$dl*$sz)/5000;
         $p_weight = round($p_weight, 2);
         if($p_weight > $wg)
         {
             $res = $p_weight;
         }
         else
         {
             $res = $wg;
         }
      }
      else if(strtolower($courier) == 'dhl')
      {
         $p_weight = ($wy*$dl*$sz)/4000;
         $p_weight = round($p_weight, 2);
         if($p_weight > $wg)
         {
             $res = $p_weight;
         }
         else
         {
             $res = $wg;
         }
      }
      else
      {
          $res = $wg;

      }
      return number_format($res, 2, '.', ' ');
  }



  private function getPriceForWeight($weight, $group_id, $pack_group_id)
  {
      $weight = number_format($weight, 2, '.', ' ');
      $c = new Criteria();
      $c->add(ShippingTypesPeer::GROUP_ID,  $group_id);
      $c->add(ShippingTypesPeer::INITIAL_WEIGHT, $weight, Criteria::LESS_EQUAL);
      $c->add(ShippingTypesPeer::FINAL_WEIGHT, $weight, Criteria::GREATER_EQUAL);
      $c->addJoin(ShippingTypesPeer::PACKAGING_TYPE_ID, PackagingTypesPeer::ID);
      $c->add(PackagingTypesPeer::GROUP_ID, $pack_group_id);

      return ShippingTypesPeer::doSelectOne($c);
  }


  /*
   * Metoda oblicza cene przesyłki dla wszystkich aktywnych firm kurierskich
   */
  private function calculate_process($values = array())
  {
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $user = $this->getUser()->getAttribute('user');
      $config = ConfigPeer::getConfig('page_vat_tax');
      $vat = 0.23;
      if(isset($config['page_vat_tax']) && $config['page_vat_tax'] != "")
      {
          $vat = $config['page_vat_tax'];
      }
      $couriers = CourierPeer::getActiveCouriers();
      $shipping_types     =     ShippingTypesGroupsPeer::getGoupsAndActiveTypesByPGroup($package_dimension['r_wysylki']);
      $shipping_options   =     ShippingOptionsPeer::doSelect(new Criteria());
      foreach ($couriers as $courier)
      {
          $this->getUser()->setAttribute($courier->getName()."_cash_on_delivery", null);
        $total = 0.0;
        //echo $courier->getName()."</br>";
        $weight=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $courier->getName());
        // echo $weight;
        foreach ($values as $key=>$value)
        {
            if($key == $courier->getName().'_type')
            {
                $type = $this->getPriceForWeight($weight, $value, $package_dimension['r_wysylki']);
                if(isset($type))
                {
                    $price = $type->getPrice();
                    if(isset($user))
                    {
                        $discount = DiscountsPeer::retrieveByPK($user->getId(), $type->getId());
                        if($discount)
                        {
                            //Rabat procentowy
                            if($discount->getDiscountType() == "1" && $discount->getDiscount() !="")
                            {
                                $discount_ammount = $price * $discount->getDiscount();
                                $price = $price - $discount_ammount;
                            }
                            else if($discount->getDiscountType() == "2" && $discount->getDiscountAmount() !="")
                            {
                                $price = $discount->getDiscountAmount();
                            }
                        }
                    }
                    if($courier->getPetrolCharge())
                    {
                        $price += ($price*$courier->getPetrolCharge());
                    }
                    $total += $price;

                }
                else
                {
                    //continue;
                }
            }

            //if(!isset($values[$courier->getName().'_price'])) continue;
            
            foreach ($shipping_options as $so)
            {
                if($so->getCourierId() == $courier->getId())
                {
                    if($key == $courier->getName().'_option_'.$so->getId() && $this->values[$key] == 'on' )
                    {
                        if($so->getAdditionalAmount())
                        {

                            $amount = $this->values[$key.'_amount'];
                           // echo $amount;
                            if($so->getCode() == 'ins')
                            {

                                $ins_price = $this->get_insurance_rate($amount, $courier->getId());
                                if($ins_price)
                                {
                                    //echo "dupa";
                                    //echo $ins_price->getPrice();
                                    $total += $ins_price->getPrice();
                                }
                                else
                                {
                                    $total += $amount;
                                }

                            }
                            if($so->getCode() == 'cash_on_delivery')
                            {
                                $this->getUser()->setAttribute($courier->getName()."_cash_on_delivery", $amount);
                            }
                             
                            if($so->getCommission() != "")
                            {
                                $commision = $amount*$so->getCommission();
                                //echo $commision;
                                $total += $commision;
                            }

                        }
                        $total += $so->getPrice();
                                    //echo "dupa";
                    }
                    //else continue;
                }
                //else
                    //continue;
            }


        }

        $total = $total*$package_dimension['ilosc_paczek'];

        $values[$courier->getName().'_price'] = $total;
        $values[$courier->getName().'_price_vat'] = round(($total * $vat)+$total,2);
        $values['vat'] = $vat;
        $courier->get_start_time_receipt();

      }

      return $values;
  }

  /**
   * Oblicza cene przesylki miedzynarodowej
   * @param type $values 
   * 
   */
  private function calculate_international($values = array())
  {
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $user = $this->getUser()->getAttribute('user');
      $vat = 0.23;
      if(isset($config['page_vat_tax']) && $config['page_vat_tax'] != "")
      {
          $vat = $config['page_vat_tax'];
      }
      $couriers = CourierPeer::getInternationalCouriers();
      foreach ($couriers as $courier)
      {
          $values['international'] = true;
            $this->getUser()->setAttribute($courier->getName()."_cash_on_delivery", null);
            $total = 0.0;
            //echo $courier->getName()."</br>";
            $weight=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $courier->getName());
            // echo $weight;
            //echo $package_dimension['kraj'];
            $zone_price = ZonesPricesPeer::getPriceByWeight($courier->getId(), $weight, $package_dimension['kraj']);
            //echo $weight;
            if(is_object($zone_price))
            {    
                echo $zone_price->getPrice();
                $total = $zone_price->getPrice();
                if($courier->getPetrolCharge())
                    {
                        $total += ($total*$courier->getPetrolCharge());
                    }
                    //$total += $price;
                $values[$courier->getName().'_is'] = true;
                $values[$courier->getName().'_zone_id'] = $zone_price->getZoneId();
                $country = CountriesPeer::retrieveByPK($package_dimension['kraj']);
                $values[$courier->getName().'_country_name'] = $country->getName();
                $values[$courier->getName().'_country_short'] = $country->getShort();
                
                $shipping_options = ZonesServicesPeer::getServicesByCourier($courier->getId(), $zone_price->getZoneId());
                foreach ($values as $key=>$value)
        {
                foreach ($shipping_options as $so)
            {
                if($so->getZones()->getCourierId() == $courier->getId())
                {
                    if($key == $courier->getName().'_option_'.$so->getId() && $this->values[$key] == 'on' )
                    {
                        if($so->getAdditionalAmount())
                        {

                            $amount = $this->values[$key.'_amount'];
                           // echo $amount;
                            if($so->getCode() == 'ins')
                            {

                                $ins_price = $this->get_insurance_rate($amount, $courier->getId());
                                if($ins_price)
                                {
                                    //echo "dupa";
                                    //echo $ins_price->getPrice();
                                    $total += $ins_price->getPrice();
                                }
                                else
                                {
                                    $total += $amount;
                                }

                            }
                            if($so->getCode() == 'cash_on_delivery')
                            {
                                $this->getUser()->setAttribute($courier->getName()."_cash_on_delivery", $amount);
                            }
                             
                            if($so->getCommission() != "")
                            {
                                $commision = $amount*$so->getCommission();
                                //echo $commision;
                                $total += $commision;
                            }

                        }
                        $total += $so->getPrice();
                                    //echo "dupa";
                    }
                    //else continue;
                }
                //else
                    //continue;
            }
        }
            }
             $total = $total*$package_dimension['ilosc_paczek'];
             $values[$courier->getName().'_price'] = $total;
            $values[$courier->getName().'_price_vat'] = round(($total * $vat)+$total,2);
            $values['vat'] = $vat;
     }
     return $values;
    
  }

  private function send_email($order_id)
  {
    //Mail creation

    $mail_config = ConfigPeer::getConfig('mailer');
    $order = OrderShippingPeer::retrieveByPK($order_id);

    if(isset($mail_config['mailer_email']) && isset($mail_config['mailer_host']) && isset($mail_config['mailer_email']) && isset($mail_config['mailer_port']) && isset($mail_config['mailer_username']))
    {
        //Create the Transport the call setUsername() and setPassword()
        $transport = Swift_SmtpTransport::newInstance($mail_config['mailer_host'], $mail_config['mailer_port'])
            ->setUsername($mail_config['mailer_username'])
            ->setPassword($mail_config['mailer_password']);

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        //Tworzenie wiadomości

        $order_sender = $order->getOrderShippingSenders();
        
        $message = Swift_Message::newInstance($mail_config['mailer_subject'])
        ->setFrom(array($mail_config['mailer_email'] => $mail_config['mailer_name']))
        ->setTo(array($order_sender[0]->getEmail() => $order_sender[0]->getEmail()))
        ->setBody($this->getPartial('orderMailBody', array('order'=>$order)))
        ->setContentType('text/html');
        if($order->getCourier() == 'DHL' && $order->getIsPaid() == 1)
        {

            $message->attach(Swift_Attachment::fromPath(url_for('page/listDHL?order_id='.$order_id,true))->setFilename('DHL_'.$order->getListNumber().'.pdf'));


        }

        $mailer->send($message);
    }
  }


  public function executeDhlSOAP(sfWebRequest $request)
  {

      $order = OrderShippingPeer::retrieveByPK($request->getParameter('order_id'));
      if(isset($order) && $order->getIsPaid() == 1 && $order->getStatus()=='0')
      {
          $sender = $order->getSender();
          $courier = $order->getCourier();
          echo $order->getDateOfReceipt('d-m-Y');
          echo $order->getReceiptTimeStart('H:i');
          echo $order->getReceiptTimeEnd('H:i');
          $pow_31 = 0;
          $pon_31 = 0;
          if($order->getWeight()>31.5)
          {
              $pow_31 = $order->getNumberOfPackages();
          }
          else
          {
              $pon_31 =  $order->getNumberOfPackages();
          }
        $xml =    "
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
  <soap:Body>
    <DodajZlecenieWS xmlns=\"eCASOrderWS\">
      <zlecenie>
        <Firma>".$sender->getSenderName()."</Firma>
        <Ulica>".$sender->getStreet()."</Ulica>
        <Numer>".$sender->getStreetNr()."</Numer>
        <KodPocztowy>".$sender->getPostcode()."</KodPocztowy>
        <Miasto>".$sender->getCity()."</Miasto>
        <NumerSAP>".$courier->getClientNr()."</NumerSAP>
        <Platnik>ZLECENIODAWCA</Platnik>
        <FormaPlatnosci>P</FormaPlatnosci>
        <DataPrzyjazduKuriera>".$order->getDateOfReceipt('d-m-Y')."</DataPrzyjazduKuriera>
        <PrzesylkaGotowaOd>".$order->getReceiptTimeStart('H:i')."</PrzesylkaGotowaOd>
        <ObiorMozliwyDo>".$order->getReceiptTimeEnd('H:i')."</ObiorMozliwyDo>
        <IloscPrzesylekDo31>".$pon_31."</IloscPrzesylekDo31>
        <IloscPrzesylekPow31>".$pow_31."</IloscPrzesylekPow31>
        <WagaNajciezszej>".number_format($order->getWeight(),0,',','')."</WagaNajciezszej>
        <ImieNazwisko>".$sender->getContactName()."</ImieNazwisko>
        <Email>".$sender->getEmail()."</Email>
        <TelefonStacjonarny></TelefonStacjonarny>
        <TelefonKomorkowy>".$sender->getTel()."</TelefonKomorkowy>
        <DodatkoweInstrukcje></DodatkoweInstrukcje>
        <MiejsceNadania></MiejsceNadania>
      </zlecenie>
    </DodajZlecenieWS>
  </soap:Body>
</soap:Envelope>
";
$headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "SOAPAction: \"eCASOrderWS/DodajZlecenieWS\"",
        "Content-length: ".strlen($xml),
    );
      $soap_do = curl_init();
    curl_setopt($soap_do, CURLOPT_URL,            "http://webapps.dhl.com.pl/app/ecas/eCASOrderWS.asmx?op=DodajZlecenieWS" );
    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($soap_do, CURLOPT_POST,           true );
    curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $xml);
    curl_setopt($soap_do, CURLOPT_HTTPHEADER, $headers);
   // curl_setopt($soap_do, CURLOPT_HTTPHEADER,     array('Content-Type: text/xml; charset=utf-8', 'Content-Length: '.strlen('<soap:Envelope>...</soap:Envelope>') ));
    $result = curl_exec($soap_do);
    if($result === false)
    {
        $err = 'Curl error: ' . curl_error($soap_do);
        curl_close($soap_do);

        
        return $err;
    }
    else
    {
        $blad = null;
        $nr_zlecenia = null;
        echo $result;
        if(preg_match("!<tresc_bledu>(.+)</tresc_bledu>!i",$result,$matches))
        {
            $blad =  $matches[1];
            //echo $blad;
        }
        if(preg_match("!<numer_zlecenia>(.+)</numer_zlecenia>!i",$result,$matches))
        {
            $nr_zlecenia =  $matches[1];
        }

        if(!is_null($nr_zlecenia) && $nr_zlecenia != "")
        {
            $order->setOutherOrderNumber($nr_zlecenia);
            $order->setStatus(1);
            $order->save();
        }
        //$out = preg_replace('|&lt;([/\w]+)(:)|m','&lt;$1',$result);
	//$out = preg_replace('|(\w+)(:)(\w+=\&quot;)|m','$1$3',$out);
        //$xml = simplexml_load_string("$result");
        
        //$result_x = $xml->xpath("tresc_bledu");

        //print_r($result_x);
        curl_close($soap_do);


        
        

        return  sfView::NONE;
    }
     return  sfView::NONE;
   }
   
    
  }

  public function executeTestDhlSOAP(sfWebRequest $request)
  {
    $this->setLayout(false);
      $order = OrderShippingPeer::retrieveByPK($request->getParameter('order_id'));
      if(isset($order))
      {
          $sender = $order->getSender();
          $courier = $order->getCourier();
          //echo $order->getDateOfReceipt('d-m-Y');
          //echo $order->getReceiptTimeStart('H:i');
          //echo $order->getReceiptTimeEnd('H:i');
          $pow_31 = 0;
          $pon_31 = 0;
          if($order->getWeight()>31.5)
          {
              $pow_31 = $order->getNumberOfPackages();
          }
          else
          {
              $pon_31 =  $order->getNumberOfPackages();
          }
        $xml =    "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
  <soap:Body>
    <DodajZlecenieWS xmlns=\"eCASOrderWS\">
      <zlecenie>
        <Firma>".$sender->getSenderName()."</Firma>
        <Ulica>".$sender->getStreet()."</Ulica>
        <Numer>".$sender->getStreetNr()."</Numer>
        <KodPocztowy>".$sender->getPostcode()."</KodPocztowy>
        <Miasto>".$sender->getCity()."</Miasto>
        <NumerSAP>".$courier->getClientNr()."</NumerSAP>
        <Platnik>ZLECENIODAWCA</Platnik>
        <FormaPlatnosci>P</FormaPlatnosci>
        <DataPrzyjazduKuriera>".$order->getDateOfReceipt('d-m-Y')."</DataPrzyjazduKuriera>
        <PrzesylkaGotowaOd>".$order->getReceiptTimeStart('H:i')."</PrzesylkaGotowaOd>
        <ObiorMozliwyDo>".$order->getReceiptTimeEnd('H:i')."</ObiorMozliwyDo>
        <IloscPrzesylekDo31>".$pon_31."</IloscPrzesylekDo31>
        <IloscPrzesylekPow31>".$pow_31."</IloscPrzesylekPow31>
        <WagaNajciezszej>".number_format($order->getWeight(),2,',','')."</WagaNajciezszej>
        <ImieNazwisko>".$sender->getContactName()."</ImieNazwisko>
        <Email>".$sender->getEmail()."</Email>
        <TelefonStacjonarny></TelefonStacjonarny>
        <TelefonKomorkowy>".$sender->getTel()."</TelefonKomorkowy>
        <DodatkoweInstrukcje></DodatkoweInstrukcje>
        <MiejsceNadania></MiejsceNadania>
      </zlecenie>
    </DodajZlecenieWS>
  </soap:Body>
</soap:Envelope>
";
$headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "SOAPAction: \"eCASOrderWS/DodajZlecenieWS\"",
        "Content-length: ".strlen($xml),
    );

header("Content-Type:text/xml");
echo$xml;



        //return  sfView::NONE;

      }


  }

  private function DhlSOAP($order_id)
  {
   
      $order = OrderShippingPeer::retrieveByPK($order_id);
      $xml =    '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <DodajZlecenieWS xmlns="eCASOrderWS">
      <zlecenie>
        <Firma>string</Firma>
        <Ulica>string</Ulica>
        <Numer>string</Numer>
        <KodPocztowy>string</KodPocztowy>
        <Miasto>string</Miasto>
        <NumerSAP>string</NumerSAP>
        <Platnik>string</Platnik>
        <FormaPlatnosci>string</FormaPlatnosci>
        <DataPrzyjazduKuriera>string</DataPrzyjazduKuriera>
        <PrzesylkaGotowaOd>string</PrzesylkaGotowaOd>
        <ObiorMozliwyDo>string</ObiorMozliwyDo>
        <IloscPrzesylekDo31>int</IloscPrzesylekDo31>
        <IloscPrzesylekPow31>int</IloscPrzesylekPow31>
        <WagaNajciezszej>string</WagaNajciezszej>
        <ImieNazwisko>string</ImieNazwisko>
        <Email>string</Email>
        <TelefonStacjonarny>string</TelefonStacjonarny>
        <TelefonKomorkowy>string</TelefonKomorkowy>
        <DodatkoweInstrukcje>string</DodatkoweInstrukcje>
        <MiejsceNadania>string</MiejsceNadania>
      </zlecenie>
    </DodajZlecenieWS>
  </soap:Body>
</soap:Envelope>';

    /*
            $options = array(
                'soap_version'=>SOAP_1_2,
                'exceptions'=>true,
                'trace'=>1,
                'cache_wsdl'=>WSDL_CACHE_NONE
            );
     * 
     */

#
#
    $client = new SoapClient('http://webapps.dhl.com.pl/app/ecas/eCASOrderWS.asmx?WSDL');

#

#
        //var_dump($client);
  $client->__soapCall('DodajZlecenieWS', array(new SoapParam('Zawada', 'Firma')));
  print "<pre>\n";
  print "Request :\n".htmlspecialchars($client->__getLastRequest()) ."\n";
  print "Response:\n".htmlspecialchars($client->__getLastResponse())."\n";
  print "</pre>";

   

//$results = $client->Get(array('request'=>array('CustomerId'=>'842115')));

        
    }


    private function get_insurance_rate($amount, $courier_id)
    {
        $c = new Criteria();
        $c->add(InsuranceRatesPeer::AMOUNT_END,$amount,Criteria::GREATER_EQUAL);
        $c->add(InsuranceRatesPeer::AMOUNT_START,$amount,Criteria::LESS_EQUAL);
        $c->add(InsuranceRatesPeer::COURIER_ID,$courier_id);

        return InsuranceRatesPeer::doSelectOne($c);
    }



    /**
     *
     * @return string
     *
     * UWAGA!!!
     * TESTOWA AKCJA LOGOWANIA DO ups.com
     */
    private function login_to_UPS()
    {
         //Logowanie do ups

        #
            $cookie_file = sfConfig::get('sf_lib_dir').'/vendor/cookie.txt';
            #

            #
            $c = curl_init('https://wwwapps.ups.com/cclamp/login');
            #
            curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
            #
            curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);

            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            #
            curl_setopt($c, CURLOPT_URL, 'https://wwwapps.ups.com/cclamp/login');
            #
            curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
            #
            curl_setopt($c, CURLOPT_POST, 1);
            #
            curl_setopt($c, CURLOPT_POSTFIELDS,
            #
            'userid=konikan&password=princess&autoPopID=on&sret=http://www.ups.com/content/pl/pl/index.jsx?WT.svl=BrndMrk&uret=http://www.ups.com/content/pl/pl/index.jsx?WT.svl=BrndMrk&ctxcc=pl_PL');
            #
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            #
            //print_r(curl_getinfo($c));
            #
            $s = curl_exec($c);
            #
            curl_close($c);

            return $cookie_file;
    }

    /**
     *
     * @param sfWebRequest $request
     *
     * Testowa akcja integracji z UPS
     *
     * UWAGA!!!
     * AKCJA W TRAKCIE REALIZACJI
     */

    public function  executeToUPS(sfWebRequest $request)
    {

        $this->setLayout(false);
            $cookie_file = $this->login_to_UPS();
            #
            //print_r($s);
            #
            $time = time();

        


            
        $crop_fields ='
                ?Address1=
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
                Next_CreateAShipment
                ShipNow___ReviewShipment
        ';


            

            $post_data = 'ActionOriginPair=ShipNow___ReviewShipment
&TC_TIME_STAMP=1290887136672
&loc=pl_PL
&RedirectHref=
&app-context=/uis
&selectedAccessory=
&consignee.contactName=Pawel Zawada
&consignee.name=Pawel Piotr Zawada
&consignee.street=Ornastowskiego 10
&consignee.addr2=Pawel Zawada
&consignee.addr3=
&consignee.postalCode=62635
&consignee.city=Przedecz
&consignee.state=
&consignee.country=PL
&consignee.telephone=609510311
&consignee.extension=
&consignee.email=konikan.84@gmail.com
&consignee.residential=false
&shipFrom.contactName=Pawel Zawada
&shipFrom.name=Pawel Piotrt Zawada
&shipFrom.street=Ornastowskiego 10
&shipFrom.addr2=
&shipFrom.addr3=
&shipFrom.postalCode=62635
&shipFrom.city=Przedecz
&shipFrom.state=
&shipFrom.country=PL
&shipFrom.telephone=609510311
&shipFrom.extension=
&shipFrom.email=konikan.84@gmail.com
&shipFrom.residential=false
&shipper.contactName=Pawel Zawada
&shipper.name=Pawel Piotr Zawada
&shipper.street=Ornastowskiego 10
&shipper.addr2=
&shipper.addr3=
&shipper.postalCode=62635
&shipper.city=Przedecz
&shipper.state=
&shipper.country=PL
&shipper.telephone=609510311
&shipper.extension=
&shipper.email=konikan.84@gmail.com
&shipper.residential=false';

            /*
             $post_data_array = array(
                'Address1'=>'',
                'Address2'=>'',
                'Address3'=>'',
                'City'=>'',
                'Company'=>'',
                'ContactName'=>'',
                'Country'=>'',
                'Email'=>'',
                'Ext'=>'',
                'Fax'=>'',
                'Other'=>'',
                'Phone'=>'',
                'PostalCode'=>'',
                'RedirectHref'=>'',
                'State'=>'',
                'addressBookNickname'=>''
                'TC_TIME_STAMP'=>time(),
                'associatedAccount.accountString'=>'10_W5R494
                &associatedAccount.thirdPartyAccount.country=LV
                &businessPurpose=true
                &consigneeAddress.addr2=
                &consigneeAddress.addr3=
                &consigneeAddress.city=torun
                &consigneeAddress.contactName=Mariuurawski
                &consigneeAddress.country=PL
                &consigneeAddress.email=
                &consigneeAddress.extension=
                &consigneeAddress.name=Tryton
                &consigneeAddress.postalCode=87100
                &consigneeAddress.state=
                &consigneeAddress.street=Szosa13
                &consigneeAddress.telephone=
                &consigneeOption.addressBookId=
                &consigneeOption.collapsed=false
                &consigneeOption.nickName=
                &consigneeOption.saveOption=
                &dutiesPayer.accountString=30_BTR
                &dutiesPayer.receiverAccount.accountNumber=
                &dutiesPayer.receiverAccount.postalCode=
                &dutiesPayer.thirdPartyAccount.country=LV
                &isSelectedDistro=false
                &loc=pl_PL
                &packageCount=1
                &pickupAction=OnCallPickupRequest
                &previousPkgType=02
                &samePackageAttribute=true&serviceBean.service=011
                &shipFromAddress.addr2=
                &shipFromAddress.addr3=
                &shipFromAddress.city=Przedecz
                &shipFromAddress.contactName=Pawel Zawada
                &shipFromAddress.country=PL
                &shipFromAddress.email=konikan.84@gmail.com
                &shipFromAddress.extension=
                &shipFromAddress.name=Pawel Zawada
                &shipFromAddress.postalCode=62635
                &shipFromAddress.residential=false
                &shipFromAddress.state=
                &shipFromAddress.street=Ornastowskiego 10
                &shipFromAddress.telephone=609510311
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
                &shipmentBean.declaredValue.insuredAmount=200
                &shipmentBean.dimWeight=
                &shipmentBean.largePackageCount=0
                &shipmentBean.movementReferenceNumber=
                &shipmentBean.packageType=02
                &shipmentBean.reference.value%231=
                &shipmentBean.reference.value%232=
                &shipmentBean.weight=20.0
                &shipmentServiceOption=SHIP_COLLECT_ON_DELIVERY
                &shipperAddress.contactName=Pawel Zawada
                &shipperAddress.country=PL
                &shipperAddress.country=PL
                &shipperAddress.state=
                &shipperCityHist=
                &shipperLocale=pl_PL
                &shipperLocale=UIS
                &shipperOption.addressBookId=00
                &shipperOption.collapsed=true
                &shipperPolDiv3=
                &shipperPostalHist=
                &shipperSameAsShipFrom=true
                &shipperStateHist=
                &transportationPayer.accountString=10_W5R494
                &transportationPayer.thirdPartyAccount.country=LV
                &ActionOriginPair=Next___CreateAShipment
                &RedirectHref=
                &oncallPickup.earlyTimeAmPm=1
                &oncallPickup.earlyTimeHour=01
                &oncallPickup.earlyTimeMin=00
                &oncallPickup.latestTimeHour=05
                &oncallPickup.latestTimeMin=00
                &oncallPickup.pickupAddress.addr2=
                &oncallPickup.pickupAddress.addr3=
                &oncallPickup.pickupAddress.city=Przedecz
                &oncallPickup.pickupAddress.contactName=Pawel Zawada
                &oncallPickup.pickupAddress.country=PL
                &oncallPickup.pickupAddress.email=konikan.84@gmail.com
                &oncallPickup.pickupAddress.extension=
                &oncallPickup.pickupAddress.name=Pawel Zawada
                &oncallPickup.pickupAddress.postalCode=62635
                &oncallPickup.pickupAddress.state=
                &oncallPickup.pickupAddress.street=Ornastowskiego 10
                &oncallPickup.pickupAddress.telephone=609510311
                &oncallPickup.pickupDate=20101129
                &oncallPickup.pickupLocation=
                &oncallPickup.pickupReferenceNumber=
                &shipmentOption.collectOnDeliveryAmount=200
                &shipmentOption.collectOnDeliveryCurrency=PLN
                &shipmentOption.collectOnDeliveryPaymentMethod=01
                &shipmentOption.proactiveResponse=
                &shipmentOption.refrigeration=false
                &consignee.addr2=
                &consignee.addr3=
                &consignee.city=TORUN
                &consignee.contactName=Mariusz Murawski
                &consignee.country=PL
                &consignee.email=
                &consignee.extension=
                &consignee.name=Tryton
                &consignee.postalCode=87100
                &consignee.residential=false
                &consignee.state=
                &consignee.street=Szosa 13
                &consignee.telephone=
                &selectedAccessory=
                &service=011&shipFrom.addr2=
                &shipFrom.addr3=
                &shipFrom.city=Przedecz
                &shipFrom.contactName=Pawel Zawada
                &shipFrom.country=PL
                &shipFrom.email=konikan.84@gmail.com
                &shipFrom.extension=
                &shipFrom.name=Pawel Zawada
                &shipFrom.postalCode=62635
                &shipFrom.residential=false
                &shipFrom.state=
                &shipFrom.street=Ornastowskiego 10
                &shipFrom.telephone=609510311
                &shipper.addr2=
                &shipper.addr3=
                &shipper.city=Przedecz
                &shipper.contactName=Pawel Zawada
                &shipper.country=PL
                &shipper.email=konikan.84@gmail.com
                &shipper.extension=
                &shipper.name=Pawel%20Zawada
                &shipper.postalCode=62635
                &shipper.residential=false
                &shipper.state=
                &shipper.street=Ornastowskiego 10
                &shipper.telephone=609510311
                ');
             * */

               // $post_array = explode('&', str_replace('\n','',$post_data));
                //echo "<pre>".print_r($post_array)."</pre>";
	//set data to be posted



            $post_data_array = array();
            $post_data = str_replace('\n', '', $post_data);
            $post_data = preg_replace("|[\s]{2,}|", '', $post_data);
            $post_data = urlencode($post_data);


    $curl = curl_init('https://www.ups.com/uis/create?loc=pl_PL');
    curl_setopt($curl, CURLOPT_URL, 'https://www.ups.com/uis/create?loc=pl_PL');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); # SAME cookiefile
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    $xxx = curl_exec($curl);
   
    curl_close ($curl);
    //echo $xxx;
 $post_data = '
                ActionOriginPair=ShipNow___ReviewShipment
                &associatedAccount.accountString=10_W5R494
                &associatedAccount.thirdPartyAccount.country=LV
                &businessPurpose=true
                &consigneeAddress.addr2=
                &consigneeAddress.addr3=
                &consigneeAddress.city=TORUN
                &consigneeAddress.contactName=Mariuurawski
                &consigneeAddress.country=PL
                &consigneeAddress.email=
                &consigneeAddress.extension=
                &consigneeAddress.name=Tryton
                &consigneeAddress.postalCode=87100
                &consigneeAddress.state=
                &consigneeAddress.street=Szosa Lubicka13
                &consigneeAddress.telephone=
                &consigneeOption.addressBookId=
                &consigneeOption.collapsed=false
                &consigneeOption.nickName=
                &consigneeOption.saveOption=
                &dutiesPayer.accountString=30_BTR
                &dutiesPayer.receiverAccount.accountNumber=
                &dutiesPayer.receiverAccount.postalCode=
                &dutiesPayer.thirdPartyAccount.country=LV
                &isSelectedDistro=false
                &loc=pl_PL
                &packageCount=1
                &pickupAction=OnCallPickupRequest
                &previousPkgType=02
                &samePackageAttribute=true
                &serviceBean.service=011
                &shipFromAddress.addr2=
                &shipFromAddress.addr3=
                &shipFromAddress.city=PRZEDECZ
                &shipFromAddress.contactName=Pawel Zawada
                &shipFromAddress.country=PL
                &shipFromAddress.email=konikan.84@gmail.com
                &shipFromAddress.extension=
                &shipFromAddress.name=Pawel Zawada
                &shipFromAddress.postalCode=62635
                &shipFromAddress.residential=false
                &shipFromAddress.state=
                &shipFromAddress.street=Ornastowskiego 10
                &shipFromAddress.telephone=609510311
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
                &shipmentBean.declaredValue.insuredAmount=200
                &shipmentBean.dimWeight=
                &shipmentBean.largePackageCount=0
                &shipmentBean.movementReferenceNumber=
                &shipmentBean.packageType=02
                &shipmentBean.reference.value%231=
                &shipmentBean.reference.value%232=
                &shipmentBean.weight=20.0
                &shipmentServiceOption=SHIP_COLLECT_ON_DELIVERY
                &shipperAddress.contactName=Pawel Zawada
                &shipperAddress.country=PL
                &shipperAddress.country=PL
                &shipperAddress.state=
                &shipperCityHist=
                &shipperLocale=pl_PL
                &shipperLocale=UIS
                &shipperOption.addressBookId=00
                &shipperOption.collapsed=true
                &shipperPolDiv3=
                &shipperPostalHist=
                &shipperSameAsShipFrom=true
                &shipperStateHist=
                &transportationPayer.accountString=10_W5R494
                &transportationPayer.thirdPartyAccount.country=LV
                &RedirectHref=
                &oncallPickup.earlyTimeAmPm=1
                &oncallPickup.earlyTimeHour=01
                &oncallPickup.earlyTimeMin=00
                &oncallPickup.latestTimeHour=05
                &oncallPickup.latestTimeMin=00
                &oncallPickup.pickupAddress.addr2=
                &oncallPickup.pickupAddress.addr3=
                &oncallPickup.pickupAddress.city=Przedecz
                &oncallPickup.pickupAddress.contactName=Pawel Zawada
                &oncallPickup.pickupAddress.country=PL
                &oncallPickup.pickupAddress.email=konikan.84@gmail.com
                &oncallPickup.pickupAddress.extension=
                &oncallPickup.pickupAddress.name=Pawel Zawada
                &oncallPickup.pickupAddress.postalCode=62635
                &oncallPickup.pickupAddress.state=
                &oncallPickup.pickupAddress.street=Ornastowskiego 10
                &oncallPickup.pickupAddress.telephone=609510311
                &oncallPickup.pickupDate=20101129
                &oncallPickup.pickupLocation=
                &oncallPickup.pickupReferenceNumber=
                &shipmentOption.collectOnDeliveryAmount=200
                &shipmentOption.collectOnDeliveryCurrency=PLN
                &shipmentOption.collectOnDeliveryPaymentMethod=01
                &shipmentOption.proactiveResponse=
                &shipmentOption.refrigeration=false
                &consignee.addr2=
                &consignee.addr3=
                &consignee.city=TORUN
                &consignee.contactName=Mariusz Murawski
                &consignee.country=PL
                &consignee.email=
                &consignee.extension=
                &consignee.name=Tryton
                &consignee.postalCode=87100
                &consignee.residential=false
                &consignee.state=
                &consignee.street=Szosa 13
                &consignee.telephone=
                &selectedAccessory=
                &service=011&shipFrom.addr2=
                &shipFrom.addr3=
                &shipFrom.city=PRZEDECZ
                &shipFrom.contactName=Pawel Zawada
                &shipFrom.country=PL
                &shipFrom.email=konikan.84@gmail.com
                &shipFrom.extension=
                &shipFrom.name=Pawel Zawada
                &shipFrom.postalCode=62635
                &shipFrom.residential=false
                &shipFrom.state=
                &shipFrom.street=Ornastowskiego 10
                &shipFrom.telephone=609510311
                &shipper.addr2=
                &shipper.addr3=
                &shipper.city=PRZEDECZ
                &shipper.contactName=Pawel Zawada
                &shipper.country=PL
                &shipper.email=konikan.84@gmail.com
                &shipper.extension=
                &shipper.name=Pawel Zawada
                &shipper.postalCode=62635
                &shipper.residential=false
                &shipper.state=
                &shipper.street=Ornastowskiego 10
                &shipper.telephone=609510311
                ';


            $post_data = str_replace('\n', '', $post_data);
            $post_data = preg_replace("|[\s]{2,}|", '', $post_data);
            $post_data = urlencode($post_data);
            $curl = curl_init('https://www.ups.com/uis/create?loc=pl_PL');
            curl_setopt($curl, CURLOPT_URL, 'https://www.ups.com/uis/create?loc=pl_PL');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12;MEGAUPLOAD 1.0");
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); # SAME cookiefile
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
            $xxx = curl_exec($curl);

            curl_close ($curl);
            echo $xxx;

           
            //return sfView::NONE;
    }


    /**
     * Akcja przygotowuje list przewozowy.
     * w zależności od wybranej opcji zamawia kuriera
     * wysyla powiadomienie na e-mail
     */
    public function executePrepareShipping(sfWebRequest $request)
    {
        $this->status = '';
        $order = OrderShippingPeer::retrieveByPK($request->getParameter('order'));
        //Zamowienie musi istniec, musi byc zaplacone oraz musi sie zgadac suma kontrolna cs
        if(isset($order) && $request->hasParameter('cs') && $request->getParameter('cs') == md5($order->getTotalAmount().$order->getCourierId()) && $order->getIsPaid() == 1)
        {
            //Nowe zamówienie jeszcze nie zlecane do firmy kurierskiej
            if($order->getStatus() == 0)
            {

                //Kurier obsługujacy zamowienie
                $courier = $order->getCourier();
                //Jezeli kurier to firma DHL wykonujemy zledania dla dhla

                /*
                 * INTEGRACJA Z FIRMA KURIERSKA DHL
                 */
                if(strtoupper($courier->getName()) == 'DHL')
                {
                    $order->requestCourier();

                    //wysyłamy email z informacjami oraz listem przewozowym
                    $this->send_email($order->getId());
                    if($order->getListNumber() != '' && $order->getOutherOrderNumber() != "")
                    {
                        $this->send_email($order->getId());
                        $this->status = 'ok';

                    }
                    else
                    {
                        $this->error_code = 50;
                    }
                    
                }
                //KONIEC DHL
                
                /*
                 * INTEGRACJA Z FIRMA KURIERSKA UPS
                 * TODO: W fazie wrażania!!!!
                 */
                if(strtoupper($courier->getName()) == 'UPS')
                {
                   //$this->error_code = 10;
                    $order->requestCourier();
                    if($order->getListNumber() != '')
                    {
                        $this->send_email($order->getId());
                        $order->send_email($order->getId(), false, true, "Drogi użytkowniku w załączniku przesyłamy Ci list przewozowy. Pozdrawiamy zespół e-certus.");
                        $this->status = 'ok';

                    }
                    else
                    {
                        if($order->getStatus()==0)
                        {
                            //OrderShipping::login_to_UPS_v2();
                             //$this->redirect('shipping/prepareShipping?order='.$order->getId().'&cs='.md5($order->getTotalAmount().$order->getCourierId()));
                                //$this->redirect('shipping/loginToUPS');
                        }
                        $this->error_code = 50;
                    }
                }
                //KONIEC UPS

            }
            else
            {
                if($order->getStatus() == 1)
                {
                    $this->error_code = 11;
                }
                else if($order->getStatus() == 2)
                {
                    $this->error_code = 22;
                }
                else if($order->getStatus() == 3)
                {
                    $this->error_code = 33;
                }
            }
        }
        else
        {
           $this->error_code = 20;
        }
    }


    public function  executeSearch(sfWebRequest $request)
    {
        $this->resp = "";
        if($request->isMethod('post') && $request->hasParameter('shipping_search_dhl') && $request->getParameter('shipping_search_dhl')!= "")
        {
            $soapClient = new SoapClient("http://webapps.dhl.com.pl/app/tntwebservice/tntwebservice.wsdl");
            //$shipments = array("11087876261","11087876262");
            $shipments = array(trim($request->getParameter('shipping_search_dhl')));
            $remoteCallParams = array("shipmentNumbers" => $shipments);
            $remoteCallResult = $soapClient->GetShipments($remoteCallParams);
             //print_r($remoteCallResult);
            //echo $remoteCallResult

             if(is_array($remoteCallResult->GetShipmentsResult->Shipment))
             {
                 for($i=0;$i<count($remoteCallResult->GetShipmentsResult->Shipment);$i++)
                 {
                      echo $remoteCallResult->GetShipmentsResult->Shipment[$i]->Status;
                      if(is_object($remoteCallResult->GetShipmentsResult->Shipment[$i]->Events))
                        $this->resp ="<div> ".$this->translateDHL ($remoteCallResult->GetShipmentsResult->Shipment[$i]->Events->Event[3]->Status)."</dev>";

                 }
             }
             else
             {
                 if($remoteCallResult->GetShipmentsResult->Shipment->Status == "FOUND" && is_array($remoteCallResult->GetShipmentsResult->Shipment->Events->Event)){
                      if(is_object($remoteCallResult->GetShipmentsResult->Shipment->Events))
                      $this->resp ="<div>Informacje dla przesyłki o numerze: ".trim($request->getParameter('shipping_search_dhl'))."</div>"."<div> ".$this->translateDHL($remoteCallResult->GetShipmentsResult->Shipment->Events->Event[3]->Status)."</dev>";
                 }

                 else
                 {
                   $this->resp ="<div>Informacje dla przesyłki o numerze: ".trim($request->getParameter('shipping_search_dhl'))."</div>"."<div> Przesyłka nie została odnaleziona. </div>";
                 }

            }
        }

       

        
    }

    private function translateDHL($code)
    {
        switch ($code) {
            case "AN":
                return  "przesyłka błędnia zaadresowana";
            case "AWI":
                return "odbiorcy nie było w domu w momencie doręczania przesyłki";
            case "BRG":
                return "doręczenie wstrzymane do czasu uregulowania opłat przez odbiorcę";
            case "DOR":
                return "przesyłka doręczona do odbiorcy";
            case "DWP":
                return  "przesyłka odebrana od nadawcy";
            case "LK":
                return "przesyłka przekazana kurierowi do doręczenia";
            case "LP":
                return "przesyłka dotarła do terminala DHL";
            case "OP":
                return "odbiorca odmówił przyjęcia przesyłki";
            case "OWL":
                return "przesyłka oczekuje na odbiór przez klienta w terminalu DHL";
           case "PNK":
               return "przesyłka niekompletna";
            case "SORT":
                return "przesyłka w sortowni DHL";
            case "ZWN":
                return "przesyłka zwrócona nadawcy";
            case "ZWW":
                return "przesyłka oczekuje na kolejny cykl doręczenia";

            default:
                break;
        }
    }
    
    public function executeLoginToUPS(sfWebRequest $request) 
    {
        try {
            $cookie = OrderShipping::login_to_UPS_v2();
            OrderShipping::cleanUPSShippingForm();
            $this->redirect('@homepage');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
        $this->redirect('@homepage');
    }

 

}
