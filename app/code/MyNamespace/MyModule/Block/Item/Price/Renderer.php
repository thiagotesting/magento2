<?php
/**
 * MyNamespace_MyModule
 *
 * @package     MyNamespace_MyModule
 * @copyright   Copyright (c) 2017 MyNamespace. (http://www.mynamespace.com)
 */
namespace MyNamespace\MyModule\Block\Item\Price;

use \Magento\Weee\Block\Item\Price\Renderer as MageRenderer;
use \Magento\Framework\Pricing\PriceCurrencyInterface;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Tax\Helper\Data;
use \Magento\Weee\Helper\Data as WeeData;
use \Magento\Catalog\Model\ResourceModel\Product as ProductResource;

class Renderer extends MageRenderer
{
    /**
     * @var ProductResource
     */
    protected $productResource;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Weee\Helper\Data $weeeHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $taxHelper,
        PriceCurrencyInterface $priceCurrency,
        WeeData $weeeHelper,
        ProductResource $productResource,
        array $data = []
    ) {
        parent::__construct($context, $taxHelper, $priceCurrency, $weeeHelper, $data);
        $this->productResource = $productResource;
    }

    /**
     * @return mixed
     */
    public function isMyAttributeValueEnabled()
    {
        $product = $this->getItem()->getProduct();
        return $this->productResource->getAttributeRawValue($product->getId(), 'my_module_attribute', $product->getStore());
    }
}