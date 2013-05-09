<?php

/**
 * countries actions.
 *
 * @package    e-certus
 * @subpackage countries
 * @author     Your name here
 */
class countriesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Countriess = CountriesPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CountriesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CountriesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Countries = CountriesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Countries does not exist (%s).', $request->getParameter('id')));
    $this->form = new CountriesForm($Countries);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Countries = CountriesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Countries does not exist (%s).', $request->getParameter('id')));
    $this->form = new CountriesForm($Countries);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Countries = CountriesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Countries does not exist (%s).', $request->getParameter('id')));
    $Countries->delete();

    $this->redirect('countries/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Countries = $form->save();

      $this->redirect('countries/edit?id='.$Countries->getId());
    }
  }
}
