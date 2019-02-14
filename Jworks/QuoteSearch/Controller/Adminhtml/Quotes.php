<?php

/**
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @author Jitheesh V O <jitheeshvo@gmail.com>
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Quote\Model\QuoteFactory;

/**
 * Class Quotes
 * @package Jworks\QuoteSearch\Controller\Adminhtml
 */
abstract class Quotes extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var QuoteFactory
     */
    protected $quoteFactory;
    /**
     * Sales quote repository
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;
    /**
     * Array of actions which can be processed without secret key validation
     * @var string[]
     */
    protected $_publicActions = ['search', 'index'];

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Quote\Model\QuoteFactory $quoteFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->quoteFactory = $quoteFactory;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context);
    }

    /**
     * Check if admin has permissions to visit related pages.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Jworks_QuoteSearch::sales_quotes');
    }

    /**
     * Init layout, menu and breadcrumb
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Jworks_QuoteSearch::search');
        $resultPage->addBreadcrumb(__('Quotes'), __('Quotes'));
        $resultPage->addBreadcrumb(__('Search'), __('Search'));

        return $resultPage;
    }

}
