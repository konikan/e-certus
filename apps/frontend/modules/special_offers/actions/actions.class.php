<?php

/**
 * special_offers actions.
 *
 * @package    e-certus
 * @subpackage special_offers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class special_offersActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $this->SpecialOffers = SpecialOfferPeer::doSelect($c);
  }
}
