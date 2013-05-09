<?php

/**
 * customers actions.
 *
 * @package    e-certus
 * @subpackage customers
 * @author     Your name here
 */
class customersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Userss = UsersPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UsersForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UsersForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Users does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsersForm($Users);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Users does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsersForm($Users);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Users does not exist (%s).', $request->getParameter('id')));
    $Users->delete();

    $this->redirect('customers/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Users = $form->save();

      $this->redirect('customers/edit?id='.$Users->getId());
    }
  }
}
