<?php


class Courier extends BaseCourier {

    public function  __toString() {
        return $this->getName();
    }

    public  function calculate_date_of_receipt()
    {
        $dates = array();
        for($i=1;$i<=5;$i++)
        {
            $day_name  = date('D',mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
            if($day_name=='Sat' || $day_name=='Sun')
            {
                continue;
            }
            else
            {
                $dates[] = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
            }
                

        }

        //print_r($dates);
        return $dates;

    }

    public  function get_start_time_receipt()
    {
        $times = array();

        $start_time = strtotime($this->getStartWorkTime());
        $end_time = strtotime($this->getEndWorkTime());
        $tmp_time = $start_time;
        $minutes = 15;

        $times['start'][] = date('H:i', $tmp_time);


        while ($tmp_time <= $end_time)
        {
            $tmp_time = strtotime("+$minutes minutes", $tmp_time);

            $times['start'][] = date('H:i', $tmp_time);
            if($tmp_time == $end_time)                break;
        }

        $tmp_time = $start_time;
        $min_start = $minutes*12;
        $tmp_time = strtotime("+$min_start minutes", $tmp_time);

            $times['end'][] = date('H:i', $tmp_time);

        while ($tmp_time <= $end_time)
        {
            $tmp_time = strtotime("+$minutes minutes", $tmp_time);

            $times['end'][] = date('H:i', $tmp_time);
            if($tmp_time == $end_time)                break;
        }

        //print_r($times['end']);
        return $times;

    }



    public function get_self_giving_date_values()
    {
        $dates = array();
        for($i=1;$i<=5;$i++)
        {
            $day_name  = date('D',mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
            if($day_name=='Sat' || $day_name=='Sun')
            {
                continue;
            }
            else
            {
                $dates[] = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
            }


        }

        //print_r($dates);
        return $dates;
    }

    /*
     * Generuje plij z dananiem dla DHL
     */
    public function generate_DHL_DWP_FILE($order_id, $send_via_ftp = true)
    {
        $order = OrderShippingPeer::retrieveByPK($order_id);

        $sender     = $order->getSender();
        $recipient  = $order->getRecipient();


        $DWP_array = array();
        $first_nb = 1;
        $last_nb = 108;

        for($i=$first_nb; $i<=$last_nb; $i++)
        {
            $DWP_array[$i]=  "";
        }

        //Wpisy

           $DWP_array[1]    =   "DHL0209000";
           $DWP_array[2]    =   "I";
           $DWP_array[3]    =   "N";
           $DWP_array[4]    =   $order->getListNumber();
           $DWP_array[5]    =   "";

           $DWP_array[6]    =   $sender->getSenderName();

           $DWP_array[7]    =   str_replace('-', '', trim($sender->getPostcode()));
           $DWP_array[8]    =   $sender->getCity();
           $DWP_array[9]    =   $sender->getStreet();
           $DWP_array[10]    =  $sender->getStreetNr();
           $DWP_array[11]    =  $sender->getTel();

           $DWP_array[12]    =  substr($recipient->getRecipientName(), 0, 15);
           $DWP_array[13]    =  $recipient->getRecipientName();
           $DWP_array[14]    =  str_replace('-', '', trim($recipient->getPostcode()));
           $DWP_array[15]    =  $recipient->getCity();
           $DWP_array[16]    =  $recipient->getAddress();
           $DWP_array[17]    =  $recipient->getStreetNr();
           $DWP_array[18]    =  $recipient->getTel();

           $DWP_array[19]    =  $this->getClientNr();
           $DWP_array[20]    =  '';
           $DWP_array[21]    =  '';
           $DWP_array[22]    =  '';
           $DWP_array[23]    =  '';
           $DWP_array[24]    =  '';
           $DWP_array[25]    =  '';

           //Rodzaj produktu
           $type = $order->getShippingTypes();
           $type_r = $type->getShippingTypesGroups();

           $code = $type_r->getServiceId();
           if('dhl09' == strtolower($code) )
           {
               $DWP_array[26]    =  '09';
           }
           else if('dhl12' == strtolower($code))
           {
               $DWP_array[26]    =  '12';
           }
           else if('ex_17_22' == strtolower($code))
           {
               $DWP_array[42]    =  '2200';
           }
           else
           {
               $DWP_array[26]    =  'AH';
           }

           $DWP_array[27]    =  'Z';
           $DWP_array[28]    =  'P';

           //Jeżeli koperta

           if($order->getPackagingTypes()->getServiceId() == 'letter')
           {
               $DWP_array[29] = $order->getNumberOfPackages();
           }
           else if($order->getWeight() <= 5)
           {
               $DWP_array[30] = $order->getNumberOfPackages();
           }
           else if($order->getWeight() <= 10)
           {
               $DWP_array[31] = $order->getNumberOfPackages();
           }
           else if($order->getWeight() <= 20)
           {
               $DWP_array[32] = $order->getNumberOfPackages();
           }
           else if($order->getWeight() <= 31.5)
           {
               $DWP_array[33] = $order->getNumberOfPackages();
           }

           


           //Suma elementow niestandarwodych
           $DWP_array[34]   =   '';

           if($order->getPackagingTypes()->getServiceId() == 'pallet')
           {
               $DWP_array[35] = $order->getNumberOfPackages();
               if($order->getWeight() <= 200)
               {
                  $DWP_array[36] = $order->getNumberOfPackages();
               }
               else if($order->getWeight() <= 400)
               {
                  $DWP_array[37] = $order->getNumberOfPackages();
               }
               else if($order->getWeight() <= 1000)
               {
                  $DWP_array[38] = $order->getNumberOfPackages();
               }
           }

           //Typ wagi
           $DWP_array[40]   =   'P';

           if($order->getSelfGiving() != 1)
           {
              $DWP_array[47] = $order->getDateOfReceipt().' '.$order->getReceiptTimeEnd('H:i'); 
           }

           //Flagi usług
           $options = $order->getOrderShippingOptionss();
           $flags = array();
           for($i=0;$i<10;$i++)
           {
               $flags[$i]   = 'N';
           }

           foreach ($options as $option)
           {
               //sprawdzenia pobrania

               $s_o = $option->getShippingOptions();
               if($s_o->getServiceId() == 'COD')
               {
                  $DWP_array[61] = $option->getAmount();
               }


               for($i=0;$i<10;$i++)
               {
                   if($s_o->getServiceId() == $i)
                   {
                    
                    if($i==5)
                    {
                        $flags[$i]   = 'T';
                        //Ubezpieczenie
                         $DWP_array[63] = $option->getAmount();
                    }
                   }

               }
           }

           $DWP_array[48]   = implode('', $flags);

           $DWP_array[85]   =   $sender->getEmail();
           $DWP_array[86]   =   $sender->getTel();

           $DWP_array[87]   =   $recipient->getEmail();
           $DWP_array[89]   =   $recipient->getTel();
           


        $row = implode(';', $DWP_array);
        $row.';\n'.PHP_EOL;

        $file_name = $order->getOutherOrderNumber().'_'.$order->getId().'.dwp';
        $file_path = sfConfig::get('sf_data_dir').'/dhl/dwp/'.$file_name;
        $fp = fopen($file_path, 'w');
        fwrite($fp, $row);

        fclose($fp);

        //Jeżeli mamy numer zamowienia kuriera i parametr wysylki jest na tru mozemy umiescic plik z nadaniem na ftp
        if($order->getOutherOrderNumber() != "" && $send_via_ftp == true)
        {
            $this->send_via_ftp($file_path, $file_name, 'plftp.dhl.com', 'e-Certus', 'MJU&6yhn', 3701);
        }

        
    }

    /**
     *
     * @param <type> $file_path
     * @param <type> $addres
     * @param <type> $login
     * @param <type> $pass
     * Wsyła plik z nadaniem na serwer ftp DHL
     */
    public function send_via_ftp($file_src,$file_dest, $ftp_server, $ftp_user_name, $ftp_user_pass, $ftp_port=21)
    {
        // ustal polaczenie
        $conn_id = ftp_connect($ftp_server, $ftp_port);

        // zaloguj uzywajac podanego uzytkownika i hasla
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        // wlacz tryb pasywny
        ftp_pasv($conn_id, true);

        // przeslij plik
        if (ftp_put($conn_id, $file_dest, $file_src , FTP_ASCII)) {
            echo "successfully uploaded $file_dest\n";
        } else {
            echo "There was a problem while uploading $file_dest\n";
        }

        // zamknij połączenie
        ftp_close($conn_id);

        
    }

    /**
     *
     * @param <type> $order_id
     * Zgłasza zlecenia zamówienia kuriera
     */
    public function DHL_order_courier($order_id)
    {
        $order = OrderShippingPeer::retrieveByPK($order_id);
      if(isset($order) && $order->getIsPaid() == 1 && $order->getStatus()=='0')
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
        //echo $result;
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
        else if(!is_null($blad) && $blad != "")
        {
            $order->setNotes($order->getNotes().'\n'.$blad);
        }
        
        curl_close($soap_do);
        }

        }

    }

    public function prepare_DHL_LN($list_nr)
    {
        $liczba = $list_nr;
        //rzutowanie na ciąg znaków
        $sLiczba = (string)$liczba;
        //określenie ilości znaków (cyfr)
        $dlugosc = strlen($liczba);

        if($dlugosc == 10)
        {
                $x = ($sLiczba[0] * 4)+($sLiczba[1] * 9) + ($sLiczba[2] * 4) + ($sLiczba[3] * 9) + ($sLiczba[4] * 4) + ($sLiczba[5] * 9) + ($sLiczba[6] * 4) + ($sLiczba[7] * 9) + ($sLiczba[8] * 4) + ($sLiczba[9] * 9);
                $x = $x % 10;
                $x = 10 - $x;
                $x = $x % 10;
                //wyświetlenie wyniku
                return $x;
        }
        else
        {
            return NULL;
        }
    }


     public function calculate_weight($wy=0,$dl=0,$sz=0,$wg=0, $typ=NULL)
  {
      $res = 0.00;

      if(strtolower($this->getName()) == 'ups')
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
      else if(strtolower($this->getName()) == 'dhl')
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







    
} // Courier
