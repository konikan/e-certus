<?php

/**
 * user actions.
 *
 * @package    e-certus
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

  public function executeLogin(sfWebRequest $request)
  {

    $this->setLayout('login');
    $this->form = new LoginForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('login'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();

        $user = $this->checkPassword($values['username'], $values['password']);
        if(is_null($user))
        {
            $this->getUser()->setFlash('error', 'Błędna nazwa użytkownika lub hasło');
            $this->redirect('user/login');
        }

        // authenticate user and redirect them
        $this->getUser()->setAuthenticated(true);
        $this->getUser()->addCredential('admin');
        $this->redirect('user/index');
      }
    }
  }

  public function executeLogout()
  {
    $this->getUser()->clearCredentials();
    $this->getUser()->setAuthenticated(false);
    $this->redirect('@homepage');
  }

  private function checkPassword($username, $password)
  {
      $c = new Criteria();
      $c->add(AdminUsersPeer::USERNAME, $username);
      $c->add(AdminUsersPeer::PASSWORD, sha1($password));

      $user = AdminUsersPeer::doSelect($c);
      if($user)
          return $user;
      else
          return null;

  }


  

}
