<?php

/**
 * recipients_book actions.
 *
 * @package    e-certus
 * @subpackage recipients_book
 * @author     Your name here
 */
class recipients_bookActions extends sfActions
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
      $c->add(UserRecipientPeer::USER_ID, $this->user->getId());
    $this->UserRecipients = UserRecipientPeer::doSelect($c);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RecipientsBookForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RecipientsBookForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($UserRecipient = UserRecipientPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserRecipient does not exist (%s).', $request->getParameter('id')));
    if($UserRecipient->getUserId() != $this->user->getId())
    {
        $this->redirect('senders_book/index');
    }
    $this->form = new RecipientsBookForm($UserRecipient);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($UserRecipient = UserRecipientPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserRecipient does not exist (%s).', $request->getParameter('id')));
    $this->form = new RecipientsBookForm($UserRecipient);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($UserRecipient = UserRecipientPeer::retrieveByPk($request->getParameter('id')), sprintf('Object UserRecipient does not exist (%s).', $request->getParameter('id')));
    if($UserRecipient->getUserId() != $this->user->getId())
    {
        $this->redirect('senders_book/index');
    }
    $UserRecipient->delete();

    $this->redirect('recipients_book/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $UserRecipient = $form->save();
      if($UserRecipient->getUserId()== '')
      {
          $UserRecipient->setUserId($this->user->getId());
          $UserRecipient->save();
      }
      $this->redirect('recipients_book/index');
    }
  }
}
