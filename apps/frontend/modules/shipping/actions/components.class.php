<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class shippingComponents extends sfComponents
{
    public function  executeShippingInfo($request) {
      $package_dimension = $this->getUser()->getAttribute('package_dimension',null);
      $this->package_dimension = $package_dimension;
      $this->r_wysylki = PackagingGroupsPeer::retrieveByPK($package_dimension['r_wysylki']);

      $calculate_values = $this->getUser()->getAttribute('calculate_values',null);
      $this->calculate_values = $calculate_values;
      if(isset($calculate_values['sel']) && $calculate_values['sel'] != "")
      {
          $this->courier = CourierPeer::retrieveByPK($calculate_values['sel']);
          $weight=$this->calculate_weight($package_dimension['wy'], $package_dimension['dl'], $package_dimension['sz'], $package_dimension['wg'], $this->courier->getName());
          $this->type = $this->getPriceForWeight($weight,$calculate_values[$this->courier->getName().'_type'],$package_dimension['r_wysylki']);
           $this->options = array();
          $this->shipping_options   = ShippingOptionsPeer::doSelect(new Criteria());
           foreach ($this->shipping_options as $so)
          {


                if(isset($calculate_values[$this->courier->getName().'_option_'.$so->getId()]) && $calculate_values[$this->courier->getName().'_option_'.$so->getId()] == 'on' )
                {
                    //echo 'ok';
                    $this->options[] = $so;

                    if($so->getAdditionalAmount())
                    {
                        $this->options[$so->getId().'_amount'] = $calculate_values[$this->courier->getName().'_option_'.$so->getId().'_amount'];

                    }

                }
                else continue;

        }
    }
    }
    private function calculate_weight($wy=0,$dl=0,$sz=0,$wg=0,$courier="")
  {
      $res = 0.00;

      if(strtolower($courier) == 'ups')
      {
         $p_weight = ($wy*$dl*$sz)/5000;
         $p_weight = round($p_weight, 2);
         if($p_weight > $wg)
         {
             $res = $p_weight;
         }
         else
         {
             $res = $wg;
         }
      }
      else if(strtolower($courier) == 'dhl')
      {
         $p_weight = ($wy*$dl*$sz)/4000;
         $p_weight = round($p_weight, 2);
         if($p_weight > $wg)
         {
             $res = $p_weight;
         }
         else
         {
             $res = $wg;
         }
      }
      else
      {
          $res = $wg;

      }
      return number_format($res, 2, '.', ' ');
  }

  private function getPriceForWeight($weight, $group_id, $pack_group_id)
  {
      $weight = number_format($weight, 2, '.', ' ');
      $c = new Criteria();
      $c->add(ShippingTypesPeer::GROUP_ID,  $group_id);
      $c->add(ShippingTypesPeer::INITIAL_WEIGHT, $weight, Criteria::LESS_EQUAL);
      $c->add(ShippingTypesPeer::FINAL_WEIGHT, $weight, Criteria::GREATER_EQUAL);
      $c->addJoin(ShippingTypesPeer::PACKAGING_TYPE_ID, PackagingTypesPeer::ID);
      $c->add(PackagingTypesPeer::GROUP_ID, $pack_group_id);

      return ShippingTypesPeer::doSelectOne($c);
  }

}

?>
