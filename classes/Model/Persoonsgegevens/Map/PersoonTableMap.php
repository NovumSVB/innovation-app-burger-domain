<?php

namespace Model\Custom\NovumBurger\Persoonsgegevens\Map;

use Model\Custom\NovumBurger\Persoonsgegevens\Persoon;
use Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'persoon' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersoonTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Custom.NovumBurger.Persoonsgegevens.Map.PersoonTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'hurah';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'persoon';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Custom.NovumBurger.Persoonsgegevens.Persoon';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id field
     */
    const COL_ID = 'persoon.id';

    /**
     * the column name for the bsn field
     */
    const COL_BSN = 'persoon.bsn';

    /**
     * the column name for the infix field
     */
    const COL_INFIX = 'persoon.infix';

    /**
     * the column name for the voornaam field
     */
    const COL_VOORNAAM = 'persoon.voornaam';

    /**
     * the column name for the achternaam field
     */
    const COL_ACHTERNAAM = 'persoon.achternaam';

    /**
     * the column name for the vader_id field
     */
    const COL_VADER_ID = 'persoon.vader_id';

    /**
     * the column name for the moeder_id field
     */
    const COL_MOEDER_ID = 'persoon.moeder_id';

    /**
     * the column name for the geslacht_id field
     */
    const COL_GESLACHT_ID = 'persoon.geslacht_id';

    /**
     * the column name for the geboorte_datum field
     */
    const COL_GEBOORTE_DATUM = 'persoon.geboorte_datum';

    /**
     * the column name for the geboorte_plaats field
     */
    const COL_GEBOORTE_PLAATS = 'persoon.geboorte_plaats';

    /**
     * the column name for the geboorte_land_id field
     */
    const COL_GEBOORTE_LAND_ID = 'persoon.geboorte_land_id';

    /**
     * the column name for the immigratie_datum field
     */
    const COL_IMMIGRATIE_DATUM = 'persoon.immigratie_datum';

    /**
     * the column name for the heeft_nl_paspoort field
     */
    const COL_HEEFT_NL_PASPOORT = 'persoon.heeft_nl_paspoort';

    /**
     * the column name for the sterf_datum field
     */
    const COL_STERF_DATUM = 'persoon.sterf_datum';

    /**
     * the column name for the sterf_plaats field
     */
    const COL_STERF_PLAATS = 'persoon.sterf_plaats';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'persoon.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'persoon.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Bsn', 'Infix', 'Voornaam', 'Achternaam', 'Vader', 'Moeder', 'GeslachtId', 'GeboorteDatum', 'GeboortePlaats', 'GeboorteLand', 'Immigratiedatum', 'HeeftNederlandsPaspoort', 'SterfDatum', 'SterfPlaats', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'bsn', 'infix', 'voornaam', 'achternaam', 'vader', 'moeder', 'geslachtId', 'geboorteDatum', 'geboortePlaats', 'geboorteLand', 'immigratiedatum', 'heeftNederlandsPaspoort', 'sterfDatum', 'sterfPlaats', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PersoonTableMap::COL_ID, PersoonTableMap::COL_BSN, PersoonTableMap::COL_INFIX, PersoonTableMap::COL_VOORNAAM, PersoonTableMap::COL_ACHTERNAAM, PersoonTableMap::COL_VADER_ID, PersoonTableMap::COL_MOEDER_ID, PersoonTableMap::COL_GESLACHT_ID, PersoonTableMap::COL_GEBOORTE_DATUM, PersoonTableMap::COL_GEBOORTE_PLAATS, PersoonTableMap::COL_GEBOORTE_LAND_ID, PersoonTableMap::COL_IMMIGRATIE_DATUM, PersoonTableMap::COL_HEEFT_NL_PASPOORT, PersoonTableMap::COL_STERF_DATUM, PersoonTableMap::COL_STERF_PLAATS, PersoonTableMap::COL_CREATED_AT, PersoonTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'bsn', 'infix', 'voornaam', 'achternaam', 'vader_id', 'moeder_id', 'geslacht_id', 'geboorte_datum', 'geboorte_plaats', 'geboorte_land_id', 'immigratie_datum', 'heeft_nl_paspoort', 'sterf_datum', 'sterf_plaats', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Bsn' => 1, 'Infix' => 2, 'Voornaam' => 3, 'Achternaam' => 4, 'Vader' => 5, 'Moeder' => 6, 'GeslachtId' => 7, 'GeboorteDatum' => 8, 'GeboortePlaats' => 9, 'GeboorteLand' => 10, 'Immigratiedatum' => 11, 'HeeftNederlandsPaspoort' => 12, 'SterfDatum' => 13, 'SterfPlaats' => 14, 'CreatedAt' => 15, 'UpdatedAt' => 16, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'bsn' => 1, 'infix' => 2, 'voornaam' => 3, 'achternaam' => 4, 'vader' => 5, 'moeder' => 6, 'geslachtId' => 7, 'geboorteDatum' => 8, 'geboortePlaats' => 9, 'geboorteLand' => 10, 'immigratiedatum' => 11, 'heeftNederlandsPaspoort' => 12, 'sterfDatum' => 13, 'sterfPlaats' => 14, 'createdAt' => 15, 'updatedAt' => 16, ),
        self::TYPE_COLNAME       => array(PersoonTableMap::COL_ID => 0, PersoonTableMap::COL_BSN => 1, PersoonTableMap::COL_INFIX => 2, PersoonTableMap::COL_VOORNAAM => 3, PersoonTableMap::COL_ACHTERNAAM => 4, PersoonTableMap::COL_VADER_ID => 5, PersoonTableMap::COL_MOEDER_ID => 6, PersoonTableMap::COL_GESLACHT_ID => 7, PersoonTableMap::COL_GEBOORTE_DATUM => 8, PersoonTableMap::COL_GEBOORTE_PLAATS => 9, PersoonTableMap::COL_GEBOORTE_LAND_ID => 10, PersoonTableMap::COL_IMMIGRATIE_DATUM => 11, PersoonTableMap::COL_HEEFT_NL_PASPOORT => 12, PersoonTableMap::COL_STERF_DATUM => 13, PersoonTableMap::COL_STERF_PLAATS => 14, PersoonTableMap::COL_CREATED_AT => 15, PersoonTableMap::COL_UPDATED_AT => 16, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'bsn' => 1, 'infix' => 2, 'voornaam' => 3, 'achternaam' => 4, 'vader_id' => 5, 'moeder_id' => 6, 'geslacht_id' => 7, 'geboorte_datum' => 8, 'geboorte_plaats' => 9, 'geboorte_land_id' => 10, 'immigratie_datum' => 11, 'heeft_nl_paspoort' => 12, 'sterf_datum' => 13, 'sterf_plaats' => 14, 'created_at' => 15, 'updated_at' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('persoon');
        $this->setPhpName('Persoon');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon');
        $this->setPackage('Model.Custom.NovumBurger.Persoonsgegevens');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('bsn', 'Bsn', 'VARCHAR', true, 255, null);
        $this->addColumn('infix', 'Infix', 'VARCHAR', false, 255, null);
        $this->addColumn('voornaam', 'Voornaam', 'VARCHAR', true, 255, null);
        $this->addColumn('achternaam', 'Achternaam', 'VARCHAR', true, 255, null);
        $this->addForeignKey('vader_id', 'Vader', 'INTEGER', 'persoon', 'id', false, null, null);
        $this->addForeignKey('moeder_id', 'Moeder', 'INTEGER', 'persoon', 'id', false, null, null);
        $this->addForeignKey('geslacht_id', 'GeslachtId', 'INTEGER', 'geslacht', 'id', true, null, null);
        $this->addColumn('geboorte_datum', 'GeboorteDatum', 'DATE', true, null, null);
        $this->addColumn('geboorte_plaats', 'GeboortePlaats', 'VARCHAR', false, 255, null);
        $this->addForeignKey('geboorte_land_id', 'GeboorteLand', 'INTEGER', 'land', 'id', false, null, null);
        $this->addColumn('immigratie_datum', 'Immigratiedatum', 'DATE', false, null, null);
        $this->addColumn('heeft_nl_paspoort', 'HeeftNederlandsPaspoort', 'BOOLEAN', false, 1, null);
        $this->addColumn('sterf_datum', 'SterfDatum', 'DATE', false, null, null);
        $this->addColumn('sterf_plaats', 'SterfPlaats', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Land', '\\Model\\Custom\\NovumBurger\\Stam\\Land', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':geboorte_land_id',
    1 => ':id',
  ),
), 'RESTRICT', null, null, false);
        $this->addRelation('Geslacht', '\\Model\\Custom\\NovumBurger\\Stam\\Geslacht', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':geslacht_id',
    1 => ':id',
  ),
), 'RESTRICT', null, null, false);
        $this->addRelation('FkVader', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':vader_id',
    1 => ':id',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('FkMoeder', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':moeder_id',
    1 => ':id',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('PersoonRelatedById0', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':vader_id',
    1 => ':id',
  ),
), 'SET NULL', null, 'PersoonsRelatedById0', false);
        $this->addRelation('PersoonRelatedById1', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':moeder_id',
    1 => ':id',
  ),
), 'SET NULL', null, 'PersoonsRelatedById1', false);
        $this->addRelation('Persoon_relatie', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon_relatie', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':persoon_id',
    1 => ':id',
  ),
), 'RESTRICT', null, 'Persoon_relaties', false);
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to persoon     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        PersoonTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PersoonTableMap::CLASS_DEFAULT : PersoonTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Persoon object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersoonTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersoonTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersoonTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersoonTableMap::OM_CLASS;
            /** @var Persoon $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersoonTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PersoonTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersoonTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Persoon $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersoonTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PersoonTableMap::COL_ID);
            $criteria->addSelectColumn(PersoonTableMap::COL_BSN);
            $criteria->addSelectColumn(PersoonTableMap::COL_INFIX);
            $criteria->addSelectColumn(PersoonTableMap::COL_VOORNAAM);
            $criteria->addSelectColumn(PersoonTableMap::COL_ACHTERNAAM);
            $criteria->addSelectColumn(PersoonTableMap::COL_VADER_ID);
            $criteria->addSelectColumn(PersoonTableMap::COL_MOEDER_ID);
            $criteria->addSelectColumn(PersoonTableMap::COL_GESLACHT_ID);
            $criteria->addSelectColumn(PersoonTableMap::COL_GEBOORTE_DATUM);
            $criteria->addSelectColumn(PersoonTableMap::COL_GEBOORTE_PLAATS);
            $criteria->addSelectColumn(PersoonTableMap::COL_GEBOORTE_LAND_ID);
            $criteria->addSelectColumn(PersoonTableMap::COL_IMMIGRATIE_DATUM);
            $criteria->addSelectColumn(PersoonTableMap::COL_HEEFT_NL_PASPOORT);
            $criteria->addSelectColumn(PersoonTableMap::COL_STERF_DATUM);
            $criteria->addSelectColumn(PersoonTableMap::COL_STERF_PLAATS);
            $criteria->addSelectColumn(PersoonTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PersoonTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.bsn');
            $criteria->addSelectColumn($alias . '.infix');
            $criteria->addSelectColumn($alias . '.voornaam');
            $criteria->addSelectColumn($alias . '.achternaam');
            $criteria->addSelectColumn($alias . '.vader_id');
            $criteria->addSelectColumn($alias . '.moeder_id');
            $criteria->addSelectColumn($alias . '.geslacht_id');
            $criteria->addSelectColumn($alias . '.geboorte_datum');
            $criteria->addSelectColumn($alias . '.geboorte_plaats');
            $criteria->addSelectColumn($alias . '.geboorte_land_id');
            $criteria->addSelectColumn($alias . '.immigratie_datum');
            $criteria->addSelectColumn($alias . '.heeft_nl_paspoort');
            $criteria->addSelectColumn($alias . '.sterf_datum');
            $criteria->addSelectColumn($alias . '.sterf_plaats');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PersoonTableMap::DATABASE_NAME)->getTable(PersoonTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersoonTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersoonTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersoonTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Persoon or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Persoon object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersoonTableMap::DATABASE_NAME);
            $criteria->add(PersoonTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PersoonQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersoonTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersoonTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the persoon table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersoonQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Persoon or Criteria object.
     *
     * @param mixed               $criteria Criteria or Persoon object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Persoon object
        }

        if ($criteria->containsKey(PersoonTableMap::COL_ID) && $criteria->keyContainsValue(PersoonTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersoonTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PersoonQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersoonTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersoonTableMap::buildTableMap();
