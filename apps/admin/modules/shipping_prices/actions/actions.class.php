<?php

/**
 * shipping_prices actions.
 *
 * @package    e-certus
 * @subpackage shipping_prices
 * @author     Your name here
 */
class shipping_pricesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingPricess = ShippingPricesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingPricesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingPricesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingPrices = ShippingPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingPricesForm($ShippingPrices);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingPrices = ShippingPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingPricesForm($ShippingPrices);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingPrices = ShippingPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPrices does not exist (%s).', $request->getParameter('id')));
    $ShippingPrices->delete();

    $this->redirect('shipping_prices/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingPrices = $form->save();

      $this->redirect('shipping_prices/edit?id='.$ShippingPrices->getId());
    }
  }
}
