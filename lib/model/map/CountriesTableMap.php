<?php


/**
 * This class defines the structure of the 'countries' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:09
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class CountriesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CountriesTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('countries');
		$this->setPhpName('Countries');
		$this->setClassname('Countries');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, '');
		$this->addColumn('SHORT', 'Short', 'VARCHAR', true, 255, '');
		$this->addColumn('CURRENCY', 'Currency', 'VARCHAR', true, 255, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('OrderShipping', 'OrderShipping', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'SET NULL', null);
    $this->addRelation('ShippingTypes', 'ShippingTypes', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', null);
    $this->addRelation('ShippingOptions', 'ShippingOptions', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', null);
    $this->addRelation('ZonesCountries', 'ZonesCountries', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // CountriesTableMap
