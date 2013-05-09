<?php

/**
 * shipping_types_groups actions.
 *
 * @package    e-certus
 * @subpackage shipping_types_groups
 * @author     Your name here
 */
class shipping_types_groupsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ShippingTypesGroupss = ShippingTypesGroupsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShippingTypesGroupsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShippingTypesGroupsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ShippingTypesGroups = ShippingTypesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesGroups does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesGroupsForm($ShippingTypesGroups);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ShippingTypesGroups = ShippingTypesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesGroups does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShippingTypesGroupsForm($ShippingTypesGroups);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ShippingTypesGroups = ShippingTypesGroupsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ShippingTypesGroups does not exist (%s).', $request->getParameter('id')));
    $ShippingTypesGroups->delete();

    $this->redirect('shipping_types_groups/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ShippingTypesGroups = $form->save();

      $this->redirect('shipping_types_groups/edit?id='.$ShippingTypesGroups->getId());
    }
  }
}
