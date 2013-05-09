<?php

/**
 * orders actions.
 *
 * @package    e-certus
 * @subpackage orders
 * @author     Your name here
 */
class ordersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

    $c = new Criteria();
    $c->addDescendingOrderByColumn(OrderShippingPeer::CREATED_AT);
    $pager = new sfPropelPager('OrderShipping', 30);
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;


    //$this->OrderShippings = OrderShippingPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrderShippingForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrderShippingForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($OrderShipping = OrderShippingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object OrderShipping does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrderShippingForm($OrderShipping);

    $courier = $OrderShipping->getCourier();
    if($request->hasParameter('email') && $request->getParameter('email') == 1)
    {
        $this->send_email($request->getParameter('id'));
        $this->redirect('orders/edit?id='.$OrderShipping->getId());
        }
    //echo  number_format($OrderShipping->getWeight(),0,',','');
    //$courier->generate_DHL_DWP_FILE($OrderShipping->getId());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($OrderShipping = OrderShippingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object OrderShipping does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrderShippingForm($OrderShipping);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($OrderShipping = OrderShippingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object OrderShipping does not exist (%s).', $request->getParameter('id')));
    $OrderShipping->delete();

    $this->redirect('orders/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $OrderShipping = $form->save();

      $this->redirect('orders/edit?id='.$OrderShipping->getId());
    }
  }

  private function send_email($order_id, $with_order_info=true ,$with_list=true, $add_msq=false)
  {
    //Mail creation

    $mail_config = ConfigPeer::getConfig('mailer');
    $order = OrderShippingPeer::retrieveByPK($order_id);

    if(isset($mail_config['mailer_email']) && isset($mail_config['mailer_host']) && isset($mail_config['mailer_email']) && isset($mail_config['mailer_port']))
    {
        //Create the Transport the call setUsername() and setPassword()
        $transport = Swift_SmtpTransport::newInstance($mail_config['mailer_host'],$mail_config['mailer_port'] )
            ->setUsername($mail_config['mailer_email'])
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
                $message->setBody($add_msq.$this->getPartial('orderMailBody', array('order'=>$order)));
           else
               $message->setBody($this->getPartial('orderMailBody', array('order'=>$order)));

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
        

        }
       //
     
        $mailer->send($message);
    }
  }

 


    public function executeSendShippingList(sfWebRequest $request)
    {
        $order = OrderShippingPeer::retrieveByPK($request->getParameter('id'));
        if($order)
        {
            $sender = $order->getSender();
            $order->send_email($order->getId(), false, true, "Drogi użytkowniku w załączniku przesyłamy Ci list przewozowy. Pozdrawiamy zespół e-certus.");
            $this->getUser()->setFlash('notice', 'List przewozowy został wysłany na adres: '.$sender->getEmail());
            $this->redirect('orders/edit?id='.$request->getParameter('id'));
        }
    }

    public function executeRequestCourier(sfWebRequest $request)
    {
        $order = OrderShippingPeer::retrieveByPK($request->getParameter('id'));
        if($order)
        {
            //Wywołanie metody zamawiającej kuriera;
            $order->requestCourier();
            if($order->getStatus() == 1)
                $this->getUser()->setFlash('notice', 'Zamówienie zostało przekazane do firmy kurierskiej');
            else
                $this->getUser()->setFlash('error', 'Niestety operacja nie została poprawnie wykonana');

            
            $this->redirect('orders/edit?id='.$request->getParameter('id'));
        }
    }

}
