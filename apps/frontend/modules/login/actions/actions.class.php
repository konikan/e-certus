<?php

/**
 * login actions.
 *
 * @package    e-certus
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new UserLoginForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
          $values = $this->form->getValues();
          $user = $this->checkUser($values['email'], $values['password']);
          if($user)
          {
              $this->getUser()->setAttribute('user', $user);
              //$this->redirect('shipping/index');
              $this->redirect('@homepage');
          }
          else
          {
              $this->error = "Błędna nazwa użytkownika lub hasło";
          }

      }
          
      }
    

  }

  private function checkUser($login="",$password="")
  {
      $c = new Criteria();
      $c->add(UsersPeer::EMAIL,$login);
      $c->add(UsersPeer::PASSWORD,  sha1($password));
      $c->add(UsersPeer::ACTIVITY,1);


      return UsersPeer::doSelectOne($c);
  }

  public function executeForgotMyPassword(sfWebRequest $request)
  {
      $this->form = new ForgotMyPasswordForm();
      if($request->isMethod('post'))
      {
          $captcha = array(
  'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
  'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
);
            $this->form->bind(array_merge($request->getParameter('forgot'), array('captcha' => $captcha)));
            if($this->form->isValid())
            {
                $values = $this->form->getValues();
                $c = new Criteria();
                $c->add(UsersPeer::EMAIL, $values['email']);

                $user = UsersPeer::doSelectOne($c);
                if($user)
                {
                   $this->send_password($user);
                }
            }
        }
      }

      private  function send_password($user)
      {

     
      //if(!$user) return
    $mail_config = ConfigPeer::getConfig('mailer');
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
    $message = Swift_Message::newInstance('Przypomnienie hasła - ecertus ')
        ->setFrom(array($mail_config['mailer_email'] => $mail_config['mailer_name']))
        ->setTo(array($user->getEmail() => $user->getEmail()))

        ->setContentType('text/html')
       ;

                $message->setBody($this->getPartial('login/send_password',array('user'=>$user)));



       //

        $mailer->send($message);
    }
      }
  
}
