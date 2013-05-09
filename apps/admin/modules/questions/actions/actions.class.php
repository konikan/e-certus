<?php

/**
 * questions actions.
 *
 * @package    e-certus
 * @subpackage questions
 * @author     Your name here
 */
class questionsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Questionss = QuestionsPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new QuestionsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new QuestionsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Questions = QuestionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Questions does not exist (%s).', $request->getParameter('id')));
    $this->form = new QuestionsForm($Questions);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Questions = QuestionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Questions does not exist (%s).', $request->getParameter('id')));
    $this->form = new QuestionsForm($Questions);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Questions = QuestionsPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Questions does not exist (%s).', $request->getParameter('id')));
    $Questions->delete();

    $this->redirect('questions/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Questions = $form->save();

      $this->redirect('questions/edit?id='.$Questions->getId());
    }
  }
}
