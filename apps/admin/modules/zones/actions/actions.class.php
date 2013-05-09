<?php

/**
 * zones actions.
 *
 * @package    e-certus
 * @subpackage zones
 * @author     Your name here
 */
class zonesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Zoness = ZonesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZonesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZonesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Zones = ZonesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Zones does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesForm($Zones);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Zones = ZonesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Zones does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesForm($Zones);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Zones = ZonesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Zones does not exist (%s).', $request->getParameter('id')));
    $Zones->delete();

    $this->redirect('zones/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Zones = $form->save();

      $this->redirect('zones/edit?id='.$Zones->getId());
    }
  }
}
