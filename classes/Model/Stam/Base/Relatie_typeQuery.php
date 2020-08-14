<?php

namespace Model\Custom\NovumBurger\Stam\Base;

use \Exception;
use \PDO;
use Model\Custom\NovumBurger\Persoonsgegevens\Relatie;
use Model\Custom\NovumBurger\Stam\Relatie_type as ChildRelatie_type;
use Model\Custom\NovumBurger\Stam\Relatie_typeQuery as ChildRelatie_typeQuery;
use Model\Custom\NovumBurger\Stam\Map\Relatie_typeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'relatie_type' table.
 *
 *
 *
 * @method     ChildRelatie_typeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRelatie_typeQuery orderByNaam($order = Criteria::ASC) Order by the naam column
 * @method     ChildRelatie_typeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildRelatie_typeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildRelatie_typeQuery groupById() Group by the id column
 * @method     ChildRelatie_typeQuery groupByNaam() Group by the naam column
 * @method     ChildRelatie_typeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildRelatie_typeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildRelatie_typeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRelatie_typeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRelatie_typeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRelatie_typeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRelatie_typeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRelatie_typeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRelatie_typeQuery leftJoinRelatie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Relatie relation
 * @method     ChildRelatie_typeQuery rightJoinRelatie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Relatie relation
 * @method     ChildRelatie_typeQuery innerJoinRelatie($relationAlias = null) Adds a INNER JOIN clause to the query using the Relatie relation
 *
 * @method     ChildRelatie_typeQuery joinWithRelatie($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Relatie relation
 *
 * @method     ChildRelatie_typeQuery leftJoinWithRelatie() Adds a LEFT JOIN clause and with to the query using the Relatie relation
 * @method     ChildRelatie_typeQuery rightJoinWithRelatie() Adds a RIGHT JOIN clause and with to the query using the Relatie relation
 * @method     ChildRelatie_typeQuery innerJoinWithRelatie() Adds a INNER JOIN clause and with to the query using the Relatie relation
 *
 * @method     \Model\Custom\NovumBurger\Persoonsgegevens\RelatieQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRelatie_type findOne(ConnectionInterface $con = null) Return the first ChildRelatie_type matching the query
 * @method     ChildRelatie_type findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRelatie_type matching the query, or a new ChildRelatie_type object populated from the query conditions when no match is found
 *
 * @method     ChildRelatie_type findOneById(int $id) Return the first ChildRelatie_type filtered by the id column
 * @method     ChildRelatie_type findOneByNaam(string $naam) Return the first ChildRelatie_type filtered by the naam column
 * @method     ChildRelatie_type findOneByCreatedAt(string $created_at) Return the first ChildRelatie_type filtered by the created_at column
 * @method     ChildRelatie_type findOneByUpdatedAt(string $updated_at) Return the first ChildRelatie_type filtered by the updated_at column *

 * @method     ChildRelatie_type requirePk($key, ConnectionInterface $con = null) Return the ChildRelatie_type by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie_type requireOne(ConnectionInterface $con = null) Return the first ChildRelatie_type matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRelatie_type requireOneById(int $id) Return the first ChildRelatie_type filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie_type requireOneByNaam(string $naam) Return the first ChildRelatie_type filtered by the naam column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie_type requireOneByCreatedAt(string $created_at) Return the first ChildRelatie_type filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie_type requireOneByUpdatedAt(string $updated_at) Return the first ChildRelatie_type filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRelatie_type[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRelatie_type objects based on current ModelCriteria
 * @method     ChildRelatie_type[]|ObjectCollection findById(int $id) Return ChildRelatie_type objects filtered by the id column
 * @method     ChildRelatie_type[]|ObjectCollection findByNaam(string $naam) Return ChildRelatie_type objects filtered by the naam column
 * @method     ChildRelatie_type[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildRelatie_type objects filtered by the created_at column
 * @method     ChildRelatie_type[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildRelatie_type objects filtered by the updated_at column
 * @method     ChildRelatie_type[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class Relatie_typeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Custom\NovumBurger\Stam\Base\Relatie_typeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hurah', $modelName = '\\Model\\Custom\\NovumBurger\\Stam\\Relatie_type', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRelatie_typeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRelatie_typeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRelatie_typeQuery) {
            return $criteria;
        }
        $query = new ChildRelatie_typeQuery();
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
     * @return ChildRelatie_type|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(Relatie_typeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = Relatie_typeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRelatie_type A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, naam, created_at, updated_at FROM relatie_type WHERE id = :p0';
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
            /** @var ChildRelatie_type $obj */
            $obj = new ChildRelatie_type();
            $obj->hydrate($row);
            Relatie_typeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRelatie_type|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByNaam($naam = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($naam)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Relatie_typeTableMap::COL_NAAM, $naam, $comparison);
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
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Relatie_typeTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(Relatie_typeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Relatie_typeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Relatie object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Relatie|ObjectCollection $relatie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function filterByRelatie($relatie, $comparison = null)
    {
        if ($relatie instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Relatie) {
            return $this
                ->addUsingAlias(Relatie_typeTableMap::COL_ID, $relatie->getRelatie_type(), $comparison);
        } elseif ($relatie instanceof ObjectCollection) {
            return $this
                ->useRelatieQuery()
                ->filterByPrimaryKeys($relatie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRelatie() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Relatie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Relatie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function joinRelatie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Relatie');

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
            $this->addJoinObject($join, 'Relatie');
        }

        return $this;
    }

    /**
     * Use the Relatie relation Relatie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\RelatieQuery A secondary query class using the current class as primary query
     */
    public function useRelatieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRelatie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Relatie', '\Model\Custom\NovumBurger\Persoonsgegevens\RelatieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRelatie_type $relatie_type Object to remove from the list of results
     *
     * @return $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function prune($relatie_type = null)
    {
        if ($relatie_type) {
            $this->addUsingAlias(Relatie_typeTableMap::COL_ID, $relatie_type->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the relatie_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Relatie_typeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            Relatie_typeTableMap::clearInstancePool();
            Relatie_typeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(Relatie_typeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(Relatie_typeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            Relatie_typeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            Relatie_typeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(Relatie_typeTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(Relatie_typeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(Relatie_typeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(Relatie_typeTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(Relatie_typeTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildRelatie_typeQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(Relatie_typeTableMap::COL_CREATED_AT);
    }

} // Relatie_typeQuery
