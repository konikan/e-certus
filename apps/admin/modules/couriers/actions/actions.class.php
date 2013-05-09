<?php

/**
 * couriers actions.
 *
 * @package    e-certus
 * @subpackage couriers
 * @author     Your name here
 */
class couriersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Couriers = CourierPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CourierForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CourierForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $this->form = new CourierForm($Courier);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $this->form = new CourierForm($Courier);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Courier = CourierPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Courier does not exist (%s).', $request->getParameter('id')));
    $Courier->delete();

    $this->redirect('couriers/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Courier = $form->save();

      $this->redirect('couriers/edit?id='.$Courier->getId());
    }
  }

  public function  executeImportDHLListNumbers(sfWebRequest $request)
  {
    $this->form = new ImportDHLListNumbersForm();
    if($request->isMethod('post'))
    {
        $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
       if ($this->form->isValid())
       {
            $values = $this->form->getValues();

            $start_nb   =   $values['start_number'];
            $end_nb     =   $values['end_number'];
            if($end_nb <= $start_nb)
            {
                $this->getUser()->setFlash('error', 'Wartość końcowa jest większa od początkowej');
                $this->redirect('couriers/importDHLListNumbers');
            }
            else {
                for($i=$start_nb;$i<=$end_nb;$i++)
                {
                    $num = new DhlNumbers();
                    $num->setListNumber($i);
                    $num->setUsed(0);
                    $num->save();
                }
                $this->getUser()->setFlash('notice', 'Import numerów zakończył się sukcesem');
                $this->redirect('couriers/importDHLListNumbers');
            }


       }
    }
  }
}
