<?php


/**
 * Skeleton subclass for performing query and update operations on the 'zones_services' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/13/11 20:49:22
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ZonesServicesPeer extends BaseZonesServicesPeer {
    
    public static function getServicesByCourier($courier_id, $zone_id)
    {
        $c = new Criteria();
        $c->addJoin(ZonesServicesPeer::ZONE_ID, ZonesPeer::ID);
        $c->add(ZonesPeer::COURIER_ID, $courier_id);
        $c->add(ZonesPeer::ID, $zone_id);
        
        
        return ZonesServicesPeer::doSelectJoinAll($c);
    }

} // ZonesServicesPeer
