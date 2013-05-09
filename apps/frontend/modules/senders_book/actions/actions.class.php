<?php

/**
 * senders_book actions.
 *
 * @package    e-certus
 * @subpackage senders_book
 * @author     Your name here
 */
class senders_bookActions extends sfActions
{
    var $user;
  public function  preExecute() {

      $this->user =  $this->getUser()->getAttribute('user', null);
      if(is_null($this->user))
      {
          $this->redirect('@homepage');
      }
      

    }
  public function executeIndex(sfWebRequest $request)
  {
     $c = new Criteria();
     $c->add(UserSenderPeer::USER_ID, $this->user->getId());
    $this->UserSenders = UserSenderPeer::doSelect($c);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SendersBookForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SendersBookForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($UserSender = UserSenderPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserSender does not exist (%s).', $request->getParameter('id')));
    if($UserSender->getUserId() != $this->user->getId())
    {
        $this->redirect('senders_book/index');
    }
    $this->form = new SendersBookForm($UserSender);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($UserSender = UserSenderPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserSender does not exist (%s).', $request->getParameter('id')));
    
    $this->form = new SendersBookForm($UserSender);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($UserSender = UserSenderPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserSender does not exist (%s).', $request->getParameter('id')));
    if($UserSender->getUserId() != $this->user->getId())
    {
        $this->redirect('senders_book/index');
    }
    $UserSender->delete();

    $this->redirect('senders_book/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $UserSender = $form->save();
      if($UserSender->getUserId()== '')
      {
          $UserSender->setUserId($this->user->getId());
          $UserSender->save();
      }

      if($UserSender->getIsDefault() == 1)
      {
            $con = Propel::getConnection();

            // select from...
            $c1 = new Criteria();
            $c1->add(UserSenderPeer::USER_ID, $this->user->getId());
            $c1->add(UserSenderPeer::IS_DEFAULT, 1);
            $c1->add(UserSenderPeer::ID, $UserSender->getId(), Criteria::NOT_EQUAL);
            

            // update set
            $c2 = new Criteria();
            $c2->add(UserSenderPeer::IS_DEFAULT, 0);;

            BasePeer::doUpdate($c1, $c2, $con);
      }
      $this->redirect('senders_book/index');
    }
  }
}
