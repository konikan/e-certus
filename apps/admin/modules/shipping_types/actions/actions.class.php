<?php

/**
 * shipping_types actions.
 *
 * @package    e-certus
 * @subpackage shipping_types
 * @author     Your name here
 */
class shipping_typesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      $c = new Criteria();
      $c->addJoin(ShippingTypesPeer::GROUP_ID, ShippingTypesGroupsPeer::ID);
      $c->addAscendingOrderByColumn(ShippingTypesGroupsPeer::COURIER_ID);
       $c->addAscendingOrderByColumn(ShippingTypesPeer::PACKAGING_TYPE_ID);
//$c->add(ShippingTypesPeer::GROUP_ID);
    $this->ShippingTypess = ShippingTypesPeer::doSelect($c);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingTypesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingTypesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingTypes = ShippingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypes does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesForm($ShippingTypes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingTypes = ShippingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypes does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesForm($ShippingTypes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingTypes = ShippingTypesPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypes does not exist (%s).', $request->getParameter('id')));
    $ShippingTypes->delete();

    $this->redirect('shipping_types/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingTypes = $form->save();

      $this->redirect('shipping_types/edit?id='.$ShippingTypes->getId());
    }
  }
}
