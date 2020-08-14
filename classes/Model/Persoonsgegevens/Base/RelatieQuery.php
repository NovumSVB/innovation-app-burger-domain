<?php

namespace Model\Custom\NovumBurger\Persoonsgegevens\Base;

use \Exception;
use \PDO;
use Model\Custom\NovumBurger\Persoonsgegevens\Relatie as ChildRelatie;
use Model\Custom\NovumBurger\Persoonsgegevens\RelatieQuery as ChildRelatieQuery;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\RelatieTableMap;
use Model\Custom\NovumBurger\Stam\Relatie_type;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'relatie' table.
 *
 *
 *
 * @method     ChildRelatieQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRelatieQuery orderByRelatie_type($order = Criteria::ASC) Order by the relatie_type_id column
 * @method     ChildRelatieQuery orderByRelatieStart($order = Criteria::ASC) Order by the relatie_start column
 * @method     ChildRelatieQuery orderByRelatieEinde($order = Criteria::ASC) Order by the relatie_einde column
 * @method     ChildRelatieQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildRelatieQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildRelatieQuery groupById() Group by the id column
 * @method     ChildRelatieQuery groupByRelatie_type() Group by the relatie_type_id column
 * @method     ChildRelatieQuery groupByRelatieStart() Group by the relatie_start column
 * @method     ChildRelatieQuery groupByRelatieEinde() Group by the relatie_einde column
 * @method     ChildRelatieQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildRelatieQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildRelatieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRelatieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRelatieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRelatieQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRelatieQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRelatieQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRelatieQuery leftJoinRelatieType($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelatieType relation
 * @method     ChildRelatieQuery rightJoinRelatieType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelatieType relation
 * @method     ChildRelatieQuery innerJoinRelatieType($relationAlias = null) Adds a INNER JOIN clause to the query using the RelatieType relation
 *
 * @method     ChildRelatieQuery joinWithRelatieType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RelatieType relation
 *
 * @method     ChildRelatieQuery leftJoinWithRelatieType() Adds a LEFT JOIN clause and with to the query using the RelatieType relation
 * @method     ChildRelatieQuery rightJoinWithRelatieType() Adds a RIGHT JOIN clause and with to the query using the RelatieType relation
 * @method     ChildRelatieQuery innerJoinWithRelatieType() Adds a INNER JOIN clause and with to the query using the RelatieType relation
 *
 * @method     ChildRelatieQuery leftJoinPersoon_relatie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Persoon_relatie relation
 * @method     ChildRelatieQuery rightJoinPersoon_relatie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Persoon_relatie relation
 * @method     ChildRelatieQuery innerJoinPersoon_relatie($relationAlias = null) Adds a INNER JOIN clause to the query using the Persoon_relatie relation
 *
 * @method     ChildRelatieQuery joinWithPersoon_relatie($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Persoon_relatie relation
 *
 * @method     ChildRelatieQuery leftJoinWithPersoon_relatie() Adds a LEFT JOIN clause and with to the query using the Persoon_relatie relation
 * @method     ChildRelatieQuery rightJoinWithPersoon_relatie() Adds a RIGHT JOIN clause and with to the query using the Persoon_relatie relation
 * @method     ChildRelatieQuery innerJoinWithPersoon_relatie() Adds a INNER JOIN clause and with to the query using the Persoon_relatie relation
 *
 * @method     \Model\Custom\NovumBurger\Stam\Relatie_typeQuery|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRelatie findOne(ConnectionInterface $con = null) Return the first ChildRelatie matching the query
 * @method     ChildRelatie findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRelatie matching the query, or a new ChildRelatie object populated from the query conditions when no match is found
 *
 * @method     ChildRelatie findOneById(int $id) Return the first ChildRelatie filtered by the id column
 * @method     ChildRelatie findOneByRelatie_type(int $relatie_type_id) Return the first ChildRelatie filtered by the relatie_type_id column
 * @method     ChildRelatie findOneByRelatieStart(string $relatie_start) Return the first ChildRelatie filtered by the relatie_start column
 * @method     ChildRelatie findOneByRelatieEinde(string $relatie_einde) Return the first ChildRelatie filtered by the relatie_einde column
 * @method     ChildRelatie findOneByCreatedAt(string $created_at) Return the first ChildRelatie filtered by the created_at column
 * @method     ChildRelatie findOneByUpdatedAt(string $updated_at) Return the first ChildRelatie filtered by the updated_at column *

 * @method     ChildRelatie requirePk($key, ConnectionInterface $con = null) Return the ChildRelatie by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOne(ConnectionInterface $con = null) Return the first ChildRelatie matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRelatie requireOneById(int $id) Return the first ChildRelatie filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOneByRelatie_type(int $relatie_type_id) Return the first ChildRelatie filtered by the relatie_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOneByRelatieStart(string $relatie_start) Return the first ChildRelatie filtered by the relatie_start column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOneByRelatieEinde(string $relatie_einde) Return the first ChildRelatie filtered by the relatie_einde column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOneByCreatedAt(string $created_at) Return the first ChildRelatie filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRelatie requireOneByUpdatedAt(string $updated_at) Return the first ChildRelatie filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRelatie[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRelatie objects based on current ModelCriteria
 * @method     ChildRelatie[]|ObjectCollection findById(int $id) Return ChildRelatie objects filtered by the id column
 * @method     ChildRelatie[]|ObjectCollection findByRelatie_type(int $relatie_type_id) Return ChildRelatie objects filtered by the relatie_type_id column
 * @method     ChildRelatie[]|ObjectCollection findByRelatieStart(string $relatie_start) Return ChildRelatie objects filtered by the relatie_start column
 * @method     ChildRelatie[]|ObjectCollection findByRelatieEinde(string $relatie_einde) Return ChildRelatie objects filtered by the relatie_einde column
 * @method     ChildRelatie[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildRelatie objects filtered by the created_at column
 * @method     ChildRelatie[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildRelatie objects filtered by the updated_at column
 * @method     ChildRelatie[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RelatieQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Custom\NovumBurger\Persoonsgegevens\Base\RelatieQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hurah', $modelName = '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Relatie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRelatieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRelatieQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRelatieQuery) {
            return $criteria;
        }
        $query = new ChildRelatieQuery();
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
     * @return ChildRelatie|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RelatieTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RelatieTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRelatie A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, relatie_type_id, relatie_start, relatie_einde, created_at, updated_at FROM relatie WHERE id = :p0';
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
            /** @var ChildRelatie $obj */
            $obj = new ChildRelatie();
            $obj->hydrate($row);
            RelatieTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRelatie|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RelatieTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RelatieTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the relatie_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRelatie_type(1234); // WHERE relatie_type_id = 1234
     * $query->filterByRelatie_type(array(12, 34)); // WHERE relatie_type_id IN (12, 34)
     * $query->filterByRelatie_type(array('min' => 12)); // WHERE relatie_type_id > 12
     * </code>
     *
     * @see       filterByRelatieType()
     *
     * @param     mixed $relatie_type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByRelatie_type($relatie_type = null, $comparison = null)
    {
        if (is_array($relatie_type)) {
            $useMinMax = false;
            if (isset($relatie_type['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_TYPE_ID, $relatie_type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($relatie_type['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_TYPE_ID, $relatie_type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_RELATIE_TYPE_ID, $relatie_type, $comparison);
    }

    /**
     * Filter the query on the relatie_start column
     *
     * Example usage:
     * <code>
     * $query->filterByRelatieStart('2011-03-14'); // WHERE relatie_start = '2011-03-14'
     * $query->filterByRelatieStart('now'); // WHERE relatie_start = '2011-03-14'
     * $query->filterByRelatieStart(array('max' => 'yesterday')); // WHERE relatie_start > '2011-03-13'
     * </code>
     *
     * @param     mixed $relatieStart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByRelatieStart($relatieStart = null, $comparison = null)
    {
        if (is_array($relatieStart)) {
            $useMinMax = false;
            if (isset($relatieStart['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_START, $relatieStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($relatieStart['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_START, $relatieStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_RELATIE_START, $relatieStart, $comparison);
    }

    /**
     * Filter the query on the relatie_einde column
     *
     * Example usage:
     * <code>
     * $query->filterByRelatieEinde('2011-03-14'); // WHERE relatie_einde = '2011-03-14'
     * $query->filterByRelatieEinde('now'); // WHERE relatie_einde = '2011-03-14'
     * $query->filterByRelatieEinde(array('max' => 'yesterday')); // WHERE relatie_einde > '2011-03-13'
     * </code>
     *
     * @param     mixed $relatieEinde The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByRelatieEinde($relatieEinde = null, $comparison = null)
    {
        if (is_array($relatieEinde)) {
            $useMinMax = false;
            if (isset($relatieEinde['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_EINDE, $relatieEinde['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($relatieEinde['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_RELATIE_EINDE, $relatieEinde['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_RELATIE_EINDE, $relatieEinde, $comparison);
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
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RelatieTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RelatieTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RelatieTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Stam\Relatie_type object
     *
     * @param \Model\Custom\NovumBurger\Stam\Relatie_type|ObjectCollection $relatie_type The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByRelatieType($relatie_type, $comparison = null)
    {
        if ($relatie_type instanceof \Model\Custom\NovumBurger\Stam\Relatie_type) {
            return $this
                ->addUsingAlias(RelatieTableMap::COL_RELATIE_TYPE_ID, $relatie_type->getId(), $comparison);
        } elseif ($relatie_type instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RelatieTableMap::COL_RELATIE_TYPE_ID, $relatie_type->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRelatieType() only accepts arguments of type \Model\Custom\NovumBurger\Stam\Relatie_type or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RelatieType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function joinRelatieType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RelatieType');

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
            $this->addJoinObject($join, 'RelatieType');
        }

        return $this;
    }

    /**
     * Use the RelatieType relation Relatie_type object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Stam\Relatie_typeQuery A secondary query class using the current class as primary query
     */
    public function useRelatieTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRelatieType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RelatieType', '\Model\Custom\NovumBurger\Stam\Relatie_typeQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie|ObjectCollection $persoon_relatie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRelatieQuery The current query, for fluid interface
     */
    public function filterByPersoon_relatie($persoon_relatie, $comparison = null)
    {
        if ($persoon_relatie instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie) {
            return $this
                ->addUsingAlias(RelatieTableMap::COL_ID, $persoon_relatie->getRelatieId(), $comparison);
        } elseif ($persoon_relatie instanceof ObjectCollection) {
            return $this
                ->usePersoon_relatieQuery()
                ->filterByPrimaryKeys($persoon_relatie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersoon_relatie() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Persoon_relatie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function joinPersoon_relatie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Persoon_relatie');

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
            $this->addJoinObject($join, 'Persoon_relatie');
        }

        return $this;
    }

    /**
     * Use the Persoon_relatie relation Persoon_relatie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery A secondary query class using the current class as primary query
     */
    public function usePersoon_relatieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPersoon_relatie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Persoon_relatie', '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRelatie $relatie Object to remove from the list of results
     *
     * @return $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function prune($relatie = null)
    {
        if ($relatie) {
            $this->addUsingAlias(RelatieTableMap::COL_ID, $relatie->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the relatie table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RelatieTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RelatieTableMap::clearInstancePool();
            RelatieTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RelatieTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RelatieTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RelatieTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RelatieTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RelatieTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RelatieTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RelatieTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RelatieTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RelatieTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildRelatieQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RelatieTableMap::COL_CREATED_AT);
    }

} // RelatieQuery
