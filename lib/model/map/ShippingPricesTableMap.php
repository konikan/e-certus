<?php


/**
 * This class defines the structure of the 'shipping_prices' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Oct 18 23:48:17 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ShippingPricesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ShippingPricesTableMap';

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
		$this->setName('shipping_prices');
		$this->setPhpName('ShippingPrices');
		$this->setClassname('ShippingPrices');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('COURIER_ID', 'CourierId', 'INTEGER', 'courier', 'ID', true, null, null);
		$this->addForeignKey('PRODUCT_ID', 'ProductId', 'INTEGER', 'shipping_products', 'ID', true, null, null);
		$this->addColumn('SERVICE_ID', 'ServiceId', 'VARCHAR', false, 255, null);
		$this->addColumn('PRICE', 'Price', 'DECIMAL', false, 10, null);
		$this->addColumn('PROM_PRICE', 'PromPrice', 'DECIMAL', false, 10, null);
		$this->addColumn('IS_DYNAMIC_PRICE', 'IsDynamicPrice', 'BOOLEAN', false, null, false);
		$this->addColumn('DYNAMIC_PRICE', 'DynamicPrice', 'DECIMAL', false, 10, null);
		$this->addColumn('DYNAMIC_PRICE_WHAT_IF', 'DynamicPriceWhatIf', 'DECIMAL', false, 10, 50);
		$this->addColumn('SHOW', 'Show', 'BOOLEAN', false, null, true);
		$this->addColumn('IS_DEFAULT', 'IsDefault', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_PROM', 'IsProm', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_AVAILABLE', 'IsAvailable', 'BOOLEAN', false, null, true);
		$this->addColumn('NOTICE', 'Notice', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Courier', 'Courier', RelationMap::MANY_TO_ONE, array('courier_id' => 'id', ), null, null);
    $this->addRelation('ShippingProducts', 'ShippingProducts', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), null, null);
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

} // ShippingPricesTableMap