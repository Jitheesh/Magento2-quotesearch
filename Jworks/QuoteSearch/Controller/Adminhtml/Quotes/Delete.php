<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml\Quotes;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Delete
 * @package Jworks\QuoteSearch\Controller\Adminhtml\Quotes
 */
class Delete extends \Jworks\QuoteSearch\Controller\Adminhtml\Quotes
{
    /**
     * Orders grid
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Delete Quote'));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $quoteId = $this->getRequest()->getParam('quote_id', false);
        if ($quoteId) {
            try {
                $this->quoteFactory->create()->setId($quoteId)->delete();
                $this->messageManager->addSuccess(__('The quote has been deleted.'));
                $resultRedirect->setPath('quotesearch/quotes/');

                return $resultRedirect;

            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong  deleting this review.'));
            }

            return $resultRedirect->setPath('quotesearch/quotes/');
        }

    }

}