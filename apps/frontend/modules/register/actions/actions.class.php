<?php

/**
 * register actions.
 *
 * @package    e-certus
 * @subpackage register
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new RegisterUserForm();
    $register_values = $this->getUser()->getAttribute('register_values', null);
    // print_r($register_values);
    if(isset($register_values))
    {
        //print_r($register_values);
        $this->form->setDefaults($register_values);
    }
    $this->form->setDefault('is_company', false);
    if ($request->isMethod('post'))
    {
        $req_values = $request->getParameter($this->form->getName());
            if(isset($req_values['is_company']) && $req_values['is_company'] == 'on')
            {
                //echo "dupa";
                 $this->form->setValidator('company_name', new sfValidatorString(array('required' => true)));
                 $this->form->setValidator('company_street', new sfValidatorString(array('required' => true)));
                 $this->form->setValidator('company_home_nr', new sfValidatorString(array('required' => true)));
                  $this->form->setValidator('company_nip', new sfValidatorString(array('required' => true)));
                   $this->form->setValidator('company_post_code', new sfValidatorString(array('required' => true)));
                    $this->form->setValidator('company_city', new sfValidatorString(array('required' => true)));
            }
      $this->form->bind($request->getParameter('users'));

      if ($this->form->isValid())
      {
          $user = $this->form->save();
          $user->setPassword(sha1($user->getPassword()));
          $user->save();
          $this->send_email($user->getId());
          $this->redirect('register/success');
      }
    }

  }

  public function executeSuccess(sfWebRequest $request)
  {

  }

  private  function send_email($user_id)
  {
    //Mail creation

      $user = UsersPeer::retrieveByPK($user_id);
      //if(!$user) return
    $mail_config = ConfigPeer::getConfig('mailer');
    $page_active_mail = ConfigPeer::getConfig('page_active_mail');
    if(isset ($page_active_mail['page_active_mail']))
    {
        $mail_add_text = $page_active_mail['page_active_mail'];
    }
    else
    {
         $mail_add_text = "";
    }
    //$order = OrderShippingPeer::retrieveByPK($order_id);

    if(isset($mail_config['mailer_email']) && isset($mail_config['mailer_host']) && isset($mail_config['mailer_email']) && isset($mail_config['mailer_port']))
    {
        //Create the Transport the call setUsername() and setPassword()
        $transport = Swift_SmtpTransport::newInstance($mail_config['mailer_host'],$mail_config['mailer_port'] )
            ->setUsername($mail_config['mailer_email'])
            ->setPassword($mail_config['mailer_password']);

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);



     //   $order_sender = $order->getOrderShippingSenders();
        //print_r($order_sender);
    $message = Swift_Message::newInstance('Rejestracja użytkownika - ecertus ')
        ->setFrom(array($mail_config['mailer_email'] => $mail_config['mailer_name']))
        ->setTo(array($user->getEmail() => $user->getEmail()))

        ->setContentType('text/html')
       ;

                $message->setBody($this->getPartial('login/active_mail_body',array('user'=>$user, 'mail_add_text' => $mail_add_text)));


      
       //

        $mailer->send($message);
    }



  }

  public function executeActive(sfWebRequest $request)
    {

      $user = UsersPeer::retrieveByPK($request->getParameter('user'));

      if($user)
      {
          $user->setActivity(true);
          $user->save();
          $this->code = 'ok';
      }

    }


}
