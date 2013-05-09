<?php

/**
 * shipping_products actions.
 *
 * @package    e-certus
 * @subpackage shipping_products
 * @author     Your name here
 */
class shipping_productsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingProductss = ShippingProductsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingProductsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingProductsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingProducts = ShippingProductsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingProducts does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingProductsForm($ShippingProducts);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingProducts = ShippingProductsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingProducts does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingProductsForm($ShippingProducts);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingProducts = ShippingProductsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingProducts does not exist (%s).', $request->getParameter('id')));
    $ShippingProducts->delete();

    $this->redirect('shipping_products/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingProducts = $form->save();

      $this->redirect('shipping_products/edit?id='.$ShippingProducts->getId());
    }
  }
}
