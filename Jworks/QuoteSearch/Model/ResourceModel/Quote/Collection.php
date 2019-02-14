<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Model\ResourceModel\Quote;

/**
 * Class Collection
 * @package Jworks\QuoteSearch\Model\ResourceModel\Quote
 */
class Collection extends \Magento\Quote\Model\ResourceModel\Quote\Collection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
}