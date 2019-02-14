<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml\Quotes;

/**
 * Used to save admin quotes
 * Class Save
 * @package Jworks\QuoteSearch\Controller\Adminhtml\Quotes
 */
class Save extends \Jworks\QuoteSearch\Controller\Adminhtml\Quotes
{
    /**
     * Orders grid
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $this->_saveQuote();
        $this->_redirect('quotesearch/quotes/');
    }

    /**
     * @return $this
     */
    protected function _saveQuote()
    {
        $quote = $this->_getQuote();
        $quote->setIsActive(true);
        $this->_getQuote()->getResource()->save($quote);

        return $this;
    }

    /**
     * Retrieve session object
     * @return \Magento\Backend\Model\Session\Quote
     */
    protected function _getSession()
    {
        return $this->_objectManager->get('Magento\Backend\Model\Session\Quote');
    }

    /**
     * Retrieve quote object
     * @return \Magento\Quote\Model\Quote
     */
    protected function _getQuote()
    {
        return $this->_getSession()->getQuote();
    }
}