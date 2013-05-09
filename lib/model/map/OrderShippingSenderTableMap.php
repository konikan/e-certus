<?php


/**
 * This class defines the structure of the 'order_shipping_sender' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:06
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class OrderShippingSenderTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OrderShippingSenderTableMap';

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
		$this->setName('order_shipping_sender');
		$this->setPhpName('OrderShippingSender');
		$this->setClassname('OrderShippingSender');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('IS_COMPANY', 'IsCompany', 'TINYINT', false, 1, null);
		$this->addColumn('SENDER_NAME', 'SenderName', 'VARCHAR', true, 255, null);
		$this->addColumn('CONTACT_NAME', 'ContactName', 'VARCHAR', false, 255, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('SURNAME', 'Surname', 'VARCHAR', false, 255, null);
		$this->addColumn('POSTCODE', 'Postcode', 'VARCHAR', false, 255, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 255, null);
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 10, 'pl');
		$this->addColumn('STREET', 'Street', 'VARCHAR', false, 255, null);
		$this->addColumn('STREET_NR', 'StreetNr', 'VARCHAR', false, 10, null);
		$this->addColumn('LOCAL_NR', 'LocalNr', 'VARCHAR', false, 10, null);
		$this->addColumn('TEL', 'Tel', 'VARCHAR', false, 255, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 255, null);
		$this->addColumn('BANK_NAME', 'BankName', 'VARCHAR', false, 255, null);
		$this->addColumn('BANK_ACCOUNT', 'BankAccount', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_NAME', 'CompanyName', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_NIP', 'CompanyNip', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_POST_CODE', 'CompanyPostCode', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_CITY', 'CompanyCity', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_STREET', 'CompanyStreet', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_HOME_NR', 'CompanyHomeNr', 'VARCHAR', false, 10, null);
		$this->addColumn('COMPANY_LOCAL_NR', 'CompanyLocalNr', 'VARCHAR', false, 10, null);
		$this->addForeignKey('ORDER_ID', 'OrderId', 'INTEGER', 'order_shipping', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('OrderShipping', 'OrderShipping', RelationMap::MANY_TO_ONE, array('order_id' => 'id', ), 'CASCADE', null);
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

} // OrderShippingSenderTableMap
