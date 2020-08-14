<?php

namespace Model\Custom\NovumBurger\Persoonsgegevens\Base;

use \Exception;
use \PDO;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon as ChildPersoon;
use Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery as ChildPersoonQuery;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\PersoonTableMap;
use Model\Custom\NovumBurger\Stam\Geslacht;
use Model\Custom\NovumBurger\Stam\Land;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'persoon' table.
 *
 *
 *
 * @method     ChildPersoonQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPersoonQuery orderByBsn($order = Criteria::ASC) Order by the bsn column
 * @method     ChildPersoonQuery orderByInfix($order = Criteria::ASC) Order by the infix column
 * @method     ChildPersoonQuery orderByVoornaam($order = Criteria::ASC) Order by the voornaam column
 * @method     ChildPersoonQuery orderByAchternaam($order = Criteria::ASC) Order by the achternaam column
 * @method     ChildPersoonQuery orderByVader($order = Criteria::ASC) Order by the vader_id column
 * @method     ChildPersoonQuery orderByMoeder($order = Criteria::ASC) Order by the moeder_id column
 * @method     ChildPersoonQuery orderByGeslachtId($order = Criteria::ASC) Order by the geslacht_id column
 * @method     ChildPersoonQuery orderByGeboorteDatum($order = Criteria::ASC) Order by the geboorte_datum column
 * @method     ChildPersoonQuery orderByGeboortePlaats($order = Criteria::ASC) Order by the geboorte_plaats column
 * @method     ChildPersoonQuery orderByGeboorteLand($order = Criteria::ASC) Order by the geboorte_land_id column
 * @method     ChildPersoonQuery orderByImmigratiedatum($order = Criteria::ASC) Order by the immigratie_datum column
 * @method     ChildPersoonQuery orderByHeeftNederlandsPaspoort($order = Criteria::ASC) Order by the heeft_nl_paspoort column
 * @method     ChildPersoonQuery orderBySterfDatum($order = Criteria::ASC) Order by the sterf_datum column
 * @method     ChildPersoonQuery orderBySterfPlaats($order = Criteria::ASC) Order by the sterf_plaats column
 * @method     ChildPersoonQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPersoonQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPersoonQuery groupById() Group by the id column
 * @method     ChildPersoonQuery groupByBsn() Group by the bsn column
 * @method     ChildPersoonQuery groupByInfix() Group by the infix column
 * @method     ChildPersoonQuery groupByVoornaam() Group by the voornaam column
 * @method     ChildPersoonQuery groupByAchternaam() Group by the achternaam column
 * @method     ChildPersoonQuery groupByVader() Group by the vader_id column
 * @method     ChildPersoonQuery groupByMoeder() Group by the moeder_id column
 * @method     ChildPersoonQuery groupByGeslachtId() Group by the geslacht_id column
 * @method     ChildPersoonQuery groupByGeboorteDatum() Group by the geboorte_datum column
 * @method     ChildPersoonQuery groupByGeboortePlaats() Group by the geboorte_plaats column
 * @method     ChildPersoonQuery groupByGeboorteLand() Group by the geboorte_land_id column
 * @method     ChildPersoonQuery groupByImmigratiedatum() Group by the immigratie_datum column
 * @method     ChildPersoonQuery groupByHeeftNederlandsPaspoort() Group by the heeft_nl_paspoort column
 * @method     ChildPersoonQuery groupBySterfDatum() Group by the sterf_datum column
 * @method     ChildPersoonQuery groupBySterfPlaats() Group by the sterf_plaats column
 * @method     ChildPersoonQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPersoonQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPersoonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPersoonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPersoonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPersoonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPersoonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPersoonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPersoonQuery leftJoinLand($relationAlias = null) Adds a LEFT JOIN clause to the query using the Land relation
 * @method     ChildPersoonQuery rightJoinLand($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Land relation
 * @method     ChildPersoonQuery innerJoinLand($relationAlias = null) Adds a INNER JOIN clause to the query using the Land relation
 *
 * @method     ChildPersoonQuery joinWithLand($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Land relation
 *
 * @method     ChildPersoonQuery leftJoinWithLand() Adds a LEFT JOIN clause and with to the query using the Land relation
 * @method     ChildPersoonQuery rightJoinWithLand() Adds a RIGHT JOIN clause and with to the query using the Land relation
 * @method     ChildPersoonQuery innerJoinWithLand() Adds a INNER JOIN clause and with to the query using the Land relation
 *
 * @method     ChildPersoonQuery leftJoinGeslacht($relationAlias = null) Adds a LEFT JOIN clause to the query using the Geslacht relation
 * @method     ChildPersoonQuery rightJoinGeslacht($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Geslacht relation
 * @method     ChildPersoonQuery innerJoinGeslacht($relationAlias = null) Adds a INNER JOIN clause to the query using the Geslacht relation
 *
 * @method     ChildPersoonQuery joinWithGeslacht($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Geslacht relation
 *
 * @method     ChildPersoonQuery leftJoinWithGeslacht() Adds a LEFT JOIN clause and with to the query using the Geslacht relation
 * @method     ChildPersoonQuery rightJoinWithGeslacht() Adds a RIGHT JOIN clause and with to the query using the Geslacht relation
 * @method     ChildPersoonQuery innerJoinWithGeslacht() Adds a INNER JOIN clause and with to the query using the Geslacht relation
 *
 * @method     ChildPersoonQuery leftJoinFkVader($relationAlias = null) Adds a LEFT JOIN clause to the query using the FkVader relation
 * @method     ChildPersoonQuery rightJoinFkVader($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FkVader relation
 * @method     ChildPersoonQuery innerJoinFkVader($relationAlias = null) Adds a INNER JOIN clause to the query using the FkVader relation
 *
 * @method     ChildPersoonQuery joinWithFkVader($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FkVader relation
 *
 * @method     ChildPersoonQuery leftJoinWithFkVader() Adds a LEFT JOIN clause and with to the query using the FkVader relation
 * @method     ChildPersoonQuery rightJoinWithFkVader() Adds a RIGHT JOIN clause and with to the query using the FkVader relation
 * @method     ChildPersoonQuery innerJoinWithFkVader() Adds a INNER JOIN clause and with to the query using the FkVader relation
 *
 * @method     ChildPersoonQuery leftJoinFkMoeder($relationAlias = null) Adds a LEFT JOIN clause to the query using the FkMoeder relation
 * @method     ChildPersoonQuery rightJoinFkMoeder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FkMoeder relation
 * @method     ChildPersoonQuery innerJoinFkMoeder($relationAlias = null) Adds a INNER JOIN clause to the query using the FkMoeder relation
 *
 * @method     ChildPersoonQuery joinWithFkMoeder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FkMoeder relation
 *
 * @method     ChildPersoonQuery leftJoinWithFkMoeder() Adds a LEFT JOIN clause and with to the query using the FkMoeder relation
 * @method     ChildPersoonQuery rightJoinWithFkMoeder() Adds a RIGHT JOIN clause and with to the query using the FkMoeder relation
 * @method     ChildPersoonQuery innerJoinWithFkMoeder() Adds a INNER JOIN clause and with to the query using the FkMoeder relation
 *
 * @method     ChildPersoonQuery leftJoinPersoonRelatedById0($relationAlias = null) Adds a LEFT JOIN clause to the query using the PersoonRelatedById0 relation
 * @method     ChildPersoonQuery rightJoinPersoonRelatedById0($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PersoonRelatedById0 relation
 * @method     ChildPersoonQuery innerJoinPersoonRelatedById0($relationAlias = null) Adds a INNER JOIN clause to the query using the PersoonRelatedById0 relation
 *
 * @method     ChildPersoonQuery joinWithPersoonRelatedById0($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PersoonRelatedById0 relation
 *
 * @method     ChildPersoonQuery leftJoinWithPersoonRelatedById0() Adds a LEFT JOIN clause and with to the query using the PersoonRelatedById0 relation
 * @method     ChildPersoonQuery rightJoinWithPersoonRelatedById0() Adds a RIGHT JOIN clause and with to the query using the PersoonRelatedById0 relation
 * @method     ChildPersoonQuery innerJoinWithPersoonRelatedById0() Adds a INNER JOIN clause and with to the query using the PersoonRelatedById0 relation
 *
 * @method     ChildPersoonQuery leftJoinPersoonRelatedById1($relationAlias = null) Adds a LEFT JOIN clause to the query using the PersoonRelatedById1 relation
 * @method     ChildPersoonQuery rightJoinPersoonRelatedById1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PersoonRelatedById1 relation
 * @method     ChildPersoonQuery innerJoinPersoonRelatedById1($relationAlias = null) Adds a INNER JOIN clause to the query using the PersoonRelatedById1 relation
 *
 * @method     ChildPersoonQuery joinWithPersoonRelatedById1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PersoonRelatedById1 relation
 *
 * @method     ChildPersoonQuery leftJoinWithPersoonRelatedById1() Adds a LEFT JOIN clause and with to the query using the PersoonRelatedById1 relation
 * @method     ChildPersoonQuery rightJoinWithPersoonRelatedById1() Adds a RIGHT JOIN clause and with to the query using the PersoonRelatedById1 relation
 * @method     ChildPersoonQuery innerJoinWithPersoonRelatedById1() Adds a INNER JOIN clause and with to the query using the PersoonRelatedById1 relation
 *
 * @method     ChildPersoonQuery leftJoinPersoon_relatie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Persoon_relatie relation
 * @method     ChildPersoonQuery rightJoinPersoon_relatie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Persoon_relatie relation
 * @method     ChildPersoonQuery innerJoinPersoon_relatie($relationAlias = null) Adds a INNER JOIN clause to the query using the Persoon_relatie relation
 *
 * @method     ChildPersoonQuery joinWithPersoon_relatie($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Persoon_relatie relation
 *
 * @method     ChildPersoonQuery leftJoinWithPersoon_relatie() Adds a LEFT JOIN clause and with to the query using the Persoon_relatie relation
 * @method     ChildPersoonQuery rightJoinWithPersoon_relatie() Adds a RIGHT JOIN clause and with to the query using the Persoon_relatie relation
 * @method     ChildPersoonQuery innerJoinWithPersoon_relatie() Adds a INNER JOIN clause and with to the query using the Persoon_relatie relation
 *
 * @method     \Model\Custom\NovumBurger\Stam\LandQuery|\Model\Custom\NovumBurger\Stam\GeslachtQuery|\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPersoon findOne(ConnectionInterface $con = null) Return the first ChildPersoon matching the query
 * @method     ChildPersoon findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPersoon matching the query, or a new ChildPersoon object populated from the query conditions when no match is found
 *
 * @method     ChildPersoon findOneById(int $id) Return the first ChildPersoon filtered by the id column
 * @method     ChildPersoon findOneByBsn(string $bsn) Return the first ChildPersoon filtered by the bsn column
 * @method     ChildPersoon findOneByInfix(string $infix) Return the first ChildPersoon filtered by the infix column
 * @method     ChildPersoon findOneByVoornaam(string $voornaam) Return the first ChildPersoon filtered by the voornaam column
 * @method     ChildPersoon findOneByAchternaam(string $achternaam) Return the first ChildPersoon filtered by the achternaam column
 * @method     ChildPersoon findOneByVader(int $vader_id) Return the first ChildPersoon filtered by the vader_id column
 * @method     ChildPersoon findOneByMoeder(int $moeder_id) Return the first ChildPersoon filtered by the moeder_id column
 * @method     ChildPersoon findOneByGeslachtId(int $geslacht_id) Return the first ChildPersoon filtered by the geslacht_id column
 * @method     ChildPersoon findOneByGeboorteDatum(string $geboorte_datum) Return the first ChildPersoon filtered by the geboorte_datum column
 * @method     ChildPersoon findOneByGeboortePlaats(string $geboorte_plaats) Return the first ChildPersoon filtered by the geboorte_plaats column
 * @method     ChildPersoon findOneByGeboorteLand(int $geboorte_land_id) Return the first ChildPersoon filtered by the geboorte_land_id column
 * @method     ChildPersoon findOneByImmigratiedatum(string $immigratie_datum) Return the first ChildPersoon filtered by the immigratie_datum column
 * @method     ChildPersoon findOneByHeeftNederlandsPaspoort(boolean $heeft_nl_paspoort) Return the first ChildPersoon filtered by the heeft_nl_paspoort column
 * @method     ChildPersoon findOneBySterfDatum(string $sterf_datum) Return the first ChildPersoon filtered by the sterf_datum column
 * @method     ChildPersoon findOneBySterfPlaats(string $sterf_plaats) Return the first ChildPersoon filtered by the sterf_plaats column
 * @method     ChildPersoon findOneByCreatedAt(string $created_at) Return the first ChildPersoon filtered by the created_at column
 * @method     ChildPersoon findOneByUpdatedAt(string $updated_at) Return the first ChildPersoon filtered by the updated_at column *

 * @method     ChildPersoon requirePk($key, ConnectionInterface $con = null) Return the ChildPersoon by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOne(ConnectionInterface $con = null) Return the first ChildPersoon matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersoon requireOneById(int $id) Return the first ChildPersoon filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByBsn(string $bsn) Return the first ChildPersoon filtered by the bsn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByInfix(string $infix) Return the first ChildPersoon filtered by the infix column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByVoornaam(string $voornaam) Return the first ChildPersoon filtered by the voornaam column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByAchternaam(string $achternaam) Return the first ChildPersoon filtered by the achternaam column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByVader(int $vader_id) Return the first ChildPersoon filtered by the vader_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByMoeder(int $moeder_id) Return the first ChildPersoon filtered by the moeder_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByGeslachtId(int $geslacht_id) Return the first ChildPersoon filtered by the geslacht_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByGeboorteDatum(string $geboorte_datum) Return the first ChildPersoon filtered by the geboorte_datum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByGeboortePlaats(string $geboorte_plaats) Return the first ChildPersoon filtered by the geboorte_plaats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByGeboorteLand(int $geboorte_land_id) Return the first ChildPersoon filtered by the geboorte_land_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByImmigratiedatum(string $immigratie_datum) Return the first ChildPersoon filtered by the immigratie_datum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByHeeftNederlandsPaspoort(boolean $heeft_nl_paspoort) Return the first ChildPersoon filtered by the heeft_nl_paspoort column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneBySterfDatum(string $sterf_datum) Return the first ChildPersoon filtered by the sterf_datum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneBySterfPlaats(string $sterf_plaats) Return the first ChildPersoon filtered by the sterf_plaats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByCreatedAt(string $created_at) Return the first ChildPersoon filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersoon requireOneByUpdatedAt(string $updated_at) Return the first ChildPersoon filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersoon[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPersoon objects based on current ModelCriteria
 * @method     ChildPersoon[]|ObjectCollection findById(int $id) Return ChildPersoon objects filtered by the id column
 * @method     ChildPersoon[]|ObjectCollection findByBsn(string $bsn) Return ChildPersoon objects filtered by the bsn column
 * @method     ChildPersoon[]|ObjectCollection findByInfix(string $infix) Return ChildPersoon objects filtered by the infix column
 * @method     ChildPersoon[]|ObjectCollection findByVoornaam(string $voornaam) Return ChildPersoon objects filtered by the voornaam column
 * @method     ChildPersoon[]|ObjectCollection findByAchternaam(string $achternaam) Return ChildPersoon objects filtered by the achternaam column
 * @method     ChildPersoon[]|ObjectCollection findByVader(int $vader_id) Return ChildPersoon objects filtered by the vader_id column
 * @method     ChildPersoon[]|ObjectCollection findByMoeder(int $moeder_id) Return ChildPersoon objects filtered by the moeder_id column
 * @method     ChildPersoon[]|ObjectCollection findByGeslachtId(int $geslacht_id) Return ChildPersoon objects filtered by the geslacht_id column
 * @method     ChildPersoon[]|ObjectCollection findByGeboorteDatum(string $geboorte_datum) Return ChildPersoon objects filtered by the geboorte_datum column
 * @method     ChildPersoon[]|ObjectCollection findByGeboortePlaats(string $geboorte_plaats) Return ChildPersoon objects filtered by the geboorte_plaats column
 * @method     ChildPersoon[]|ObjectCollection findByGeboorteLand(int $geboorte_land_id) Return ChildPersoon objects filtered by the geboorte_land_id column
 * @method     ChildPersoon[]|ObjectCollection findByImmigratiedatum(string $immigratie_datum) Return ChildPersoon objects filtered by the immigratie_datum column
 * @method     ChildPersoon[]|ObjectCollection findByHeeftNederlandsPaspoort(boolean $heeft_nl_paspoort) Return ChildPersoon objects filtered by the heeft_nl_paspoort column
 * @method     ChildPersoon[]|ObjectCollection findBySterfDatum(string $sterf_datum) Return ChildPersoon objects filtered by the sterf_datum column
 * @method     ChildPersoon[]|ObjectCollection findBySterfPlaats(string $sterf_plaats) Return ChildPersoon objects filtered by the sterf_plaats column
 * @method     ChildPersoon[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPersoon objects filtered by the created_at column
 * @method     ChildPersoon[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPersoon objects filtered by the updated_at column
 * @method     ChildPersoon[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PersoonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Custom\NovumBurger\Persoonsgegevens\Base\PersoonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hurah', $modelName = '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPersoonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPersoonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPersoonQuery) {
            return $criteria;
        }
        $query = new ChildPersoonQuery();
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
     * @return ChildPersoon|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersoonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PersoonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPersoon A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, bsn, infix, voornaam, achternaam, vader_id, moeder_id, geslacht_id, geboorte_datum, geboorte_plaats, geboorte_land_id, immigratie_datum, heeft_nl_paspoort, sterf_datum, sterf_plaats, created_at, updated_at FROM persoon WHERE id = :p0';
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
            /** @var ChildPersoon $obj */
            $obj = new ChildPersoon();
            $obj->hydrate($row);
            PersoonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPersoon|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PersoonTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PersoonTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the bsn column
     *
     * Example usage:
     * <code>
     * $query->filterByBsn('fooValue');   // WHERE bsn = 'fooValue'
     * $query->filterByBsn('%fooValue%', Criteria::LIKE); // WHERE bsn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bsn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByBsn($bsn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bsn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_BSN, $bsn, $comparison);
    }

    /**
     * Filter the query on the infix column
     *
     * Example usage:
     * <code>
     * $query->filterByInfix('fooValue');   // WHERE infix = 'fooValue'
     * $query->filterByInfix('%fooValue%', Criteria::LIKE); // WHERE infix LIKE '%fooValue%'
     * </code>
     *
     * @param     string $infix The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByInfix($infix = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($infix)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_INFIX, $infix, $comparison);
    }

    /**
     * Filter the query on the voornaam column
     *
     * Example usage:
     * <code>
     * $query->filterByVoornaam('fooValue');   // WHERE voornaam = 'fooValue'
     * $query->filterByVoornaam('%fooValue%', Criteria::LIKE); // WHERE voornaam LIKE '%fooValue%'
     * </code>
     *
     * @param     string $voornaam The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByVoornaam($voornaam = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($voornaam)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_VOORNAAM, $voornaam, $comparison);
    }

    /**
     * Filter the query on the achternaam column
     *
     * Example usage:
     * <code>
     * $query->filterByAchternaam('fooValue');   // WHERE achternaam = 'fooValue'
     * $query->filterByAchternaam('%fooValue%', Criteria::LIKE); // WHERE achternaam LIKE '%fooValue%'
     * </code>
     *
     * @param     string $achternaam The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByAchternaam($achternaam = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($achternaam)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_ACHTERNAAM, $achternaam, $comparison);
    }

    /**
     * Filter the query on the vader_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVader(1234); // WHERE vader_id = 1234
     * $query->filterByVader(array(12, 34)); // WHERE vader_id IN (12, 34)
     * $query->filterByVader(array('min' => 12)); // WHERE vader_id > 12
     * </code>
     *
     * @see       filterByFkVader()
     *
     * @param     mixed $vader The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByVader($vader = null, $comparison = null)
    {
        if (is_array($vader)) {
            $useMinMax = false;
            if (isset($vader['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_VADER_ID, $vader['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vader['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_VADER_ID, $vader['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_VADER_ID, $vader, $comparison);
    }

    /**
     * Filter the query on the moeder_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMoeder(1234); // WHERE moeder_id = 1234
     * $query->filterByMoeder(array(12, 34)); // WHERE moeder_id IN (12, 34)
     * $query->filterByMoeder(array('min' => 12)); // WHERE moeder_id > 12
     * </code>
     *
     * @see       filterByFkMoeder()
     *
     * @param     mixed $moeder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByMoeder($moeder = null, $comparison = null)
    {
        if (is_array($moeder)) {
            $useMinMax = false;
            if (isset($moeder['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_MOEDER_ID, $moeder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moeder['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_MOEDER_ID, $moeder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_MOEDER_ID, $moeder, $comparison);
    }

    /**
     * Filter the query on the geslacht_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGeslachtId(1234); // WHERE geslacht_id = 1234
     * $query->filterByGeslachtId(array(12, 34)); // WHERE geslacht_id IN (12, 34)
     * $query->filterByGeslachtId(array('min' => 12)); // WHERE geslacht_id > 12
     * </code>
     *
     * @see       filterByGeslacht()
     *
     * @param     mixed $geslachtId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByGeslachtId($geslachtId = null, $comparison = null)
    {
        if (is_array($geslachtId)) {
            $useMinMax = false;
            if (isset($geslachtId['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GESLACHT_ID, $geslachtId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geslachtId['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GESLACHT_ID, $geslachtId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_GESLACHT_ID, $geslachtId, $comparison);
    }

    /**
     * Filter the query on the geboorte_datum column
     *
     * Example usage:
     * <code>
     * $query->filterByGeboorteDatum('2011-03-14'); // WHERE geboorte_datum = '2011-03-14'
     * $query->filterByGeboorteDatum('now'); // WHERE geboorte_datum = '2011-03-14'
     * $query->filterByGeboorteDatum(array('max' => 'yesterday')); // WHERE geboorte_datum > '2011-03-13'
     * </code>
     *
     * @param     mixed $geboorteDatum The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByGeboorteDatum($geboorteDatum = null, $comparison = null)
    {
        if (is_array($geboorteDatum)) {
            $useMinMax = false;
            if (isset($geboorteDatum['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_DATUM, $geboorteDatum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geboorteDatum['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_DATUM, $geboorteDatum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_DATUM, $geboorteDatum, $comparison);
    }

    /**
     * Filter the query on the geboorte_plaats column
     *
     * Example usage:
     * <code>
     * $query->filterByGeboortePlaats('fooValue');   // WHERE geboorte_plaats = 'fooValue'
     * $query->filterByGeboortePlaats('%fooValue%', Criteria::LIKE); // WHERE geboorte_plaats LIKE '%fooValue%'
     * </code>
     *
     * @param     string $geboortePlaats The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByGeboortePlaats($geboortePlaats = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($geboortePlaats)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_PLAATS, $geboortePlaats, $comparison);
    }

    /**
     * Filter the query on the geboorte_land_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGeboorteLand(1234); // WHERE geboorte_land_id = 1234
     * $query->filterByGeboorteLand(array(12, 34)); // WHERE geboorte_land_id IN (12, 34)
     * $query->filterByGeboorteLand(array('min' => 12)); // WHERE geboorte_land_id > 12
     * </code>
     *
     * @see       filterByLand()
     *
     * @param     mixed $geboorteLand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByGeboorteLand($geboorteLand = null, $comparison = null)
    {
        if (is_array($geboorteLand)) {
            $useMinMax = false;
            if (isset($geboorteLand['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_LAND_ID, $geboorteLand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geboorteLand['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_LAND_ID, $geboorteLand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_GEBOORTE_LAND_ID, $geboorteLand, $comparison);
    }

    /**
     * Filter the query on the immigratie_datum column
     *
     * Example usage:
     * <code>
     * $query->filterByImmigratiedatum('2011-03-14'); // WHERE immigratie_datum = '2011-03-14'
     * $query->filterByImmigratiedatum('now'); // WHERE immigratie_datum = '2011-03-14'
     * $query->filterByImmigratiedatum(array('max' => 'yesterday')); // WHERE immigratie_datum > '2011-03-13'
     * </code>
     *
     * @param     mixed $immigratiedatum The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByImmigratiedatum($immigratiedatum = null, $comparison = null)
    {
        if (is_array($immigratiedatum)) {
            $useMinMax = false;
            if (isset($immigratiedatum['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_IMMIGRATIE_DATUM, $immigratiedatum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($immigratiedatum['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_IMMIGRATIE_DATUM, $immigratiedatum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_IMMIGRATIE_DATUM, $immigratiedatum, $comparison);
    }

    /**
     * Filter the query on the heeft_nl_paspoort column
     *
     * Example usage:
     * <code>
     * $query->filterByHeeftNederlandsPaspoort(true); // WHERE heeft_nl_paspoort = true
     * $query->filterByHeeftNederlandsPaspoort('yes'); // WHERE heeft_nl_paspoort = true
     * </code>
     *
     * @param     boolean|string $heeftNederlandsPaspoort The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByHeeftNederlandsPaspoort($heeftNederlandsPaspoort = null, $comparison = null)
    {
        if (is_string($heeftNederlandsPaspoort)) {
            $heeftNederlandsPaspoort = in_array(strtolower($heeftNederlandsPaspoort), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PersoonTableMap::COL_HEEFT_NL_PASPOORT, $heeftNederlandsPaspoort, $comparison);
    }

    /**
     * Filter the query on the sterf_datum column
     *
     * Example usage:
     * <code>
     * $query->filterBySterfDatum('2011-03-14'); // WHERE sterf_datum = '2011-03-14'
     * $query->filterBySterfDatum('now'); // WHERE sterf_datum = '2011-03-14'
     * $query->filterBySterfDatum(array('max' => 'yesterday')); // WHERE sterf_datum > '2011-03-13'
     * </code>
     *
     * @param     mixed $sterfDatum The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterBySterfDatum($sterfDatum = null, $comparison = null)
    {
        if (is_array($sterfDatum)) {
            $useMinMax = false;
            if (isset($sterfDatum['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_STERF_DATUM, $sterfDatum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sterfDatum['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_STERF_DATUM, $sterfDatum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_STERF_DATUM, $sterfDatum, $comparison);
    }

    /**
     * Filter the query on the sterf_plaats column
     *
     * Example usage:
     * <code>
     * $query->filterBySterfPlaats('fooValue');   // WHERE sterf_plaats = 'fooValue'
     * $query->filterBySterfPlaats('%fooValue%', Criteria::LIKE); // WHERE sterf_plaats LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sterfPlaats The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterBySterfPlaats($sterfPlaats = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sterfPlaats)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_STERF_PLAATS, $sterfPlaats, $comparison);
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
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PersoonTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PersoonTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersoonTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Stam\Land object
     *
     * @param \Model\Custom\NovumBurger\Stam\Land|ObjectCollection $land The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByLand($land, $comparison = null)
    {
        if ($land instanceof \Model\Custom\NovumBurger\Stam\Land) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_GEBOORTE_LAND_ID, $land->getId(), $comparison);
        } elseif ($land instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersoonTableMap::COL_GEBOORTE_LAND_ID, $land->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLand() only accepts arguments of type \Model\Custom\NovumBurger\Stam\Land or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Land relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinLand($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Land');

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
            $this->addJoinObject($join, 'Land');
        }

        return $this;
    }

    /**
     * Use the Land relation Land object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Stam\LandQuery A secondary query class using the current class as primary query
     */
    public function useLandQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLand($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Land', '\Model\Custom\NovumBurger\Stam\LandQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Stam\Geslacht object
     *
     * @param \Model\Custom\NovumBurger\Stam\Geslacht|ObjectCollection $geslacht The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByGeslacht($geslacht, $comparison = null)
    {
        if ($geslacht instanceof \Model\Custom\NovumBurger\Stam\Geslacht) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_GESLACHT_ID, $geslacht->getId(), $comparison);
        } elseif ($geslacht instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersoonTableMap::COL_GESLACHT_ID, $geslacht->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGeslacht() only accepts arguments of type \Model\Custom\NovumBurger\Stam\Geslacht or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Geslacht relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinGeslacht($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Geslacht');

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
            $this->addJoinObject($join, 'Geslacht');
        }

        return $this;
    }

    /**
     * Use the Geslacht relation Geslacht object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Stam\GeslachtQuery A secondary query class using the current class as primary query
     */
    public function useGeslachtQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeslacht($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Geslacht', '\Model\Custom\NovumBurger\Stam\GeslachtQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon|ObjectCollection $persoon The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByFkVader($persoon, $comparison = null)
    {
        if ($persoon instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_VADER_ID, $persoon->getId(), $comparison);
        } elseif ($persoon instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersoonTableMap::COL_VADER_ID, $persoon->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFkVader() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FkVader relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinFkVader($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FkVader');

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
            $this->addJoinObject($join, 'FkVader');
        }

        return $this;
    }

    /**
     * Use the FkVader relation Persoon object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery A secondary query class using the current class as primary query
     */
    public function useFkVaderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFkVader($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FkVader', '\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon|ObjectCollection $persoon The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByFkMoeder($persoon, $comparison = null)
    {
        if ($persoon instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_MOEDER_ID, $persoon->getId(), $comparison);
        } elseif ($persoon instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersoonTableMap::COL_MOEDER_ID, $persoon->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFkMoeder() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FkMoeder relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinFkMoeder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FkMoeder');

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
            $this->addJoinObject($join, 'FkMoeder');
        }

        return $this;
    }

    /**
     * Use the FkMoeder relation Persoon object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery A secondary query class using the current class as primary query
     */
    public function useFkMoederQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFkMoeder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FkMoeder', '\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon|ObjectCollection $persoon the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByPersoonRelatedById0($persoon, $comparison = null)
    {
        if ($persoon instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_ID, $persoon->getVader(), $comparison);
        } elseif ($persoon instanceof ObjectCollection) {
            return $this
                ->usePersoonRelatedById0Query()
                ->filterByPrimaryKeys($persoon->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersoonRelatedById0() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PersoonRelatedById0 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinPersoonRelatedById0($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PersoonRelatedById0');

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
            $this->addJoinObject($join, 'PersoonRelatedById0');
        }

        return $this;
    }

    /**
     * Use the PersoonRelatedById0 relation Persoon object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery A secondary query class using the current class as primary query
     */
    public function usePersoonRelatedById0Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPersoonRelatedById0($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PersoonRelatedById0', '\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon|ObjectCollection $persoon the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByPersoonRelatedById1($persoon, $comparison = null)
    {
        if ($persoon instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_ID, $persoon->getMoeder(), $comparison);
        } elseif ($persoon instanceof ObjectCollection) {
            return $this
                ->usePersoonRelatedById1Query()
                ->filterByPrimaryKeys($persoon->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersoonRelatedById1() only accepts arguments of type \Model\Custom\NovumBurger\Persoonsgegevens\Persoon or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PersoonRelatedById1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function joinPersoonRelatedById1($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PersoonRelatedById1');

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
            $this->addJoinObject($join, 'PersoonRelatedById1');
        }

        return $this;
    }

    /**
     * Use the PersoonRelatedById1 relation Persoon object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery A secondary query class using the current class as primary query
     */
    public function usePersoonRelatedById1Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPersoonRelatedById1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PersoonRelatedById1', '\Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery');
    }

    /**
     * Filter the query by a related \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie object
     *
     * @param \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie|ObjectCollection $persoon_relatie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersoonQuery The current query, for fluid interface
     */
    public function filterByPersoon_relatie($persoon_relatie, $comparison = null)
    {
        if ($persoon_relatie instanceof \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie) {
            return $this
                ->addUsingAlias(PersoonTableMap::COL_ID, $persoon_relatie->getPersoonId(), $comparison);
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
     * @return $this|ChildPersoonQuery The current query, for fluid interface
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
     * @param   ChildPersoon $persoon Object to remove from the list of results
     *
     * @return $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function prune($persoon = null)
    {
        if ($persoon) {
            $this->addUsingAlias(PersoonTableMap::COL_ID, $persoon->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the persoon table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PersoonTableMap::clearInstancePool();
            PersoonTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PersoonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PersoonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PersoonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PersoonTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PersoonTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PersoonTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PersoonTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PersoonTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildPersoonQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PersoonTableMap::COL_CREATED_AT);
    }

} // PersoonQuery
