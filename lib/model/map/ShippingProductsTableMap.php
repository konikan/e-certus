<?php


/**
 * This class defines the structure of the 'shipping_products' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Oct 18 23:48:16 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ShippingProductsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ShippingProductsTableMap';

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
		$this->setName('shipping_products');
		$this->setPhpName('ShippingProducts');
		$this->setClassname('ShippingProducts');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('GROUP_ID', 'GroupId', 'INTEGER', 'shipping_prices_groups', 'ID', false, null, null);
		$this->addForeignKey('PACKAGING_TYPE_ID', 'PackagingTypeId', 'INTEGER', 'packaging_types', 'ID', false, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('WEIGHT_FROM', 'WeightFrom', 'DECIMAL', false, 10, null);
		$this->addColumn('WEIGHT_TO', 'WeightTo', 'DECIMAL', false, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ShippingPricesGroups', 'ShippingPricesGroups', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), null, null);
    $this->addRelation('PackagingTypes', 'PackagingTypes', RelationMap::MANY_TO_ONE, array('packaging_type_id' => 'id', ), null, null);
    $this->addRelation('ShippingPrices', 'ShippingPrices', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null);
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

} // ShippingProductsTableMap
