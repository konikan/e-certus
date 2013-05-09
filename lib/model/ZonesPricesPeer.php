<?php


/**
 * Skeleton subclass for performing query and update operations on the 'zones_prices' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/12/11 12:50:49
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ZonesPricesPeer extends BaseZonesPricesPeer {
    
    public static function getPriceByWeight($courier_id, $weight, $country)
    {
        $c = new Criteria();
        $c->addJoin(ZonesPeer::ID, ZonesPricesPeer::ZONE_ID);
        $c->add(ZonesPeer::COURIER_ID, $courier_id);
        $c->add(ZonesPricesPeer::INITIAL_WEIGHT, $weight, Criteria::LESS_EQUAL);
        $c->add(ZonesPricesPeer::FINAL_WEIGHT, $weight, Criteria::GREATER_EQUAL);
        $c->addJoin(ZonesPeer::ID, ZonesCountriesPeer::ZONE_ID);
        $c->add(ZonesCountriesPeer::COUNTRY_ID, $country);
        
        
        return ZonesPricesPeer::doSelectOne($c);
    }
} // ZonesPricesPeer