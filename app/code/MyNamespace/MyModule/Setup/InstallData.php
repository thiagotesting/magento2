<?php
/**
 * @author Thiago Lima
 * @package MyNamespace_MyModule
 */
namespace MyNamespace\MyModule\Setup;

use \Magento\Framework\Setup\InstallDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \Magento\Eav\Setup\EavSetupFactory;
use \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use \Magento\Catalog\Model\Product;


class InstallData implements InstallDataInterface
{

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $entityTypeId = $eavSetup->getEntityTypeId(Product::ENTITY);
        $attributeSetId = $eavSetup->getDefaultAttributeSetId($entityTypeId);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'my_module_attribute',
            [
                'type' => 'int',
                'input' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                'backend'  => '',
                'frontend' => '',
                'label' => 'My Module Attribute',
                'class' => '',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'attribute_set_id' => $attributeSetId,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'user_defined' => true,
                'is_system' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'required'                => false,
                'default'                 => '',
                'apply_to'                => '',
                'group' => 'General',
                'used_in_forms' => [
                    'adminhtml_customer'
                ]
            ]
        );
        $setup->endSetup();
    }
}