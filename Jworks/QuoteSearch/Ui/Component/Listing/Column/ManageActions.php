<?php
/**
 *
 * @category    Jworks
 * @package     Jworks_QuoteSearch
 * @copyright Copyright (c) 2017 Jworks Digital ()
 */

namespace Jworks\QuoteSearch\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class ManageActions
 * @package Jworks\QuoteSearch\Ui\Component\Listing\Column
 */
class ManageActions extends Column
{
    /** Url path */
    const URL_PATH_DELETE = 'quotesearch/quotes/delete';
    const URL_PATH_EDIT = 'quotesearch/quotes/edit';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                $urlEntityParamName = $this->getData('config/urlEntityParamName') ?: 'entity_id';
                $item[$name]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        self::URL_PATH_DELETE,
                        [$urlEntityParamName => $item['entity_id']]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete'),
                        'message' => __('Are you sure you want to delete Quote with id: %1?', $item['entity_id'])
                    ]
                ];
                $item[$name]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, [$urlEntityParamName => $item['entity_id']]),
                    'label' => __('View/Edit'),
                ];
            }
        }

        return $dataSource;
    }
}
