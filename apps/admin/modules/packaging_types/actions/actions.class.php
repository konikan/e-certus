<?php

/**
 * packaging_types actions.
 *
 * @package    e-certus
 * @subpackage packaging_types
 * @author     Your name here
 */
class packaging_typesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->PackagingTypess = PackagingTypesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PackagingTypesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PackagingTypesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($PackagingTypes = PackagingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object PackagingTypes does not exist (%s).', $request->getParameter('id')));
    $this->form = new PackagingTypesForm($PackagingTypes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($PackagingTypes = PackagingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object PackagingTypes does not exist (%s).', $request->getParameter('id')));
    $this->form = new PackagingTypesForm($PackagingTypes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($PackagingTypes = PackagingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object PackagingTypes does not exist (%s).', $request->getParameter('id')));
    $PackagingTypes->delete();

    $this->redirect('packaging_types/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $PackagingTypes = $form->save();

      $this->redirect('packaging_types/edit?id='.$PackagingTypes->getId());
    }
  }
}
