<?php
namespace SmartEmailing\v3\Request\CustomFields;

use SmartEmailing\v3\Exceptions\InvalidFormatException;
use SmartEmailing\v3\Exceptions\PropertyRequiredException;
use SmartEmailing\v3\Models\Model;
use SmartEmailing\v3\Request\Import\CustomField as ImportCustomField;

class CustomField extends Model
{
    const TEXT = 'text';
    const TEXT_AREA = "textarea";
    const DATE = "date";
    const CHECKBOX = "checkbox";
    const RADIO = "radio";
    const SELECT = "select";

    public $id = null;
    public $name = null;
    public $type = null;
    public $options = [];

    /**
     * CustomField constructor.
     *
     * @param string|null $name
     * @param string|null $type
     */
    public function __construct($name = null, $type = null)
    {
        if (!is_null($name)) {
            $this->setName($name);
        }

        if (!is_null($type)) {
            $this->setType($type);
        }
    }

    /**
     * Returns a list of supported types
     * @return array
     */
    public static function types()
    {
        return [
            self::TEXT,
            self::TEXT_AREA,
            self::DATE,
            self::CHECKBOX,
            self::RADIO,
            self::SELECT
        ];
    }

    /**
     * @param null $id
     *
     * @return CustomField
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Adds an option id
     *
     * @param int $id
     *
     * @return $this
     */
    public function addOption($id)
    {
        $this->options[] = $id;
        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return CustomField
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $type
     *
     * @return CustomField
     * @throws InvalidFormatException
     */
    public function setType($type)
    {
        // Check if valid
        InvalidFormatException::checkInArray($type, static::types());
        $this->type = $type;
        return $this;
    }

    /**
     * Creates import custom field object from the CustomField
     *
     * @param string|null $value String value for simple custom-fields, and YYYY-MM-DD HH:MM:SS for date custom-fields.
     *                           Value size is limited to
     *                           64KB. Required for simple custom-fields
     *
     * @return ImportCustomField
     */
    public function createValue($value = null)
    {
        PropertyRequiredException::throwIf('id', is_numeric($this->id), 'You must register the custom field - missing id');
        return new ImportCustomField($this->id, $value);
    }

    /**
     * Returns the array representation
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'options' => $this->options
        ];
    }
}