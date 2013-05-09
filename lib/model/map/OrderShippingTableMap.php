<?php


/**
 * This class defines the structure of the 'order_shipping' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:05
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class OrderShippingTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OrderShippingTableMap';

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
		$this->setName('order_shipping');
		$this->setPhpName('OrderShipping');
		$this->setClassname('OrderShipping');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'users', 'ID', false, null, null);
		$this->addColumn('IS_INTERNATIONAL', 'IsInternational', 'BOOLEAN', false, null, false);
		$this->addColumn('NUMBER', 'Number', 'VARCHAR', false, 255, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('STATUS', 'Status', 'VARCHAR', false, 255, null);
		$this->addColumn('OUTHER_ORDER_NUMBER', 'OutherOrderNumber', 'VARCHAR', false, 255, null);
		$this->addColumn('LIST_NUMBER', 'ListNumber', 'VARCHAR', false, 255, null);
		$this->addForeignKey('COURIER_ID', 'CourierId', 'INTEGER', 'courier', 'ID', false, null, null);
		$this->addColumn('WIDTH', 'Width', 'DECIMAL', false, 10, null);
		$this->addColumn('HEIGHT', 'Height', 'DECIMAL', false, 10, null);
		$this->addColumn('LENGTH', 'Length', 'DECIMAL', false, 10, null);
		$this->addColumn('NORMAL_WEIGHT', 'NormalWeight', 'DECIMAL', false, 10, null);
		$this->addColumn('WEIGHT', 'Weight', 'DECIMAL', false, 10, null);
		$this->addForeignKey('TYPE_ID', 'TypeId', 'INTEGER', 'shipping_types', 'ID', false, null, null);
		$this->addForeignKey('ZONE_ID', 'ZoneId', 'INTEGER', 'zones', 'ID', false, null, null);
		$this->addForeignKey('COUNTRY_ID', 'CountryId', 'INTEGER', 'countries', 'ID', false, null, null);
		$this->addForeignKey('PACKAGING_TYPE_ID', 'PackagingTypeId', 'INTEGER', 'packaging_types', 'ID', false, null, null);
		$this->addColumn('DATE_OF_RECEIPT', 'DateOfReceipt', 'DATE', false, null, null);
		$this->addColumn('RECEIPT_TIME_START', 'ReceiptTimeStart', 'TIME', false, null, null);
		$this->addColumn('RECEIPT_TIME_END', 'ReceiptTimeEnd', 'TIME', false, null, null);
		$this->addColumn('SELF_GIVING', 'SelfGiving', 'BOOLEAN', false, null, false);
		$this->addColumn('SELF_GIVING_DATE', 'SelfGivingDate', 'DATE', false, null, null);
		$this->addColumn('IS_PAID', 'IsPaid', 'BOOLEAN', false, null, false);
		$this->addColumn('PAID_TYPE', 'PaidType', 'INTEGER', false, null, null);
		$this->addColumn('NUMBER_OF_PACKAGES', 'NumberOfPackages', 'INTEGER', false, null, null);
		$this->addColumn('AMOUNT', 'Amount', 'DECIMAL', false, 10, null);
		$this->addColumn('VAT', 'Vat', 'DECIMAL', false, 4, null);
		$this->addColumn('VAT_AMOUNT', 'VatAmount', 'DECIMAL', false, 10, null);
		$this->addColumn('TOTAL_AMOUNT', 'TotalAmount', 'DECIMAL', false, 10, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Users', 'Users', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'SET NULL', null);
    $this->addRelation('Courier', 'Courier', RelationMap::MANY_TO_ONE, array('courier_id' => 'id', ), 'SET NULL', null);
    $this->addRelation('ShippingTypes', 'ShippingTypes', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
    $this->addRelation('Zones', 'Zones', RelationMap::MANY_TO_ONE, array('zone_id' => 'id', ), null, null);
    $this->addRelation('Countries', 'Countries', RelationMap::MANY_TO_ONE, array('country_id' => 'id', ), 'SET NULL', null);
    $this->addRelation('PackagingTypes', 'PackagingTypes', RelationMap::MANY_TO_ONE, array('packaging_type_id' => 'id', ), 'SET NULL', null);
    $this->addRelation('OrderShippingOptions', 'OrderShippingOptions', RelationMap::ONE_TO_MANY, array('id' => 'order_id', ), null, null);
    $this->addRelation('OrderShippingZonesServices', 'OrderShippingZonesServices', RelationMap::ONE_TO_MANY, array('id' => 'order_id', ), null, null);
    $this->addRelation('OrderShippingSender', 'OrderShippingSender', RelationMap::ONE_TO_MANY, array('id' => 'order_id', ), 'CASCADE', null);
    $this->addRelation('OrderShippingRecipient', 'OrderShippingRecipient', RelationMap::ONE_TO_MANY, array('id' => 'order_id', ), null, null);
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // OrderShippingTableMap