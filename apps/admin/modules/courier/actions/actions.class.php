<?php

/**
 * courier actions.
 *
 * @package    e-certus
 * @subpackage courier
 * @author     Your name here
 */
class courierActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Couriers = CourierPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CourierForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CourierForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $this->form = new CourierForm($Courier);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $this->form = new CourierForm($Courier);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $Courier->delete();

    $this->redirect('courier/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Courier = $form->save();

      $this->redirect('courier/edit?id='.$Courier->getId());
    }
  }
}
