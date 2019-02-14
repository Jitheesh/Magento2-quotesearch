<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Jworks\QuoteSearch\Block\Adminhtml\Order;

/**
 * Class Create
 * @package Jworks\QuoteSearch\Block\Adminhtml\Order
 */
class Create extends \Magento\Sales\Block\Adminhtml\Order\Create
{
    /**
     * Constructor
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        //new button added
        $this->buttonList->add('save_order',
            [
                'id' => 'save_admin_order',
                'class' => 'save_order',
                'onclick' => 'setLocation(\''.$this->getSaveQuoteUrl().'\')',
                'label' => __('Save Quote'),
            ]
        );
    }

    /**
     * quote save url
     * @return string
     */
    public function getSaveQuoteUrl()
    {
        return $this->getUrl('quotesearch/quotes/save');
    }
}
