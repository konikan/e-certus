<?php

/**
 * zones_services actions.
 *
 * @package    e-certus
 * @subpackage zones_services
 * @author     Your name here
 */
class zones_servicesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ZonesServicess = ZonesServicesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZonesServicesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZonesServicesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ZonesServices = ZonesServicesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesServices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesServicesForm($ZonesServices);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ZonesServices = ZonesServicesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesServices does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesServicesForm($ZonesServices);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ZonesServices = ZonesServicesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesServices does not exist (%s).', $request->getParameter('id')));
    $ZonesServices->delete();

    $this->redirect('zones_services/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ZonesServices = $form->save();

      $this->redirect('zones_services/edit?id='.$ZonesServices->getId());
    }
  }
}
