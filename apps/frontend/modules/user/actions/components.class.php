<?php

/**
 * user actions.
 *
 * @package    e-certus
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userComponents extends sfComponents
{

    public function executeInfo(sfWebRequest $request)
    {
        $this->user = $this->getUser()->getAttribute('user',null);
    }

}


?>