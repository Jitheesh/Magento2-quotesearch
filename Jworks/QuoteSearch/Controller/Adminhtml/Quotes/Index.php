<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml\Quotes;

/**
 * Class Index
 * @package Jworks\QuoteSearch\Controller\Adminhtml\Quotes
 */
class Index extends \Jworks\QuoteSearch\Controller\Adminhtml\Quotes
{
    /**
     * Orders grid
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Quotes'));

        return $resultPage;
    }

}