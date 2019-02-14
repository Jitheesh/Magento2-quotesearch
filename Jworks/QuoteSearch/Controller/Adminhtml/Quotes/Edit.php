<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml\Quotes;

/**
 * Class Edit
 * @package Jworks\QuoteSearch\Controller\Adminhtml\Quotes
 */
class Edit extends \Jworks\QuoteSearch\Controller\Adminhtml\Quotes
{
    /**
     * Orders grid
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $this->_initSession();
        $this->_redirect(
            'sales/order_create/',
            array(
                'quote_id' => $this->_getSession()->getQuoteId(),
                'from' => 'envoy_quotes',
                'customer_id' => $this->_getSession()->getCustomerId(),
                'store_id' => $this->_getSession()->getStoreId(),
                'currency_id' => $this->_getSession()->getQuoteCurrencyCode(),
            )
        );
    }

    /**
     * Initialize order creation session data
     * @return $this
     */
    protected function _initSession()
    {

        if ($quoteId = $this->getRequest()->getParam('quote_id', false)) {
            $this->_getSession()->setQuoteId($quoteId);
            $quote = $this->quoteRepository->get($quoteId, [$this->_getSession()->getStoreId()]);
            if ($quote->getId()) {
                $this->_getOrderCreateModel()->setQuote($quote);

                if ($customerId = $quote->getCustomerId()) {
                    $this->_getSession()->setCustomerId((int)$customerId);
                }

                /**
                 * Identify store
                 */
                if ($storeId = $quote->getStoreId()) {
                    $this->_getSession()->setStoreId((int)$storeId);
                }

                /**
                 * Identify currency
                 */
                if ($currencyId = $quote->getCurrencyId()) {
                    $this->_getSession()->setCurrencyId((string)$currencyId);
                    $this->_getOrderCreateModel()->setRecollect(true);
                }
            }

        }


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

    /**
     * Retrieve order create model
     * @return \Magento\Sales\Model\AdminOrder\Create
     */
    protected function _getOrderCreateModel()
    {
        return $this->_objectManager->get('Magento\Sales\Model\AdminOrder\Create');
    }
}