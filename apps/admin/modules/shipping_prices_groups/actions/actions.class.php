<?php

/**
 * shipping_prices_groups actions.
 *
 * @package    e-certus
 * @subpackage shipping_prices_groups
 * @author     Your name here
 */
class shipping_prices_groupsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingPricesGroupss = ShippingPricesGroupsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingPricesGroupsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingPricesGroupsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingPricesGroups = ShippingPricesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPricesGroups does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingPricesGroupsForm($ShippingPricesGroups);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingPricesGroups = ShippingPricesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPricesGroups does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingPricesGroupsForm($ShippingPricesGroups);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingPricesGroups = ShippingPricesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingPricesGroups does not exist (%s).', $request->getParameter('id')));
    $ShippingPricesGroups->delete();

    $this->redirect('shipping_prices_groups/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingPricesGroups = $form->save();

      $this->redirect('shipping_prices_groups/edit?id='.$ShippingPricesGroups->getId());
    }
  }
}
