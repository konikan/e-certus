<?php

/**
 * special_offers actions.
 *
 * @package    e-certus
 * @subpackage special_offers
 * @author     Your name here
 */
class special_offersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->SpecialOffers = SpecialOfferPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SpecialOfferForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SpecialOfferForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($SpecialOffer = SpecialOfferPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SpecialOffer does not exist (%s).', $request->getParameter('id')));
    $this->form = new SpecialOfferForm($SpecialOffer);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($SpecialOffer = SpecialOfferPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SpecialOffer does not exist (%s).', $request->getParameter('id')));
    $this->form = new SpecialOfferForm($SpecialOffer);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($SpecialOffer = SpecialOfferPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SpecialOffer does not exist (%s).', $request->getParameter('id')));
    $SpecialOffer->delete();

    $this->redirect('special_offers/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $SpecialOffer = $form->save();

      $this->redirect('special_offers/edit?id='.$SpecialOffer->getId());
    }
  }
}
