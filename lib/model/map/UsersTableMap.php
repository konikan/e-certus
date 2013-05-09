<?php


/**
 * This class defines the structure of the 'users' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:03
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsersTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsersTableMap';

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
		$this->setName('users');
		$this->setPhpName('Users');
		$this->setClassname('Users');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ACTIVITY', 'Activity', 'BOOLEAN', false, null, false);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 255, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 255, null);
		$this->addColumn('PASSWORD_ASK', 'PasswordAsk', 'VARCHAR', false, 255, null);
		$this->addColumn('PASSWORD_REP', 'PasswordRep', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_COMPANY', 'IsCompany', 'BOOLEAN', false, null, true);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('SURNAME', 'Surname', 'VARCHAR', false, 255, null);
		$this->addColumn('POSTCODE', 'Postcode', 'VARCHAR', false, 255, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 255, null);
		$this->addColumn('STREET', 'Street', 'VARCHAR', false, 255, null);
		$this->addColumn('STREET_NR', 'StreetNr', 'VARCHAR', false, 10, null);
		$this->addColumn('LOCAL_NR', 'LocalNr', 'VARCHAR', false, 10, null);
		$this->addColumn('TEL', 'Tel', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_NAME', 'CompanyName', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_NIP', 'CompanyNip', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_POST_CODE', 'CompanyPostCode', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_CITY', 'CompanyCity', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_STREET', 'CompanyStreet', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANY_HOME_NR', 'CompanyHomeNr', 'VARCHAR', false, 10, null);
		$this->addColumn('COMPANY_LOCAL_NR', 'CompanyLocalNr', 'VARCHAR', false, 10, null);
		$this->addColumn('BANK_NAME', 'BankName', 'VARCHAR', false, 255, null);
		$this->addColumn('BANK_ACCOUNT', 'BankAccount', 'VARCHAR', false, 255, null);
		$this->addColumn('BLOCKED', 'Blocked', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_CASH_ON_DELIVERY', 'IsCashOnDelivery', 'BOOLEAN', false, null, false);
		$this->addColumn('PREPAID_BALANCE', 'PrepaidBalance', 'DECIMAL', false, 10, null);
		$this->addColumn('IS_PREPAID', 'IsPrepaid', 'BOOLEAN', false, null, false);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('OrderShipping', 'OrderShipping', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'SET NULL', null);
    $this->addRelation('UserRecipient', 'UserRecipient', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('UserSender', 'UserSender', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('Discounts', 'Discounts', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
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

} // UsersTableMap