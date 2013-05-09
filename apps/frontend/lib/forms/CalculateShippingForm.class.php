<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateShippingForms
 *
 * @author pawel
 */
class CalculateShippingForm extends BaseForm {
    //put your code here


    public function  configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Javascript');
        $package_dimension = sfContext::getInstance()->getUser()->getAttribute('package_dimension',null);

        if($package_dimension['typ'] == 1)
        {
        $this->widgetSchema['sel'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['sel'] = new sfValidatorPass();

        $this->widgetSchema['p_group'] = new sfWidgetFormInputHidden();

        $this->validatorSchema['p_group'] = new sfValidatorInteger(array('required' =>true));


        $this->widgetSchema->setNameFormat('calculate[%s]');

        $shipping_options   = ShippingOptionsPeer::doSelectJoinAll(new Criteria());
        $couriers = CourierPeer::getActiveCouriers();
       
        //echo $this->getValue('p_group');
        foreach ($couriers as $courier)
        {$weight = $courier->calculate_weight($package_dimension['wy'],$package_dimension['dl'],$package_dimension['sz'],$package_dimension['wg']);
             $shipping_types     =   ShippingTypesGroupsPeer::getGoupsAndActiveTypesByPGroup($package_dimension['r_wysylki'],$weight , $courier->getId());
            
            $options = array();
            $def_type = null;
            foreach ($shipping_types as $st)
            {
                
                if($st->getCourierId() == $courier->getId())
                {
                    $options[$st->getId()] = $st->getName();
                    if($st->getCode() == 'standard') $def_type = $st->getId();
                }
            }

            $this->widgetSchema[$courier->getName().'_type'] = new sfWidgetFormChoice(array('choices'=>$options, 'expanded'=>true),array());

            if(!is_null($def_type))
            {
                //echo $def_type
                $this->setDefault($courier->getName().'_type', $def_type);
            }

            $this->widgetSchema[$courier->getName().'_price'] = new sfWidgetFormInputHidden();
            $this->widgetSchema[$courier->getName().'_price_vat'] = new sfWidgetFormInputHidden();

            $this->validatorSchema[$courier->getName().'_type'] = new sfValidatorPass();
            $this->validatorSchema[$courier->getName().'_price'] = new sfValidatorPass();
            $this->validatorSchema[$courier->getName().'_price_vat'] = new sfValidatorPass();

            foreach ($shipping_options as $so)
            {
              
               if($so->getCourierId() == $courier->getId() )
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


}
?>
