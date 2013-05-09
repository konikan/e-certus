<?php

/**
 * payment actions.
 *
 * @package    e-certus
 * @subpackage payment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paymentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->order = OrderShippingPeer::retrieveByPK($request->getParameter('order'));
  }
  public function  executeSuccess(sfWebRequest $request) {
     // sprawdzenie adresu IP oraz występowania zmiennych POST
        if($_SERVER['REMOTE_ADDR']=='195.149.229.109' && !empty($_POST)){
        $id_sprzedawcy = $_POST['id'];
        $status_transakcji = $_POST['tr_status'];
        $id_transakcji = $_POST['tr_id'];
        $kwota_transakcji = $_POST['tr_amount'];
        $kwota_zaplacona = $_POST['tr_paid'];
        $blad = $_POST['tr_error'];
        $data_transakcji = $_POST['tr_date'];
        $opis_transackji = $_POST['tr_desc'];
        $ciag_pomocniczy = $_POST['tr_crc'];
        $email_klienta = $_POST['tr_email'];
        $suma_kontrolna = $_POST['md5sum'];
        // sprawdzenie stanu transakcji
        if($status_transakcji=='TRUE' && $blad=='none')
        {

            //$this->redirect('shipping/prepareShipping?order='.$request->getParameter('order').'&cs='.md5($order->getTotalAmount().$order->getCourierId()));
        }
        else
        {
            
        }
        }
        echo 'TRUE'; // odpowiedź dla serwera o odebraniu danych

        if($status_transakcji=='TRUE' && $blad=='none')
        {
            $order = OrderShippingPeer::retrieveByPK($request->getParameter('order'));
            if($order)
            {
                $order->setIsPaid(1);
                $order->save();
            }
            $this->redirect('shipping/prepareShipping?order='.$request->getParameter('order').'&cs='.md5($order->getTotalAmount().$order->getCourierId()));
        }

    }
    public function  executeFail(sfWebRequest $request)
    {

    }

    public function executeTest(sfWebRequest $request)
    {
      return ('shipping/calculate');
      $order = OrderShippingPeer::retrieveByPK($request->getParameter('order'));
      if($order)
      {
          $this->redirect('shipping/prepareShipping?order='.$order->getId().'&cs='.md5($order->getTotalAmount().$order->getCourierId()));
      }
      
    }

    public function  executePrepaid(sfWebRequest $request) {
        $this->order = OrderShippingPeer::retrieveByPK($request->getParameter('order'));
        if($this->order)
        {
            
            $this->user = UsersPeer::retrieveByPK($this->order->getUserId());
            $total = $this->order->getTotalAmount();
            if($request->isMethod('post')){
            if($this->user->getPrepaidBalance()> $total && $this->order->getPaidType() == 2)
            {
                //$this->order->login_to_UPS_v2();
                $new_balance = $this->user->getPrepaidBalance() -  $total;
                $this->user->setPrepaidBalance($new_balance);
                $this->user->save();
                //$this->redirect('shipping/calculate');
                if($this->order)
                {
                    $this->order->setIsPaid(1);
                    $this->order->save();
                }
                $this->redirect('shipping/prepareShipping?order='.$this->order->getId().'&cs='.md5($this->order->getTotalAmount().$this->order->getCourierId()));
            }
            }
        }
    }

}
