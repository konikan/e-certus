<?php

/**
 * discounts actions.
 *
 * @package    e-certus
 * @subpackage discounts
 * @author     Your name here
 */
class discountsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    if($request->hasParameter('user'))
    {
        $this->user_id = $request->getParameter('user');
        $this->user = UsersPeer::retrieveByPK($this->user_id);
        $c->add(DiscountsPeer::USER_ID,$request->getParameter('user'));
    }
    else {
        $this->redirect('customers/index');
    }
    $this->Discountss = DiscountsPeer::doSelect($c);
  }

  public function executeNew(sfWebRequest $request)
  {
    $discount = new Discounts();
    $discount->setUserId($request->getParameter('user'));
    $this->form = new DiscountsForm($discount);
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DiscountsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Discounts = DiscountsPeer::retrieveByPk($request->getParameter('user_id'),
                         $request->getParameter('type_id')), sprintf('Object Discounts does not exist (%s).', $request->getParameter('user_id'),
                         $request->getParameter('type_id')));
    $this->form = new DiscountsForm($Discounts);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Discounts = DiscountsPeer::retrieveByPk($request->getParameter('user_id'),
                         $request->getParameter('type_id')), sprintf('Object Discounts does not exist (%s).', $request->getParameter('user_id'),
                         $request->getParameter('type_id')));
    $this->form = new DiscountsForm($Discounts);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Discounts = DiscountsPeer::retrieveByPk($request->getParameter('user_id'),
                         $request->getParameter('type_id')), sprintf('Object Discounts does not exist (%s).', $request->getParameter('user_id'),
                         $request->getParameter('type_id')));
    $Discounts->delete();

    $this->redirect('discounts/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    
     
         
    
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
     
      $Discounts = $form->save();
      $this->getUser()->setFlash('notice', 'Rabat został poprawnie zapisany');

      $this->redirect('discounts/edit?user_id='.$Discounts->getUserId().'&type_id='.$Discounts->getTypeId());
    }
  }
}
