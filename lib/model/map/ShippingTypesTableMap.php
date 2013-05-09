<?php


/**
 * This class defines the structure of the 'shipping_types' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:08
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ShippingTypesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ShippingTypesTableMap';

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
		$this->setName('shipping_types');
		$this->setPhpName('ShippingTypes');
		$this->setClassname('ShippingTypes');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('GROUP_ID', 'GroupId', 'INTEGER', 'shipping_types_groups', 'ID', true, null, null);
		$this->addForeignKey('PACKAGING_TYPE_ID', 'PackagingTypeId', 'INTEGER', 'packaging_types', 'ID', false, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('SHORT_NAME', 'ShortName', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('SHOW_IN_TARIFF', 'ShowInTariff', 'BOOLEAN', false, null, true);
		$this->addColumn('PRICE', 'Price', 'DECIMAL', false, 10, null);
		$this->addColumn('INITIAL_WEIGHT', 'InitialWeight', 'DECIMAL', true, 10, null);
		$this->addColumn('FINAL_WEIGHT', 'FinalWeight', 'DECIMAL', true, 10, null);
		$this->addColumn('IS_PROM', 'IsProm', 'BOOLEAN', false, null, false);
		$this->addColumn('PROM_PRICE', 'PromPrice', 'DECIMAL', false, 10, null);
		$this->addColumn('IS_DYNAMIC_PRICE', 'IsDynamicPrice', 'BOOLEAN', false, null, false);
		$this->addColumn('DYNAMIC_PRICE', 'DynamicPrice', 'DECIMAL', false, 10, null);
		$this->addColumn('DYNAMIC_PRICE_WHAT_IF', 'DynamicPriceWhatIf', 'DECIMAL', false, 10, 50);
		$this->addColumn('SHOW', 'Show', 'BOOLEAN', false, null, true);
		$this->addColumn('IS_INTERNATIONAL', 'IsInternational', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_AVAILABLE', 'IsAvailable', 'BOOLEAN', false, null, true);
		$this->addColumn('NOTICE', 'Notice', 'LONGVARCHAR', false, null, null);
		$this->addForeignKey('COUNTRY_ID', 'CountryId', 'INTEGER', 'countries', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ShippingTypesGroups', 'ShippingTypesGroups', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('PackagingTypes', 'PackagingTypes', RelationMap::MANY_TO_ONE, array('packaging_type_id' => 'id', ), 'SET NULL', null);
    $this->addRelation('Countries', 'Countries', RelationMap::MANY_TO_ONE, array('country_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('OrderShipping', 'OrderShipping', RelationMap::ONE_TO_MANY, array('id' => 'type_id', ), null, null);
    $this->addRelation('Discounts', 'Discounts', RelationMap::ONE_TO_MANY, array('id' => 'type_id', ), null, null);
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

} // ShippingTypesTableMap
