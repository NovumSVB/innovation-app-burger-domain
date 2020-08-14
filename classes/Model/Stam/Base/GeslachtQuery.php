<?php

namespace Model\Custom\NovumBurger\Stam\Base;

use \Exception;
use \PDO;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon;
use Model\Custom\NovumBurger\Stam\Geslacht as ChildGeslacht;
use Model\Custom\NovumBurger\Stam\GeslachtQuery as ChildGeslachtQuery;
use Model\Custom\NovumBurger\Stam\Map\GeslachtTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'geslacht' table.
 *
 *
 *
 * @method     ChildGeslachtQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGeslachtQuery orderByNaam($order = Criteria::ASC) Order by the naam column
 * @method     ChildGeslachtQuery orderByNaamKort($order = Criteria::ASC) Order by the naam_kort column
 * @method     ChildGeslachtQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildGeslachtQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildGeslachtQuery groupById() Group by the id column
 * @method     ChildGeslachtQuery groupByNaam() Group by the naam column
 * @method     ChildGeslachtQuery groupByNaamKort() Group by the naam_kort column
 * @method     ChildGeslachtQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildGeslachtQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildGeslachtQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeslachtQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeslachtQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeslachtQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeslachtQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeslachtQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeslachtQuery leftJoinPersoon($relationAlias = null) Adds a LEFT JOIN clause to the query using the Persoon relation
 * @method     ChildGeslachtQuery rightJoinPersoon($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Persoon relation
 * @method     ChildGeslachtQuery innerJoinPersoon($relationAlias = null) Adds a INNER JOIN clause to the query using the Persoon relation
 *
 * @method     ChildGeslachtQuery joinWithPersoon($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Persoon relation
 *
 * @method     ChildGeslachtQuery leftJoinWithPersoon() Adds a LEFT JOIN clause and with to the query using the Persoon relation
 * @method     ChildGeslachtQuery rightJoinWithPersoon() Adds a RIGHT JOIN clause and with to the query using the Persoon relation
 * @method     ChildGeslachtQuery innerJoinWithPersoon() Adds a INNER JOIN clause and with to the query using the Persoon relation
 *
 * @method     \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeslacht findOne(ConnectionInterface $con = null) Return the first ChildGeslacht matching the query
 * @method     ChildGeslacht findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGeslacht matching the query, or a new ChildGeslacht object populated from the query conditions when no match is found
 *
 * @method     ChildGeslacht findOneById(int $id) Return the first ChildGeslacht filtered by the id column
 * @method     ChildGeslacht findOneByNaam(string $naam) Return the first ChildGeslacht filtered by the naam column
 * @method     ChildGeslacht findOneByNaamKort(string $naam_kort) Return the first ChildGeslacht filtered by the naam_kort column
 * @method     ChildGeslacht findOneByCreatedAt(string $created_at) Return the first ChildGeslacht filtered by the created_at column
 * @method     ChildGeslacht findOneByUpdatedAt(string $updated_at) Return the first ChildGeslacht filtered by the updated_at column *

 * @method     ChildGeslacht requirePk($key, ConnectionInterface $con = null) Return the ChildGeslacht by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeslacht requireOne(ConnectionInterface $con = null) Return the first ChildGeslacht matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeslacht requireOneById(int $id) Return the first ChildGeslacht filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeslacht requireOneByNaam(string $naam) Return the first ChildGeslacht filtered by the naam column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeslacht requireOneByNaamKort(string $naam_kort) Return the first ChildGeslacht filtered by the naam_kort column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeslacht requireOneByCreatedAt(string $created_at) Return the first ChildGeslacht filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeslacht requireOneByUpdatedAt(string $updated_at) Return the first ChildGeslacht filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeslacht[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGeslacht objects based on current ModelCriteria
 * @method     ChildGeslacht[]|ObjectCollection findById(int $id) Return ChildGeslacht objects filtered by the id column
 * @method     ChildGeslacht[]|ObjectCollection findByNaam(string $naam) Return ChildGeslacht objects filtered by the naam column
 * @method     ChildGeslacht[]|ObjectCollection findByNaamKort(string $naam_kort) Return ChildGeslacht objects filtered by the naam_kort column
 * @method     ChildGeslacht[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildGeslacht objects filtered by the created_at column
 * @method     ChildGeslacht[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildGeslacht objects filtered by the updated_at column
 * @method     ChildGeslacht[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GeslachtQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Custom\NovumBurger\Stam\Base\GeslachtQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hurah', $modelName = '\\Model\\Custom\\NovumBurger\\Stam\\Geslacht', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeslachtQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeslachtQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGeslachtQuery) {
            return $criteria;
        }
        $query = new ChildGeslachtQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildGeslacht|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeslachtTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeslachtTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGeslacht A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, naam, naam_kort, created_at, updated_at FROM geslacht WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildGeslacht $obj */
            $obj = new ChildGeslacht();
            $obj->hydrate($row);
            GeslachtTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildGeslacht|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GeslachtTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GeslachtTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GeslachtTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the naam column
     *
     * Example usage:
     * <code>
     * $query->filterByNaam('fooValue');   // WHERE naam = 'fooValue'
     * $query->filterByNaam('%fooValue%', Criteria::LIKE); // WHERE naam LIKE '%fooValue%'
     * </code>
     *
     * @param     string $naam The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByNaam($naam = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($naam)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GeslachtTableMap::COL_NAAM, $naam, $comparison);
    }

    /**
     * Filter the query on the naam_kort column
     *
     * Example usage:
     * <code>
     * $query->filterByNaamKort('fooValue');   // WHERE naam_kort = 'fooValue'
     * $query->filterByNaamKort('%fooValue%', Criteria::LIKE); // WHERE naam_kort LIKE '%fooValue%'
     * </code>
     *
     * @param     string $naamKort The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByNaamKort($naamKort = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($naamKort)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GeslachtTableMap::COL_NAAM_KORT, $naamKort, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GeslachtTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(GeslachtTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GeslachtTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon|ObjectCollection $persoon the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGeslachtQuery The current query, for fluid interface
     */
    public function filterByPersoon($persoon, $comparison = null)
    {
        if ($persoon instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) {
            return $this
                ->addUsingAlias(GeslachtTableMap::COL_ID, $persoon->getGeslachtId(), $comparison);
        } elseif ($persoon instanceof ObjectCollection) {
            return $this
                ->usePersoonQuery()
                ->filterByPrimaryKeys($persoon->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersoon() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Persoon relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function joinPersoon($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Persoon');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Persoon');
        }

        return $this;
    }

    /**
     * Use the Persoon relation Persoon object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery A secondary query class using the current class as primary query
     */
    public function usePersoonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPersoon($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Persoon', '\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGeslacht $geslacht Object to remove from the list of results
     *
     * @return $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function prune($geslacht = null)
    {
        if ($geslacht) {
            $this->addUsingAlias(GeslachtTableMap::COL_ID, $geslacht->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geslacht table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeslachtTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeslachtTableMap::clearInstancePool();
            GeslachtTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeslachtTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeslachtTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeslachtTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeslachtTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(GeslachtTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(GeslachtTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(GeslachtTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(GeslachtTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(GeslachtTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildGeslachtQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(GeslachtTableMap::COL_CREATED_AT);
    }

} // GeslachtQuery
