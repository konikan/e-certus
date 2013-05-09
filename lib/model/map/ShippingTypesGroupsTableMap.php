<?php


/**
 * This class defines the structure of the 'shipping_types_groups' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/15/11 12:03:07
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ShippingTypesGroupsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ShippingTypesGroupsTableMap';

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
		$this->setName('shipping_types_groups');
		$this->setPhpName('ShippingTypesGroups');
		$this->setClassname('ShippingTypesGroups');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('COURIER_ID', 'CourierId', 'INTEGER', 'courier', 'ID', true, null, null);
		$this->addColumn('SERVICE_ID', 'ServiceId', 'VARCHAR', false, 255, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('NAME_TARIFF', 'NameTariff', 'VARCHAR', false, 255, null);
		$this->addColumn('SHORT_NAME', 'ShortName', 'VARCHAR', false, 255, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', true, 255, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('TYPE', 'Type', 'TINYINT', false, 2, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Courier', 'Courier', RelationMap::MANY_TO_ONE, array('courier_id' => 'id', ), null, null);
    $this->addRelation('ShippingTypes', 'ShippingTypes', RelationMap::ONE_TO_MANY, array('id' => 'group_id', ), 'CASCADE', null);
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

} // ShippingTypesGroupsTableMap