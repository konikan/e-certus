<?php

/**
 * ordershipping actions.
 *
 * @package    e-certus
 * @subpackage ordershipping
 * @author     Your name here
 */
class ordershippingActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->OrderShippings = OrderShippingPeer::doSelect(new Criteria());
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

    $this->redirect('ordershipping/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $OrderShipping = $form->save();

      $this->redirect('ordershipping/edit?id='.$OrderShipping->getId());
    }
  }
}
