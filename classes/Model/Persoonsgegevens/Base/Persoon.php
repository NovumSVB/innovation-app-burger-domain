<?php

namespace Model\Custom\NovumBurger\Persoonsgegevens\Base;

use \DateTime;
use \Exception;
use \PDO;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon as ChildPersoon;
use Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery as ChildPersoonQuery;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie as ChildPersoon_relatie;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery as ChildPersoon_relatieQuery;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\PersoonTableMap;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\Persoon_relatieTableMap;
use Model\Custom\NovumBurger\Stam\Geslacht;
use Model\Custom\NovumBurger\Stam\GeslachtQuery;
use Model\Custom\NovumBurger\Stam\Land;
use Model\Custom\NovumBurger\Stam\LandQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'persoon' table.
 *
 *
 *
 * @package    propel.generator.Model.Custom.NovumBurger.Persoonsgegevens.Base
 */
abstract class Persoon implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Map\\PersoonTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the bsn field.
     *
     * @var        string
     */
    protected $bsn;

    /**
     * The value for the infix field.
     *
     * @var        string
     */
    protected $infix;

    /**
     * The value for the voornaam field.
     *
     * @var        string
     */
    protected $voornaam;

    /**
     * The value for the achternaam field.
     *
     * @var        string
     */
    protected $achternaam;

    /**
     * The value for the vader_id field.
     *
     * @var        int
     */
    protected $vader_id;

    /**
     * The value for the moeder_id field.
     *
     * @var        int
     */
    protected $moeder_id;

    /**
     * The value for the geslacht_id field.
     *
     * @var        int
     */
    protected $geslacht_id;

    /**
     * The value for the geboorte_datum field.
     *
     * @var        DateTime
     */
    protected $geboorte_datum;

    /**
     * The value for the geboorte_plaats field.
     *
     * @var        string
     */
    protected $geboorte_plaats;

    /**
     * The value for the geboorte_land_id field.
     *
     * @var        int
     */
    protected $geboorte_land_id;

    /**
     * The value for the immigratie_datum field.
     *
     * @var        DateTime
     */
    protected $immigratie_datum;

    /**
     * The value for the heeft_nl_paspoort field.
     *
     * @var        boolean
     */
    protected $heeft_nl_paspoort;

    /**
     * The value for the sterf_datum field.
     *
     * @var        DateTime
     */
    protected $sterf_datum;

    /**
     * The value for the sterf_plaats field.
     *
     * @var        string
     */
    protected $sterf_plaats;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * @var        Land
     */
    protected $aLand;

    /**
     * @var        Geslacht
     */
    protected $aGeslacht;

    /**
     * @var        ChildPersoon
     */
    protected $aFkVader;

    /**
     * @var        ChildPersoon
     */
    protected $aFkMoeder;

    /**
     * @var        ObjectCollection|ChildPersoon[] Collection to store aggregation of ChildPersoon objects.
     */
    protected $collPersoonsRelatedById0;
    protected $collPersoonsRelatedById0Partial;

    /**
     * @var        ObjectCollection|ChildPersoon[] Collection to store aggregation of ChildPersoon objects.
     */
    protected $collPersoonsRelatedById1;
    protected $collPersoonsRelatedById1Partial;

    /**
     * @var        ObjectCollection|ChildPersoon_relatie[] Collection to store aggregation of ChildPersoon_relatie objects.
     */
    protected $collPersoon_relaties;
    protected $collPersoon_relatiesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersoon[]
     */
    protected $persoonsRelatedById0ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersoon[]
     */
    protected $persoonsRelatedById1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersoon_relatie[]
     */
    protected $persoon_relatiesScheduledForDeletion = null;

    /**
     * Initializes internal state of Model\Custom\NovumBurger\Persoonsgegevens\Base\Persoon object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Persoon</code> instance.  If
     * <code>obj</code> is an instance of <code>Persoon</code>, delegates to
     * <code>equals(Persoon)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Persoon The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [bsn] column value.
     *
     * @return string
     */
    public function getBsn()
    {
        return $this->bsn;
    }

    /**
     * Get the [infix] column value.
     *
     * @return string
     */
    public function getInfix()
    {
        return $this->infix;
    }

    /**
     * Get the [voornaam] column value.
     *
     * @return string
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Get the [achternaam] column value.
     *
     * @return string
     */
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    /**
     * Get the [vader_id] column value.
     *
     * @return int
     */
    public function getVader()
    {
        return $this->vader_id;
    }

    /**
     * Get the [moeder_id] column value.
     *
     * @return int
     */
    public function getMoeder()
    {
        return $this->moeder_id;
    }

    /**
     * Get the [geslacht_id] column value.
     *
     * @return int
     */
    public function getGeslachtId()
    {
        return $this->geslacht_id;
    }

    /**
     * Get the [optionally formatted] temporal [geboorte_datum] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getGeboorteDatum($format = NULL)
    {
        if ($format === null) {
            return $this->geboorte_datum;
        } else {
            return $this->geboorte_datum instanceof \DateTimeInterface ? $this->geboorte_datum->format($format) : null;
        }
    }

    /**
     * Get the [geboorte_plaats] column value.
     *
     * @return string
     */
    public function getGeboortePlaats()
    {
        return $this->geboorte_plaats;
    }

    /**
     * Get the [geboorte_land_id] column value.
     *
     * @return int
     */
    public function getGeboorteLand()
    {
        return $this->geboorte_land_id;
    }

    /**
     * Get the [optionally formatted] temporal [immigratie_datum] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getImmigratiedatum($format = NULL)
    {
        if ($format === null) {
            return $this->immigratie_datum;
        } else {
            return $this->immigratie_datum instanceof \DateTimeInterface ? $this->immigratie_datum->format($format) : null;
        }
    }

    /**
     * Get the [heeft_nl_paspoort] column value.
     *
     * @return boolean
     */
    public function getHeeftNederlandsPaspoort()
    {
        return $this->heeft_nl_paspoort;
    }

    /**
     * Get the [heeft_nl_paspoort] column value.
     *
     * @return boolean
     */
    public function isHeeftNederlandsPaspoort()
    {
        return $this->getHeeftNederlandsPaspoort();
    }

    /**
     * Get the [optionally formatted] temporal [sterf_datum] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSterfDatum($format = NULL)
    {
        if ($format === null) {
            return $this->sterf_datum;
        } else {
            return $this->sterf_datum instanceof \DateTimeInterface ? $this->sterf_datum->format($format) : null;
        }
    }

    /**
     * Get the [sterf_plaats] column value.
     *
     * @return string
     */
    public function getSterfPlaats()
    {
        return $this->sterf_plaats;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PersoonTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [bsn] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setBsn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bsn !== $v) {
            $this->bsn = $v;
            $this->modifiedColumns[PersoonTableMap::COL_BSN] = true;
        }

        return $this;
    } // setBsn()

    /**
     * Set the value of [infix] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setInfix($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->infix !== $v) {
            $this->infix = $v;
            $this->modifiedColumns[PersoonTableMap::COL_INFIX] = true;
        }

        return $this;
    } // setInfix()

    /**
     * Set the value of [voornaam] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setVoornaam($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->voornaam !== $v) {
            $this->voornaam = $v;
            $this->modifiedColumns[PersoonTableMap::COL_VOORNAAM] = true;
        }

        return $this;
    } // setVoornaam()

    /**
     * Set the value of [achternaam] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setAchternaam($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->achternaam !== $v) {
            $this->achternaam = $v;
            $this->modifiedColumns[PersoonTableMap::COL_ACHTERNAAM] = true;
        }

        return $this;
    } // setAchternaam()

    /**
     * Set the value of [vader_id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setVader($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vader_id !== $v) {
            $this->vader_id = $v;
            $this->modifiedColumns[PersoonTableMap::COL_VADER_ID] = true;
        }

        if ($this->aFkVader !== null && $this->aFkVader->getId() !== $v) {
            $this->aFkVader = null;
        }

        return $this;
    } // setVader()

    /**
     * Set the value of [moeder_id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setMoeder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->moeder_id !== $v) {
            $this->moeder_id = $v;
            $this->modifiedColumns[PersoonTableMap::COL_MOEDER_ID] = true;
        }

        if ($this->aFkMoeder !== null && $this->aFkMoeder->getId() !== $v) {
            $this->aFkMoeder = null;
        }

        return $this;
    } // setMoeder()

    /**
     * Set the value of [geslacht_id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setGeslachtId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->geslacht_id !== $v) {
            $this->geslacht_id = $v;
            $this->modifiedColumns[PersoonTableMap::COL_GESLACHT_ID] = true;
        }

        if ($this->aGeslacht !== null && $this->aGeslacht->getId() !== $v) {
            $this->aGeslacht = null;
        }

        return $this;
    } // setGeslachtId()

    /**
     * Sets the value of [geboorte_datum] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setGeboorteDatum($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->geboorte_datum !== null || $dt !== null) {
            if ($this->geboorte_datum === null || $dt === null || $dt->format("Y-m-d") !== $this->geboorte_datum->format("Y-m-d")) {
                $this->geboorte_datum = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersoonTableMap::COL_GEBOORTE_DATUM] = true;
            }
        } // if either are not null

        return $this;
    } // setGeboorteDatum()

    /**
     * Set the value of [geboorte_plaats] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setGeboortePlaats($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geboorte_plaats !== $v) {
            $this->geboorte_plaats = $v;
            $this->modifiedColumns[PersoonTableMap::COL_GEBOORTE_PLAATS] = true;
        }

        return $this;
    } // setGeboortePlaats()

    /**
     * Set the value of [geboorte_land_id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setGeboorteLand($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->geboorte_land_id !== $v) {
            $this->geboorte_land_id = $v;
            $this->modifiedColumns[PersoonTableMap::COL_GEBOORTE_LAND_ID] = true;
        }

        if ($this->aLand !== null && $this->aLand->getId() !== $v) {
            $this->aLand = null;
        }

        return $this;
    } // setGeboorteLand()

    /**
     * Sets the value of [immigratie_datum] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setImmigratiedatum($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->immigratie_datum !== null || $dt !== null) {
            if ($this->immigratie_datum === null || $dt === null || $dt->format("Y-m-d") !== $this->immigratie_datum->format("Y-m-d")) {
                $this->immigratie_datum = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersoonTableMap::COL_IMMIGRATIE_DATUM] = true;
            }
        } // if either are not null

        return $this;
    } // setImmigratiedatum()

    /**
     * Sets the value of the [heeft_nl_paspoort] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setHeeftNederlandsPaspoort($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->heeft_nl_paspoort !== $v) {
            $this->heeft_nl_paspoort = $v;
            $this->modifiedColumns[PersoonTableMap::COL_HEEFT_NL_PASPOORT] = true;
        }

        return $this;
    } // setHeeftNederlandsPaspoort()

    /**
     * Sets the value of [sterf_datum] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setSterfDatum($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sterf_datum !== null || $dt !== null) {
            if ($this->sterf_datum === null || $dt === null || $dt->format("Y-m-d") !== $this->sterf_datum->format("Y-m-d")) {
                $this->sterf_datum = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersoonTableMap::COL_STERF_DATUM] = true;
            }
        } // if either are not null

        return $this;
    } // setSterfDatum()

    /**
     * Set the value of [sterf_plaats] column.
     *
     * @param string $v new value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setSterfPlaats($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sterf_plaats !== $v) {
            $this->sterf_plaats = $v;
            $this->modifiedColumns[PersoonTableMap::COL_STERF_PLAATS] = true;
        }

        return $this;
    } // setSterfPlaats()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersoonTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersoonTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PersoonTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PersoonTableMap::translateFieldName('Bsn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bsn = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PersoonTableMap::translateFieldName('Infix', TableMap::TYPE_PHPNAME, $indexType)];
            $this->infix = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PersoonTableMap::translateFieldName('Voornaam', TableMap::TYPE_PHPNAME, $indexType)];
            $this->voornaam = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PersoonTableMap::translateFieldName('Achternaam', TableMap::TYPE_PHPNAME, $indexType)];
            $this->achternaam = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PersoonTableMap::translateFieldName('Vader', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vader_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PersoonTableMap::translateFieldName('Moeder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moeder_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PersoonTableMap::translateFieldName('GeslachtId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geslacht_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PersoonTableMap::translateFieldName('GeboorteDatum', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->geboorte_datum = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PersoonTableMap::translateFieldName('GeboortePlaats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geboorte_plaats = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PersoonTableMap::translateFieldName('GeboorteLand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geboorte_land_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PersoonTableMap::translateFieldName('Immigratiedatum', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->immigratie_datum = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PersoonTableMap::translateFieldName('HeeftNederlandsPaspoort', TableMap::TYPE_PHPNAME, $indexType)];
            $this->heeft_nl_paspoort = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PersoonTableMap::translateFieldName('SterfDatum', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->sterf_datum = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PersoonTableMap::translateFieldName('SterfPlaats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sterf_plaats = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PersoonTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PersoonTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = PersoonTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Custom\\NovumBurger\\Persoonsgegevens\\Persoon'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aFkVader !== null && $this->vader_id !== $this->aFkVader->getId()) {
            $this->aFkVader = null;
        }
        if ($this->aFkMoeder !== null && $this->moeder_id !== $this->aFkMoeder->getId()) {
            $this->aFkMoeder = null;
        }
        if ($this->aGeslacht !== null && $this->geslacht_id !== $this->aGeslacht->getId()) {
            $this->aGeslacht = null;
        }
        if ($this->aLand !== null && $this->geboorte_land_id !== $this->aLand->getId()) {
            $this->aLand = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersoonTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPersoonQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLand = null;
            $this->aGeslacht = null;
            $this->aFkVader = null;
            $this->aFkMoeder = null;
            $this->collPersoonsRelatedById0 = null;

            $this->collPersoonsRelatedById1 = null;

            $this->collPersoon_relaties = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Persoon::setDeleted()
     * @see Persoon::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPersoonQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersoonTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(PersoonTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(PersoonTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PersoonTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PersoonTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLand !== null) {
                if ($this->aLand->isModified() || $this->aLand->isNew()) {
                    $affectedRows += $this->aLand->save($con);
                }
                $this->setLand($this->aLand);
            }

            if ($this->aGeslacht !== null) {
                if ($this->aGeslacht->isModified() || $this->aGeslacht->isNew()) {
                    $affectedRows += $this->aGeslacht->save($con);
                }
                $this->setGeslacht($this->aGeslacht);
            }

            if ($this->aFkVader !== null) {
                if ($this->aFkVader->isModified() || $this->aFkVader->isNew()) {
                    $affectedRows += $this->aFkVader->save($con);
                }
                $this->setFkVader($this->aFkVader);
            }

            if ($this->aFkMoeder !== null) {
                if ($this->aFkMoeder->isModified() || $this->aFkMoeder->isNew()) {
                    $affectedRows += $this->aFkMoeder->save($con);
                }
                $this->setFkMoeder($this->aFkMoeder);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->persoonsRelatedById0ScheduledForDeletion !== null) {
                if (!$this->persoonsRelatedById0ScheduledForDeletion->isEmpty()) {
                    foreach ($this->persoonsRelatedById0ScheduledForDeletion as $persoonRelatedById0) {
                        // need to save related object because we set the relation to null
                        $persoonRelatedById0->save($con);
                    }
                    $this->persoonsRelatedById0ScheduledForDeletion = null;
                }
            }

            if ($this->collPersoonsRelatedById0 !== null) {
                foreach ($this->collPersoonsRelatedById0 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->persoonsRelatedById1ScheduledForDeletion !== null) {
                if (!$this->persoonsRelatedById1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->persoonsRelatedById1ScheduledForDeletion as $persoonRelatedById1) {
                        // need to save related object because we set the relation to null
                        $persoonRelatedById1->save($con);
                    }
                    $this->persoonsRelatedById1ScheduledForDeletion = null;
                }
            }

            if ($this->collPersoonsRelatedById1 !== null) {
                foreach ($this->collPersoonsRelatedById1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->persoon_relatiesScheduledForDeletion !== null) {
                if (!$this->persoon_relatiesScheduledForDeletion->isEmpty()) {
                    \Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery::create()
                        ->filterByPrimaryKeys($this->persoon_relatiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->persoon_relatiesScheduledForDeletion = null;
                }
            }

            if ($this->collPersoon_relaties !== null) {
                foreach ($this->collPersoon_relaties as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PersoonTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PersoonTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PersoonTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_BSN)) {
            $modifiedColumns[':p' . $index++]  = 'bsn';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_INFIX)) {
            $modifiedColumns[':p' . $index++]  = 'infix';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_VOORNAAM)) {
            $modifiedColumns[':p' . $index++]  = 'voornaam';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_ACHTERNAAM)) {
            $modifiedColumns[':p' . $index++]  = 'achternaam';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_VADER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'vader_id';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_MOEDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'moeder_id';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GESLACHT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'geslacht_id';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_DATUM)) {
            $modifiedColumns[':p' . $index++]  = 'geboorte_datum';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_PLAATS)) {
            $modifiedColumns[':p' . $index++]  = 'geboorte_plaats';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_LAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'geboorte_land_id';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_IMMIGRATIE_DATUM)) {
            $modifiedColumns[':p' . $index++]  = 'immigratie_datum';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_HEEFT_NL_PASPOORT)) {
            $modifiedColumns[':p' . $index++]  = 'heeft_nl_paspoort';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_STERF_DATUM)) {
            $modifiedColumns[':p' . $index++]  = 'sterf_datum';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_STERF_PLAATS)) {
            $modifiedColumns[':p' . $index++]  = 'sterf_plaats';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PersoonTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO persoon (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'bsn':
                        $stmt->bindValue($identifier, $this->bsn, PDO::PARAM_STR);
                        break;
                    case 'infix':
                        $stmt->bindValue($identifier, $this->infix, PDO::PARAM_STR);
                        break;
                    case 'voornaam':
                        $stmt->bindValue($identifier, $this->voornaam, PDO::PARAM_STR);
                        break;
                    case 'achternaam':
                        $stmt->bindValue($identifier, $this->achternaam, PDO::PARAM_STR);
                        break;
                    case 'vader_id':
                        $stmt->bindValue($identifier, $this->vader_id, PDO::PARAM_INT);
                        break;
                    case 'moeder_id':
                        $stmt->bindValue($identifier, $this->moeder_id, PDO::PARAM_INT);
                        break;
                    case 'geslacht_id':
                        $stmt->bindValue($identifier, $this->geslacht_id, PDO::PARAM_INT);
                        break;
                    case 'geboorte_datum':
                        $stmt->bindValue($identifier, $this->geboorte_datum ? $this->geboorte_datum->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'geboorte_plaats':
                        $stmt->bindValue($identifier, $this->geboorte_plaats, PDO::PARAM_STR);
                        break;
                    case 'geboorte_land_id':
                        $stmt->bindValue($identifier, $this->geboorte_land_id, PDO::PARAM_INT);
                        break;
                    case 'immigratie_datum':
                        $stmt->bindValue($identifier, $this->immigratie_datum ? $this->immigratie_datum->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'heeft_nl_paspoort':
                        $stmt->bindValue($identifier, (int) $this->heeft_nl_paspoort, PDO::PARAM_INT);
                        break;
                    case 'sterf_datum':
                        $stmt->bindValue($identifier, $this->sterf_datum ? $this->sterf_datum->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'sterf_plaats':
                        $stmt->bindValue($identifier, $this->sterf_plaats, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersoonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getBsn();
                break;
            case 2:
                return $this->getInfix();
                break;
            case 3:
                return $this->getVoornaam();
                break;
            case 4:
                return $this->getAchternaam();
                break;
            case 5:
                return $this->getVader();
                break;
            case 6:
                return $this->getMoeder();
                break;
            case 7:
                return $this->getGeslachtId();
                break;
            case 8:
                return $this->getGeboorteDatum();
                break;
            case 9:
                return $this->getGeboortePlaats();
                break;
            case 10:
                return $this->getGeboorteLand();
                break;
            case 11:
                return $this->getImmigratiedatum();
                break;
            case 12:
                return $this->getHeeftNederlandsPaspoort();
                break;
            case 13:
                return $this->getSterfDatum();
                break;
            case 14:
                return $this->getSterfPlaats();
                break;
            case 15:
                return $this->getCreatedAt();
                break;
            case 16:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Persoon'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Persoon'][$this->hashCode()] = true;
        $keys = PersoonTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBsn(),
            $keys[2] => $this->getInfix(),
            $keys[3] => $this->getVoornaam(),
            $keys[4] => $this->getAchternaam(),
            $keys[5] => $this->getVader(),
            $keys[6] => $this->getMoeder(),
            $keys[7] => $this->getGeslachtId(),
            $keys[8] => $this->getGeboorteDatum(),
            $keys[9] => $this->getGeboortePlaats(),
            $keys[10] => $this->getGeboorteLand(),
            $keys[11] => $this->getImmigratiedatum(),
            $keys[12] => $this->getHeeftNederlandsPaspoort(),
            $keys[13] => $this->getSterfDatum(),
            $keys[14] => $this->getSterfPlaats(),
            $keys[15] => $this->getCreatedAt(),
            $keys[16] => $this->getUpdatedAt(),
        );
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLand) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'land';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'land';
                        break;
                    default:
                        $key = 'Land';
                }

                $result[$key] = $this->aLand->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeslacht) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geslacht';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geslacht';
                        break;
                    default:
                        $key = 'Geslacht';
                }

                $result[$key] = $this->aGeslacht->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFkVader) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'persoon';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'persoon';
                        break;
                    default:
                        $key = 'FkVader';
                }

                $result[$key] = $this->aFkVader->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFkMoeder) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'persoon';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'persoon';
                        break;
                    default:
                        $key = 'FkMoeder';
                }

                $result[$key] = $this->aFkMoeder->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPersoonsRelatedById0) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'persoons';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'persoons';
                        break;
                    default:
                        $key = 'Persoons';
                }

                $result[$key] = $this->collPersoonsRelatedById0->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPersoonsRelatedById1) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'persoons';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'persoons';
                        break;
                    default:
                        $key = 'Persoons';
                }

                $result[$key] = $this->collPersoonsRelatedById1->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPersoon_relaties) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'persoon_relaties';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'persoon_relaties';
                        break;
                    default:
                        $key = 'Persoon_relaties';
                }

                $result[$key] = $this->collPersoon_relaties->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersoonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setBsn($value);
                break;
            case 2:
                $this->setInfix($value);
                break;
            case 3:
                $this->setVoornaam($value);
                break;
            case 4:
                $this->setAchternaam($value);
                break;
            case 5:
                $this->setVader($value);
                break;
            case 6:
                $this->setMoeder($value);
                break;
            case 7:
                $this->setGeslachtId($value);
                break;
            case 8:
                $this->setGeboorteDatum($value);
                break;
            case 9:
                $this->setGeboortePlaats($value);
                break;
            case 10:
                $this->setGeboorteLand($value);
                break;
            case 11:
                $this->setImmigratiedatum($value);
                break;
            case 12:
                $this->setHeeftNederlandsPaspoort($value);
                break;
            case 13:
                $this->setSterfDatum($value);
                break;
            case 14:
                $this->setSterfPlaats($value);
                break;
            case 15:
                $this->setCreatedAt($value);
                break;
            case 16:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PersoonTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBsn($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setInfix($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setVoornaam($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAchternaam($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVader($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMoeder($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGeslachtId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setGeboorteDatum($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setGeboortePlaats($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setGeboorteLand($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setImmigratiedatum($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHeeftNederlandsPaspoort($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSterfDatum($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setSterfPlaats($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCreatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setUpdatedAt($arr[$keys[16]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PersoonTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PersoonTableMap::COL_ID)) {
            $criteria->add(PersoonTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_BSN)) {
            $criteria->add(PersoonTableMap::COL_BSN, $this->bsn);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_INFIX)) {
            $criteria->add(PersoonTableMap::COL_INFIX, $this->infix);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_VOORNAAM)) {
            $criteria->add(PersoonTableMap::COL_VOORNAAM, $this->voornaam);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_ACHTERNAAM)) {
            $criteria->add(PersoonTableMap::COL_ACHTERNAAM, $this->achternaam);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_VADER_ID)) {
            $criteria->add(PersoonTableMap::COL_VADER_ID, $this->vader_id);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_MOEDER_ID)) {
            $criteria->add(PersoonTableMap::COL_MOEDER_ID, $this->moeder_id);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GESLACHT_ID)) {
            $criteria->add(PersoonTableMap::COL_GESLACHT_ID, $this->geslacht_id);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_DATUM)) {
            $criteria->add(PersoonTableMap::COL_GEBOORTE_DATUM, $this->geboorte_datum);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_PLAATS)) {
            $criteria->add(PersoonTableMap::COL_GEBOORTE_PLAATS, $this->geboorte_plaats);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_GEBOORTE_LAND_ID)) {
            $criteria->add(PersoonTableMap::COL_GEBOORTE_LAND_ID, $this->geboorte_land_id);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_IMMIGRATIE_DATUM)) {
            $criteria->add(PersoonTableMap::COL_IMMIGRATIE_DATUM, $this->immigratie_datum);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_HEEFT_NL_PASPOORT)) {
            $criteria->add(PersoonTableMap::COL_HEEFT_NL_PASPOORT, $this->heeft_nl_paspoort);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_STERF_DATUM)) {
            $criteria->add(PersoonTableMap::COL_STERF_DATUM, $this->sterf_datum);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_STERF_PLAATS)) {
            $criteria->add(PersoonTableMap::COL_STERF_PLAATS, $this->sterf_plaats);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_CREATED_AT)) {
            $criteria->add(PersoonTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PersoonTableMap::COL_UPDATED_AT)) {
            $criteria->add(PersoonTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPersoonQuery::create();
        $criteria->add(PersoonTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\Custom\NovumBurger\Persoonsgegevens\Persoon (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBsn($this->getBsn());
        $copyObj->setInfix($this->getInfix());
        $copyObj->setVoornaam($this->getVoornaam());
        $copyObj->setAchternaam($this->getAchternaam());
        $copyObj->setVader($this->getVader());
        $copyObj->setMoeder($this->getMoeder());
        $copyObj->setGeslachtId($this->getGeslachtId());
        $copyObj->setGeboorteDatum($this->getGeboorteDatum());
        $copyObj->setGeboortePlaats($this->getGeboortePlaats());
        $copyObj->setGeboorteLand($this->getGeboorteLand());
        $copyObj->setImmigratiedatum($this->getImmigratiedatum());
        $copyObj->setHeeftNederlandsPaspoort($this->getHeeftNederlandsPaspoort());
        $copyObj->setSterfDatum($this->getSterfDatum());
        $copyObj->setSterfPlaats($this->getSterfPlaats());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPersoonsRelatedById0() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersoonRelatedById0($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPersoonsRelatedById1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersoonRelatedById1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPersoon_relaties() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersoon_relatie($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Model\Custom\NovumBurger\Persoonsgegevens\Persoon Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a Land object.
     *
     * @param  Land $v
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLand(Land $v = null)
    {
        if ($v === null) {
            $this->setGeboorteLand(NULL);
        } else {
            $this->setGeboorteLand($v->getId());
        }

        $this->aLand = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Land object, it will not be re-added.
        if ($v !== null) {
            $v->addPersoon($this);
        }


        return $this;
    }


    /**
     * Get the associated Land object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return Land The associated Land object.
     * @throws PropelException
     */
    public function getLand(ConnectionInterface $con = null)
    {
        if ($this->aLand === null && ($this->geboorte_land_id != 0)) {
            $this->aLand = LandQuery::create()->findPk($this->geboorte_land_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLand->addPersoons($this);
             */
        }

        return $this->aLand;
    }

    /**
     * Declares an association between this object and a Geslacht object.
     *
     * @param  Geslacht $v
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGeslacht(Geslacht $v = null)
    {
        if ($v === null) {
            $this->setGeslachtId(NULL);
        } else {
            $this->setGeslachtId($v->getId());
        }

        $this->aGeslacht = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Geslacht object, it will not be re-added.
        if ($v !== null) {
            $v->addPersoon($this);
        }


        return $this;
    }


    /**
     * Get the associated Geslacht object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return Geslacht The associated Geslacht object.
     * @throws PropelException
     */
    public function getGeslacht(ConnectionInterface $con = null)
    {
        if ($this->aGeslacht === null && ($this->geslacht_id != 0)) {
            $this->aGeslacht = GeslachtQuery::create()->findPk($this->geslacht_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeslacht->addPersoons($this);
             */
        }

        return $this->aGeslacht;
    }

    /**
     * Declares an association between this object and a ChildPersoon object.
     *
     * @param  ChildPersoon $v
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFkVader(ChildPersoon $v = null)
    {
        if ($v === null) {
            $this->setVader(NULL);
        } else {
            $this->setVader($v->getId());
        }

        $this->aFkVader = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPersoon object, it will not be re-added.
        if ($v !== null) {
            $v->addPersoonRelatedById0($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPersoon object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPersoon The associated ChildPersoon object.
     * @throws PropelException
     */
    public function getFkVader(ConnectionInterface $con = null)
    {
        if ($this->aFkVader === null && ($this->vader_id != 0)) {
            $this->aFkVader = ChildPersoonQuery::create()->findPk($this->vader_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFkVader->addPersoonsRelatedById0($this);
             */
        }

        return $this->aFkVader;
    }

    /**
     * Declares an association between this object and a ChildPersoon object.
     *
     * @param  ChildPersoon $v
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFkMoeder(ChildPersoon $v = null)
    {
        if ($v === null) {
            $this->setMoeder(NULL);
        } else {
            $this->setMoeder($v->getId());
        }

        $this->aFkMoeder = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPersoon object, it will not be re-added.
        if ($v !== null) {
            $v->addPersoonRelatedById1($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPersoon object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPersoon The associated ChildPersoon object.
     * @throws PropelException
     */
    public function getFkMoeder(ConnectionInterface $con = null)
    {
        if ($this->aFkMoeder === null && ($this->moeder_id != 0)) {
            $this->aFkMoeder = ChildPersoonQuery::create()->findPk($this->moeder_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFkMoeder->addPersoonsRelatedById1($this);
             */
        }

        return $this->aFkMoeder;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PersoonRelatedById0' == $relationName) {
            $this->initPersoonsRelatedById0();
            return;
        }
        if ('PersoonRelatedById1' == $relationName) {
            $this->initPersoonsRelatedById1();
            return;
        }
        if ('Persoon_relatie' == $relationName) {
            $this->initPersoon_relaties();
            return;
        }
    }

    /**
     * Clears out the collPersoonsRelatedById0 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersoonsRelatedById0()
     */
    public function clearPersoonsRelatedById0()
    {
        $this->collPersoonsRelatedById0 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersoonsRelatedById0 collection loaded partially.
     */
    public function resetPartialPersoonsRelatedById0($v = true)
    {
        $this->collPersoonsRelatedById0Partial = $v;
    }

    /**
     * Initializes the collPersoonsRelatedById0 collection.
     *
     * By default this just sets the collPersoonsRelatedById0 collection to an empty array (like clearcollPersoonsRelatedById0());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersoonsRelatedById0($overrideExisting = true)
    {
        if (null !== $this->collPersoonsRelatedById0 && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersoonTableMap::getTableMap()->getCollectionClassName();

        $this->collPersoonsRelatedById0 = new $collectionClassName;
        $this->collPersoonsRelatedById0->setModel('\Model\Custom\NovumBurger\Persoonsgegevens\Persoon');
    }

    /**
     * Gets an array of ChildPersoon objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPersoon is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     * @throws PropelException
     */
    public function getPersoonsRelatedById0(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoonsRelatedById0Partial && !$this->isNew();
        if (null === $this->collPersoonsRelatedById0 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersoonsRelatedById0) {
                // return empty collection
                $this->initPersoonsRelatedById0();
            } else {
                $collPersoonsRelatedById0 = ChildPersoonQuery::create(null, $criteria)
                    ->filterByFkVader($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersoonsRelatedById0Partial && count($collPersoonsRelatedById0)) {
                        $this->initPersoonsRelatedById0(false);

                        foreach ($collPersoonsRelatedById0 as $obj) {
                            if (false == $this->collPersoonsRelatedById0->contains($obj)) {
                                $this->collPersoonsRelatedById0->append($obj);
                            }
                        }

                        $this->collPersoonsRelatedById0Partial = true;
                    }

                    return $collPersoonsRelatedById0;
                }

                if ($partial && $this->collPersoonsRelatedById0) {
                    foreach ($this->collPersoonsRelatedById0 as $obj) {
                        if ($obj->isNew()) {
                            $collPersoonsRelatedById0[] = $obj;
                        }
                    }
                }

                $this->collPersoonsRelatedById0 = $collPersoonsRelatedById0;
                $this->collPersoonsRelatedById0Partial = false;
            }
        }

        return $this->collPersoonsRelatedById0;
    }

    /**
     * Sets a collection of ChildPersoon objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $persoonsRelatedById0 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function setPersoonsRelatedById0(Collection $persoonsRelatedById0, ConnectionInterface $con = null)
    {
        /** @var ChildPersoon[] $persoonsRelatedById0ToDelete */
        $persoonsRelatedById0ToDelete = $this->getPersoonsRelatedById0(new Criteria(), $con)->diff($persoonsRelatedById0);


        $this->persoonsRelatedById0ScheduledForDeletion = $persoonsRelatedById0ToDelete;

        foreach ($persoonsRelatedById0ToDelete as $persoonRelatedById0Removed) {
            $persoonRelatedById0Removed->setFkVader(null);
        }

        $this->collPersoonsRelatedById0 = null;
        foreach ($persoonsRelatedById0 as $persoonRelatedById0) {
            $this->addPersoonRelatedById0($persoonRelatedById0);
        }

        $this->collPersoonsRelatedById0 = $persoonsRelatedById0;
        $this->collPersoonsRelatedById0Partial = false;

        return $this;
    }

    /**
     * Returns the number of related Persoon objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Persoon objects.
     * @throws PropelException
     */
    public function countPersoonsRelatedById0(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoonsRelatedById0Partial && !$this->isNew();
        if (null === $this->collPersoonsRelatedById0 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersoonsRelatedById0) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersoonsRelatedById0());
            }

            $query = ChildPersoonQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFkVader($this)
                ->count($con);
        }

        return count($this->collPersoonsRelatedById0);
    }

    /**
     * Method called to associate a ChildPersoon object to this object
     * through the ChildPersoon foreign key attribute.
     *
     * @param  ChildPersoon $l ChildPersoon
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function addPersoonRelatedById0(ChildPersoon $l)
    {
        if ($this->collPersoonsRelatedById0 === null) {
            $this->initPersoonsRelatedById0();
            $this->collPersoonsRelatedById0Partial = true;
        }

        if (!$this->collPersoonsRelatedById0->contains($l)) {
            $this->doAddPersoonRelatedById0($l);

            if ($this->persoonsRelatedById0ScheduledForDeletion and $this->persoonsRelatedById0ScheduledForDeletion->contains($l)) {
                $this->persoonsRelatedById0ScheduledForDeletion->remove($this->persoonsRelatedById0ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersoon $persoonRelatedById0 The ChildPersoon object to add.
     */
    protected function doAddPersoonRelatedById0(ChildPersoon $persoonRelatedById0)
    {
        $this->collPersoonsRelatedById0[]= $persoonRelatedById0;
        $persoonRelatedById0->setFkVader($this);
    }

    /**
     * @param  ChildPersoon $persoonRelatedById0 The ChildPersoon object to remove.
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function removePersoonRelatedById0(ChildPersoon $persoonRelatedById0)
    {
        if ($this->getPersoonsRelatedById0()->contains($persoonRelatedById0)) {
            $pos = $this->collPersoonsRelatedById0->search($persoonRelatedById0);
            $this->collPersoonsRelatedById0->remove($pos);
            if (null === $this->persoonsRelatedById0ScheduledForDeletion) {
                $this->persoonsRelatedById0ScheduledForDeletion = clone $this->collPersoonsRelatedById0;
                $this->persoonsRelatedById0ScheduledForDeletion->clear();
            }
            $this->persoonsRelatedById0ScheduledForDeletion[]= $persoonRelatedById0;
            $persoonRelatedById0->setFkVader(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Persoon is new, it will return
     * an empty collection; or if this Persoon has previously
     * been saved, it will retrieve related PersoonsRelatedById0 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Persoon.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     */
    public function getPersoonsRelatedById0JoinLand(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersoonQuery::create(null, $criteria);
        $query->joinWith('Land', $joinBehavior);

        return $this->getPersoonsRelatedById0($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Persoon is new, it will return
     * an empty collection; or if this Persoon has previously
     * been saved, it will retrieve related PersoonsRelatedById0 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Persoon.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     */
    public function getPersoonsRelatedById0JoinGeslacht(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersoonQuery::create(null, $criteria);
        $query->joinWith('Geslacht', $joinBehavior);

        return $this->getPersoonsRelatedById0($query, $con);
    }

    /**
     * Clears out the collPersoonsRelatedById1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersoonsRelatedById1()
     */
    public function clearPersoonsRelatedById1()
    {
        $this->collPersoonsRelatedById1 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersoonsRelatedById1 collection loaded partially.
     */
    public function resetPartialPersoonsRelatedById1($v = true)
    {
        $this->collPersoonsRelatedById1Partial = $v;
    }

    /**
     * Initializes the collPersoonsRelatedById1 collection.
     *
     * By default this just sets the collPersoonsRelatedById1 collection to an empty array (like clearcollPersoonsRelatedById1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersoonsRelatedById1($overrideExisting = true)
    {
        if (null !== $this->collPersoonsRelatedById1 && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersoonTableMap::getTableMap()->getCollectionClassName();

        $this->collPersoonsRelatedById1 = new $collectionClassName;
        $this->collPersoonsRelatedById1->setModel('\Model\Custom\NovumBurger\Persoonsgegevens\Persoon');
    }

    /**
     * Gets an array of ChildPersoon objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPersoon is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     * @throws PropelException
     */
    public function getPersoonsRelatedById1(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoonsRelatedById1Partial && !$this->isNew();
        if (null === $this->collPersoonsRelatedById1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersoonsRelatedById1) {
                // return empty collection
                $this->initPersoonsRelatedById1();
            } else {
                $collPersoonsRelatedById1 = ChildPersoonQuery::create(null, $criteria)
                    ->filterByFkMoeder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersoonsRelatedById1Partial && count($collPersoonsRelatedById1)) {
                        $this->initPersoonsRelatedById1(false);

                        foreach ($collPersoonsRelatedById1 as $obj) {
                            if (false == $this->collPersoonsRelatedById1->contains($obj)) {
                                $this->collPersoonsRelatedById1->append($obj);
                            }
                        }

                        $this->collPersoonsRelatedById1Partial = true;
                    }

                    return $collPersoonsRelatedById1;
                }

                if ($partial && $this->collPersoonsRelatedById1) {
                    foreach ($this->collPersoonsRelatedById1 as $obj) {
                        if ($obj->isNew()) {
                            $collPersoonsRelatedById1[] = $obj;
                        }
                    }
                }

                $this->collPersoonsRelatedById1 = $collPersoonsRelatedById1;
                $this->collPersoonsRelatedById1Partial = false;
            }
        }

        return $this->collPersoonsRelatedById1;
    }

    /**
     * Sets a collection of ChildPersoon objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $persoonsRelatedById1 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function setPersoonsRelatedById1(Collection $persoonsRelatedById1, ConnectionInterface $con = null)
    {
        /** @var ChildPersoon[] $persoonsRelatedById1ToDelete */
        $persoonsRelatedById1ToDelete = $this->getPersoonsRelatedById1(new Criteria(), $con)->diff($persoonsRelatedById1);


        $this->persoonsRelatedById1ScheduledForDeletion = $persoonsRelatedById1ToDelete;

        foreach ($persoonsRelatedById1ToDelete as $persoonRelatedById1Removed) {
            $persoonRelatedById1Removed->setFkMoeder(null);
        }

        $this->collPersoonsRelatedById1 = null;
        foreach ($persoonsRelatedById1 as $persoonRelatedById1) {
            $this->addPersoonRelatedById1($persoonRelatedById1);
        }

        $this->collPersoonsRelatedById1 = $persoonsRelatedById1;
        $this->collPersoonsRelatedById1Partial = false;

        return $this;
    }

    /**
     * Returns the number of related Persoon objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Persoon objects.
     * @throws PropelException
     */
    public function countPersoonsRelatedById1(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoonsRelatedById1Partial && !$this->isNew();
        if (null === $this->collPersoonsRelatedById1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersoonsRelatedById1) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersoonsRelatedById1());
            }

            $query = ChildPersoonQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFkMoeder($this)
                ->count($con);
        }

        return count($this->collPersoonsRelatedById1);
    }

    /**
     * Method called to associate a ChildPersoon object to this object
     * through the ChildPersoon foreign key attribute.
     *
     * @param  ChildPersoon $l ChildPersoon
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function addPersoonRelatedById1(ChildPersoon $l)
    {
        if ($this->collPersoonsRelatedById1 === null) {
            $this->initPersoonsRelatedById1();
            $this->collPersoonsRelatedById1Partial = true;
        }

        if (!$this->collPersoonsRelatedById1->contains($l)) {
            $this->doAddPersoonRelatedById1($l);

            if ($this->persoonsRelatedById1ScheduledForDeletion and $this->persoonsRelatedById1ScheduledForDeletion->contains($l)) {
                $this->persoonsRelatedById1ScheduledForDeletion->remove($this->persoonsRelatedById1ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersoon $persoonRelatedById1 The ChildPersoon object to add.
     */
    protected function doAddPersoonRelatedById1(ChildPersoon $persoonRelatedById1)
    {
        $this->collPersoonsRelatedById1[]= $persoonRelatedById1;
        $persoonRelatedById1->setFkMoeder($this);
    }

    /**
     * @param  ChildPersoon $persoonRelatedById1 The ChildPersoon object to remove.
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function removePersoonRelatedById1(ChildPersoon $persoonRelatedById1)
    {
        if ($this->getPersoonsRelatedById1()->contains($persoonRelatedById1)) {
            $pos = $this->collPersoonsRelatedById1->search($persoonRelatedById1);
            $this->collPersoonsRelatedById1->remove($pos);
            if (null === $this->persoonsRelatedById1ScheduledForDeletion) {
                $this->persoonsRelatedById1ScheduledForDeletion = clone $this->collPersoonsRelatedById1;
                $this->persoonsRelatedById1ScheduledForDeletion->clear();
            }
            $this->persoonsRelatedById1ScheduledForDeletion[]= $persoonRelatedById1;
            $persoonRelatedById1->setFkMoeder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Persoon is new, it will return
     * an empty collection; or if this Persoon has previously
     * been saved, it will retrieve related PersoonsRelatedById1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Persoon.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     */
    public function getPersoonsRelatedById1JoinLand(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersoonQuery::create(null, $criteria);
        $query->joinWith('Land', $joinBehavior);

        return $this->getPersoonsRelatedById1($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Persoon is new, it will return
     * an empty collection; or if this Persoon has previously
     * been saved, it will retrieve related PersoonsRelatedById1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Persoon.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersoon[] List of ChildPersoon objects
     */
    public function getPersoonsRelatedById1JoinGeslacht(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersoonQuery::create(null, $criteria);
        $query->joinWith('Geslacht', $joinBehavior);

        return $this->getPersoonsRelatedById1($query, $con);
    }

    /**
     * Clears out the collPersoon_relaties collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersoon_relaties()
     */
    public function clearPersoon_relaties()
    {
        $this->collPersoon_relaties = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersoon_relaties collection loaded partially.
     */
    public function resetPartialPersoon_relaties($v = true)
    {
        $this->collPersoon_relatiesPartial = $v;
    }

    /**
     * Initializes the collPersoon_relaties collection.
     *
     * By default this just sets the collPersoon_relaties collection to an empty array (like clearcollPersoon_relaties());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersoon_relaties($overrideExisting = true)
    {
        if (null !== $this->collPersoon_relaties && !$overrideExisting) {
            return;
        }

        $collectionClassName = Persoon_relatieTableMap::getTableMap()->getCollectionClassName();

        $this->collPersoon_relaties = new $collectionClassName;
        $this->collPersoon_relaties->setModel('\Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie');
    }

    /**
     * Gets an array of ChildPersoon_relatie objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPersoon is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersoon_relatie[] List of ChildPersoon_relatie objects
     * @throws PropelException
     */
    public function getPersoon_relaties(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoon_relatiesPartial && !$this->isNew();
        if (null === $this->collPersoon_relaties || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersoon_relaties) {
                // return empty collection
                $this->initPersoon_relaties();
            } else {
                $collPersoon_relaties = ChildPersoon_relatieQuery::create(null, $criteria)
                    ->filterByPersoon($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersoon_relatiesPartial && count($collPersoon_relaties)) {
                        $this->initPersoon_relaties(false);

                        foreach ($collPersoon_relaties as $obj) {
                            if (false == $this->collPersoon_relaties->contains($obj)) {
                                $this->collPersoon_relaties->append($obj);
                            }
                        }

                        $this->collPersoon_relatiesPartial = true;
                    }

                    return $collPersoon_relaties;
                }

                if ($partial && $this->collPersoon_relaties) {
                    foreach ($this->collPersoon_relaties as $obj) {
                        if ($obj->isNew()) {
                            $collPersoon_relaties[] = $obj;
                        }
                    }
                }

                $this->collPersoon_relaties = $collPersoon_relaties;
                $this->collPersoon_relatiesPartial = false;
            }
        }

        return $this->collPersoon_relaties;
    }

    /**
     * Sets a collection of ChildPersoon_relatie objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $persoon_relaties A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function setPersoon_relaties(Collection $persoon_relaties, ConnectionInterface $con = null)
    {
        /** @var ChildPersoon_relatie[] $persoon_relatiesToDelete */
        $persoon_relatiesToDelete = $this->getPersoon_relaties(new Criteria(), $con)->diff($persoon_relaties);


        $this->persoon_relatiesScheduledForDeletion = $persoon_relatiesToDelete;

        foreach ($persoon_relatiesToDelete as $persoon_relatieRemoved) {
            $persoon_relatieRemoved->setPersoon(null);
        }

        $this->collPersoon_relaties = null;
        foreach ($persoon_relaties as $persoon_relatie) {
            $this->addPersoon_relatie($persoon_relatie);
        }

        $this->collPersoon_relaties = $persoon_relaties;
        $this->collPersoon_relatiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Persoon_relatie objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Persoon_relatie objects.
     * @throws PropelException
     */
    public function countPersoon_relaties(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersoon_relatiesPartial && !$this->isNew();
        if (null === $this->collPersoon_relaties || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersoon_relaties) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersoon_relaties());
            }

            $query = ChildPersoon_relatieQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersoon($this)
                ->count($con);
        }

        return count($this->collPersoon_relaties);
    }

    /**
     * Method called to associate a ChildPersoon_relatie object to this object
     * through the ChildPersoon_relatie foreign key attribute.
     *
     * @param  ChildPersoon_relatie $l ChildPersoon_relatie
     * @return $this|\Model\Custom\NovumBurger\Persoonsgegevens\Persoon The current object (for fluent API support)
     */
    public function addPersoon_relatie(ChildPersoon_relatie $l)
    {
        if ($this->collPersoon_relaties === null) {
            $this->initPersoon_relaties();
            $this->collPersoon_relatiesPartial = true;
        }

        if (!$this->collPersoon_relaties->contains($l)) {
            $this->doAddPersoon_relatie($l);

            if ($this->persoon_relatiesScheduledForDeletion and $this->persoon_relatiesScheduledForDeletion->contains($l)) {
                $this->persoon_relatiesScheduledForDeletion->remove($this->persoon_relatiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersoon_relatie $persoon_relatie The ChildPersoon_relatie object to add.
     */
    protected function doAddPersoon_relatie(ChildPersoon_relatie $persoon_relatie)
    {
        $this->collPersoon_relaties[]= $persoon_relatie;
        $persoon_relatie->setPersoon($this);
    }

    /**
     * @param  ChildPersoon_relatie $persoon_relatie The ChildPersoon_relatie object to remove.
     * @return $this|ChildPersoon The current object (for fluent API support)
     */
    public function removePersoon_relatie(ChildPersoon_relatie $persoon_relatie)
    {
        if ($this->getPersoon_relaties()->contains($persoon_relatie)) {
            $pos = $this->collPersoon_relaties->search($persoon_relatie);
            $this->collPersoon_relaties->remove($pos);
            if (null === $this->persoon_relatiesScheduledForDeletion) {
                $this->persoon_relatiesScheduledForDeletion = clone $this->collPersoon_relaties;
                $this->persoon_relatiesScheduledForDeletion->clear();
            }
            $this->persoon_relatiesScheduledForDeletion[]= clone $persoon_relatie;
            $persoon_relatie->setPersoon(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Persoon is new, it will return
     * an empty collection; or if this Persoon has previously
     * been saved, it will retrieve related Persoon_relaties from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Persoon.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersoon_relatie[] List of ChildPersoon_relatie objects
     */
    public function getPersoon_relatiesJoinRelatie(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersoon_relatieQuery::create(null, $criteria);
        $query->joinWith('Relatie', $joinBehavior);

        return $this->getPersoon_relaties($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLand) {
            $this->aLand->removePersoon($this);
        }
        if (null !== $this->aGeslacht) {
            $this->aGeslacht->removePersoon($this);
        }
        if (null !== $this->aFkVader) {
            $this->aFkVader->removePersoonRelatedById0($this);
        }
        if (null !== $this->aFkMoeder) {
            $this->aFkMoeder->removePersoonRelatedById1($this);
        }
        $this->id = null;
        $this->bsn = null;
        $this->infix = null;
        $this->voornaam = null;
        $this->achternaam = null;
        $this->vader_id = null;
        $this->moeder_id = null;
        $this->geslacht_id = null;
        $this->geboorte_datum = null;
        $this->geboorte_plaats = null;
        $this->geboorte_land_id = null;
        $this->immigratie_datum = null;
        $this->heeft_nl_paspoort = null;
        $this->sterf_datum = null;
        $this->sterf_plaats = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPersoonsRelatedById0) {
                foreach ($this->collPersoonsRelatedById0 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersoonsRelatedById1) {
                foreach ($this->collPersoonsRelatedById1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersoon_relaties) {
                foreach ($this->collPersoon_relaties as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPersoonsRelatedById0 = null;
        $this->collPersoonsRelatedById1 = null;
        $this->collPersoon_relaties = null;
        $this->aLand = null;
        $this->aGeslacht = null;
        $this->aFkVader = null;
        $this->aFkMoeder = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PersoonTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildPersoon The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[PersoonTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
