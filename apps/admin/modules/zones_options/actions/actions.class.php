<?php

/**
 * zones_options actions.
 *
 * @package    e-certus
 * @subpackage zones_options
 * @author     Your name here
 */
class zones_optionsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ZonesOptionss = ZonesOptionsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZonesOptionsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZonesOptionsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ZonesOptions = ZonesOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesOptions does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesOptionsForm($ZonesOptions);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ZonesOptions = ZonesOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesOptions does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZonesOptionsForm($ZonesOptions);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ZonesOptions = ZonesOptionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ZonesOptions does not exist (%s).', $request->getParameter('id')));
    $ZonesOptions->delete();

    $this->redirect('zones_options/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ZonesOptions = $form->save();

      $this->redirect('zones_options/edit?id='.$ZonesOptions->getId());
    }
  }
}
