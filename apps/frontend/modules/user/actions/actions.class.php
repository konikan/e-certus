<?php

/**
 * user actions.
 *
 * @package    e-certus
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');


  }

  public function executeInfo(sfWebRequest $request)
  {
      $user = $this->getUser()->getAttribute('user');
      if(isset($user))
      {
        $this->form = new UsersForm($user);
        unset($this->form['password'],$this->form['password_ask'], $this->form['password_rep'], $this->form['activity'],
        $this->form['blocked'], $this->form['created_at'],$this->form['updated_at'], $this->form['is_cash_on_delivery']);

        if ($request->isMethod('post'))
        {
            $req_values = $request->getParameter($this->form->getName());
            if(isset($req_values['is_company']) && $req_values['is_company'] == 'on')
            {
                //echo "dupa";
                 $this->form->setValidator('company_name', new sfValidatorString(array('required' => true),array('required' => "Podaj nazwę")));
                 $this->form->setValidator('company_street', new sfValidatorString(array('required' => true), array('required' => "Podaj ulicę")));
                 $this->form->setValidator('company_home_nr', new sfValidatorString(array('required' => true), array('required' => "Podaj numer domu")));
                  $this->form->setValidator('company_nip', new sfValidatorString(array('required' => true), array('required' => "Podaj nip")));
                   $this->form->setValidator('company_post_code', new sfValidatorString(array('required' => true),array('required' => "Podaj kod pocztowy")));
                    $this->form->setValidator('company_city', new sfValidatorString(array('required' => true),array('required' => "Podaj kod pocztowy")));
            }

        
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid())
            {
                //$this->redirect('contact/thankyou?'.http_build_query($this->form->getValues()));
                $this->form->save();
                $this->redirect('user/info');
            }
        }


        
      }
  }

  public function  executeLogout(sfWebRequest $request)
  {

      $this->getUser()->setAttribute('user', null);
      $this->getUser()->setAttribute('package_dimension',null);

      $this->redirect('shipping/calculate');

   }


   public function executeShippings(sfWebRequest $request)
   {
       $user = $this->getUser()->getAttribute('user', null);
       if($user)
       {
           $c = new Criteria();
           $c->add(OrderShippingPeer::USER_ID, $user->getId());
           $c->addDescendingOrderByColumn(OrderShippingPeer::CREATED_AT);
           $c->addJoin(OrderShippingPeer::COURIER_ID, CourierPeer::ID);
           $c->addJoin(OrderShippingPeer::ID, OrderShippingSenderPeer::ORDER_ID);
           $c->addJoin(OrderShippingPeer::ID, OrderShippingRecipientPeer::ORDER_ID);
           $this->orders = OrderShippingPeer::doSelectJoinAll($c);

           $pager = new sfPropelPager('OrderShipping', 40);
           $pager->setCriteria($c);
            $pager->setPage($this->getRequestParameter('page', 1));
            $pager->init();
        $this->pager = $pager;
       }


   }
   public function executeShowOrder(sfWebRequest $request)
  {
      $user = $this->getUser()->getAttribute('user', null);
       if($user)
       {
           $c = new Criteria();
           $c->add(OrderShippingPeer::USER_ID, $user->getId());
           $c->add(OrderShippingPeer::ID, $request->getParameter('id'));

           $this->order = OrderShippingPeer::doSelectOne($c);

           if(!$this->order)
               $this->redirect('user/shippings');
       }
       else
       {
           $this->redirect('shipping/calculate');

       }

  }

  public function executeSearchSenderAjax($request)
{
  $this->getResponse()->setContentType('application/json');
  $user = $this->getUser()->getAttribute('user', null);
  $authors = UserSenderPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'), $user->GetId());

  return $this->renderText(json_encode($authors));
}

 public function executeSearchRecipientAjax($request)
{
  $this->getResponse()->setContentType('application/json');
   $user = $this->getUser()->getAttribute('user', null);
  $authors = UserRecipientPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'), $user->GetId());

  return $this->renderText(json_encode($authors));
}

public function executeAutocomplete(sfWebRequest $request)
{
   
}

public function executeFindSender(sfWebRequest $request)
{
    //$this->setLayout(false);
     $this->getResponse()->setContentType('application/json');
    $cities = array(
	array('city'=>'New York', 'state'=>'NY', 'zip'=>'10001'),
	array('city'=>'Los Angeles', 'state'=>'CA', 'zip'=>'90001'),
	array('city'=>'Chicago', 'state'=>'IL', 'zip'=>'60601'),
	array('city'=>'Houston', 'state'=>'TX', 'zip'=>'77001'),
	array('city'=>'Phoenix', 'state'=>'AZ', 'zip'=>'85001'),
	array('city'=>'Philadelphia', 'state'=>'PA','zip'=>'19019'),
	array('city'=>'San Antonio', 'state'=>'TX', 'zip'=>'78201'),
	array('city'=>'Dallas', 'state'=>'TX', 'zip'=>'75201'),
	array('city'=>'San Diego', 'state'=>'CA', 'zip'=>'92101'),
	array('city'=>'San Jose', 'state'=>'CA', 'zip'=>'95101'),
	array('city'=>'Detroit', 'state'=>'MI', 'zip'=>'48201'),
	array('city'=>'San Francisco', 'state'=>'CA', 'zip'=>'94101'),
	array('city'=>'Jacksonville', 'state'=>'FL', 'zip'=>'32099'),
	array('city'=>'Indianapolis', 'state'=>'IN', 'zip'=>'46201'),
	array('city'=>'Austin', 'state'=>'TX', 'zip'=>'73301'),
	array('city'=>'Columbus', 'state'=>'OH', 'zip'=>'43085'),
	array('city'=>'Fort Worth', 'state'=>'TX', 'zip'=>'76101'),
	array('city'=>'Charlotte', 'state'=>'NC', 'zip'=>'28201'),
	array('city'=>'Memphis', 'state'=>'TN', 'zip'=>'37501'),
	array('city'=>'Baltimore', 'state'=>'MD', 'zip'=>'21201'),
);

// Cleaning up the term
$term = trim(strip_tags($request->getParameter('t')));

// Rudimentary search
$matches = array();
foreach($cities as $city){
	//if(stripos($city['city'], $term) !== false){
		// Add the necessary "value" and "label" fields and append to result set
		$city['value'] = $city['city'];
		$city['label'] = "{$city['city']}, {$city['state']} {$city['zip']}";
		$matches[] = $city;
	//}
}

// Truncate, encode and return the results
$matches = array_slice($cities, 0, 5);
     return $this->renderText(json_encode($matches));
}


}
