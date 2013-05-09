<?php

/**
 * shipping_types_prices actions.
 *
 * @package    e-certus
 * @subpackage shipping_types_prices
 * @author     Your name here
 */
class shipping_types_pricesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingTypesPricess = ShippingTypesPricesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingTypesPricesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingTypesPricesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingTypesPrices = ShippingTypesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesPricesForm($ShippingTypesPrices);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingTypesPrices = ShippingTypesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesPricesForm($ShippingTypesPrices);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingTypesPrices = ShippingTypesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesPrices does not exist (%s).', $request->getParameter('id')));
    $ShippingTypesPrices->delete();

    $this->redirect('shipping_types_prices/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingTypesPrices = $form->save();

      $this->redirect('shipping_types_prices/edit?id='.$ShippingTypesPrices->getId());
    }
  }
}
