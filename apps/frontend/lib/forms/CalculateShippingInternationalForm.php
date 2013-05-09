<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateShippingInternationalForm
 *
 * @author Pawel
 */
class CalculateShippingInternationalForm  extends BaseForm {

     public function  configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Javascript');
        $package_dimension = sfContext::getInstance()->getUser()->getAttribute('package_dimension',null);
        $couriers = CourierPeer::getInternationalCouriers();
        $this->widgetSchema['sel'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['sel'] = new sfValidatorPass();
        $this->widgetSchema->setNameFormat('calculate[%s]');
        foreach ($couriers as $courier)
        {
             $weight = $courier->calculate_weight($package_dimension['wy'],$package_dimension['dl'],$package_dimension['sz'],$package_dimension['wg']);

             $this->widgetSchema[$courier->getName().'_price'] = new sfWidgetFormInputHidden();
            $this->widgetSchema[$courier->getName().'_price_vat'] = new sfWidgetFormInputHidden();

          
            $this->validatorSchema[$courier->getName().'_price'] = new sfValidatorPass();
            $this->validatorSchema[$courier->getName().'_price_vat'] = new sfValidatorPass();
            $zone_price = ZonesPricesPeer::getPriceByWeight($courier->getId(), $weight, $package_dimension['kraj']);
            if(is_object($zone_price))
            {
                $shipping_options = ZonesServicesPeer::getServicesByCourier($courier->getId(), $zone_price->getZoneId());


                foreach ($shipping_options as $so)
                {

                   
                       $this->widgetSchema[$courier->getName().'_option_'.$so->getId()] = new sfWidgetFormInputCheckbox();
                       $this->widgetSchema[$courier->getName().'_option_'.$so->getId()]->setLabel($so->getName());
                       $this->validatorSchema[$courier->getName().'_option_'.$so->getId()] = new sfValidatorPass();
                       if($so->getAdditionalAmount())
                       {
                           $this->widgetSchema[$courier->getName().'_option_'.$so->getId().'_amount'] = new sfWidgetFormInput();
                           $this->validatorSchema[$courier->getName().'_option_'.$so->getId().'_amount'] = new sfValidatorPass();
                           if($so->getCashOnDelivery())
                           {
                              $this->widgetSchema[$courier->getName().'_option_'.$so->getId().'_amount']->setLabel('Kwota');
                           }
                       }
                   
                }
            }
        }
       }
     
}
?>
