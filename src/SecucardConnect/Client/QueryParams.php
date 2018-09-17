<?php


namespace SecucardConnect\Client;

/**
 * Class QueryParams
 * @package SecucardConnect\Client
 */
class QueryParams
{
    const SORT_ASC = "asc";
    const SORT_DESC = "desc";

    /**
     * The number of items to return.
     * @var int
     */
    public $count;

    /**
     * The position within the whole result set to start returning items.
     * @var
     */
    public $offset;


    /**
     * An array of property names to include in the result. Use to narrow returned items to certain properties.
     * Nested properties can be accessed with this notation: "prop1.prop2"
     * @var string[]
     */
    public $fields;

    /**
     * An associative array with property=>order pairs.
     * Order is SORT_ASC or SORT_DESC.
     * @var array
     */
    public $sortOrder;

    /**
     * A query string to restrict the returned items to given conditions.
     * The query string must consist of any combination of single expressions in the form "property:condition".<br/>
     * A condition may contain:
     * - wildcard "*" for any number of characters
     * - wildcard "?" for one character
     * - ranges in the form "[value TO value]"
     *
     * Single expressions may combined by "AND", "OR", "NOT" operators and parenthesis "(", ")" for grouping.<br/>
     * Property names can be nested like "prop1.prop2".<br/>
     * Example: "(NOT customer.name:meier*) AND (customer.age:[30 TO 40] OR customer.age:[50 TO 60])"
     * @var string
     */
    public $query;

    /**
     * QueryParams constructor.
     * @param int $count
     * @param int $offset
     * @param \string[] $fields
     * @param array $sortOrder
     * @param string $query
     */
    public function __construct(
        $count = null,
        $offset = null,
        array $fields = null,
        array $sortOrder = null,
        $query = null
    ) {
        $this->count = $count;
        $this->offset = $offset;
        $this->fields = $fields;
        $this->sortOrder = $sortOrder;
        $this->query = $query;
    }


}
