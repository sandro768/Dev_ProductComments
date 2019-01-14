<?php

namespace Dev\ProductComments\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Pricing\Helper\Data;

/**
 * Class ProductComments
 * @package Dev\ProductComments\Block
 */
class ProductComments extends \Magento\Framework\View\Element\Template
{

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    private $currency;

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * ProductComments constructor.
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param Image $image
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Data $currency
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Image $image,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Data $currency
    ) {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->image = $image;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->currency = $currency;
    }

    /**
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function productComments()
    {
        $searchResult = $this->searchCriteriaBuilder->addFilter('comment_visibility', 'yes');
        $searchResult->setPageSize(4);
        $products = $this->productRepository->getList($searchResult->create());

        return $products->getItems();
    }

    public function getImageHelper()
    {
        return $this->image;
    }

    public function getPriceHelper()
    {
        return $this->currency;
    }
}