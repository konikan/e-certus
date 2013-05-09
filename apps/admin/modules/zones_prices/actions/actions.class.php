<?php

/**
 * zones_prices actions.
 *
 * @package    e-certus
 * @subpackage zones_prices
 * @author     Your name here
 */
class zones_pricesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ZonesPeer::NAME);
    $c->addAscendingOrderByColumn(ZonesPricesPeer::INITIAL_WEIGHT);
    $c->addAscendingOrderByColumn(ZonesPricesPeer::FINAL_WEIGHT);
    $this->ZonesPricess = ZonesPricesPeer::doSelectJoinAll($c);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZonesPricesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZonesPricesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ZonesPrices = ZonesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesPricesForm($ZonesPrices);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ZonesPrices = ZonesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesPrices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesPricesForm($ZonesPrices);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ZonesPrices = ZonesPricesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesPrices does not exist (%s).', $request->getParameter('id')));
    $ZonesPrices->delete();

    $this->redirect('zones_prices/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ZonesPrices = $form->save();

      $this->redirect('zones_prices/edit?id='.$ZonesPrices->getId());
    }
  }
}
