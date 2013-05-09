<?php

/**
 * config actions.
 *
 * @package    e-certus
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  	$this->form = new ConfigPagesForm();
  	if($request->isMethod('post'))
  	{
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		if($this->form->isValid())
  		{
	  		$values = $request->getParameter('page');
	  		foreach ($values as $key=>$value)
	  		{
	  			$config = ConfigPeer::retrieveByPK($key);
	  			if(!$config)
	  			{
	  				$config = new Config();
	  				$config->setName($key);
	  				$config->setValue($value);
	  				$config->save();
	  			}
	  			else
	  			{
	  				$config->setValue($value);
	  				$config->save();
	  			}

	  		}
	  		$this->redirect('config/index');
	  	}
  	}

  }
}
