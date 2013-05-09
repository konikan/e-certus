<?php

/**
 * insurance_rates actions.
 *
 * @package    e-certus
 * @subpackage insurance_rates
 * @author     Your name here
 */
class insurance_ratesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->InsuranceRatess = InsuranceRatesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new InsuranceRatesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InsuranceRatesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($InsuranceRates = InsuranceRatesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object InsuranceRates does not exist (%s).', $request->getParameter('id')));
    $this->form = new InsuranceRatesForm($InsuranceRates);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($InsuranceRates = InsuranceRatesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object InsuranceRates does not exist (%s).', $request->getParameter('id')));
    $this->form = new InsuranceRatesForm($InsuranceRates);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($InsuranceRates = InsuranceRatesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object InsuranceRates does not exist (%s).', $request->getParameter('id')));
    $InsuranceRates->delete();

    $this->redirect('insurance_rates/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $InsuranceRates = $form->save();

      $this->redirect('insurance_rates/edit?id='.$InsuranceRates->getId());
    }
  }
}
