<?php

/**
 * shipping_options actions.
 *
 * @package    e-certus
 * @subpackage shipping_options
 * @author     Your name here
 */
class shipping_optionsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingOptionss = ShippingOptionsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingOptionsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingOptionsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingOptions = ShippingOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingOptions does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingOptionsForm($ShippingOptions);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingOptions = ShippingOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingOptions does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingOptionsForm($ShippingOptions);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingOptions = ShippingOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingOptions does not exist (%s).', $request->getParameter('id')));
    $ShippingOptions->delete();

    $this->redirect('shipping_options/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingOptions = $form->save();

      $this->redirect('shipping_options/edit?id='.$ShippingOptions->getId());
    }
  }
}
