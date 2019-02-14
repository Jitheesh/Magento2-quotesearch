<?php
/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml\Quotes;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Jworks\QuoteSearch\Model\ResourceModel\Quote\CollectionFactory;

/**
 * Class MassDelete
 * @package Jworks\QuoteSearch\Controller\Adminhtml\Quotes
 */
class MassDelete extends \Jworks\QuoteSearch\Controller\Adminhtml\Quotes
{
    /**
     * @var string
     */
    protected $redirectUrl = '*/*/';
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;
    /**
     * @var object
     */
    protected $collectionFactory;

    /* @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $resultPageFactory, $quoteFactory, $quoteRepository);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Delete selected quotes
     * @param AbstractCollection $collection
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    protected function massAction(AbstractCollection $collection)
    {
        $countDelete = 0;
        foreach ($collection->getItems() as $quote) {
            $quote->delete();
            $countDelete++;
        }
        $countNonDeletedQuotes = $collection->count() - $countDelete;

        if ($countNonDeletedQuotes && $countDelete) {
            $this->messageManager->addError(__('%1 quote(s) cannot be delete.', $countNonDeletedQuotes));
        } elseif ($countNonDeletedQuotes) {
            $this->messageManager->addError(__('You cannot delete the quote(s).'));
        }

        if ($countDelete) {
            $this->messageManager->addSuccess(__('We delete %1 quote(s).', $countDelete));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->redirectUrl);

        return $resultRedirect;
    }

    /**
     * Execute action
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            return $this->massAction($collection);
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

            return $resultRedirect->setPath($this->redirectUrl);
        }
    }

}