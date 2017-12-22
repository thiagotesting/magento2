<?php
/**
 * @author Thiago Lima
 * @package MyNamespace_MyModule
 */
namespace MyNamespace\MyModule\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;

class LogCart implements ObserverInterface
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();
        $myModuleAttribute = $product->getCustomAttribute('my_module_attribute');

        if ($myModuleAttribute && (int)$myModuleAttribute->getValue() === 1) {
            $message = "Product {$product->getSku()} has been added to the cart";
            $this->logger->info($message);
        }
    }
}