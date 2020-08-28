<?php

namespace MageSuite\BuyboxRelatedProducts\Setup\Patch\Data;

class AddIncludeRelatedProductsInBuyboxAttribute implements \Magento\Framework\Setup\Patch\DataPatchInterface
{
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $entityTypeId = $eavSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);

        $eavSetup->addAttribute(
            $entityTypeId,
            'include_related_products_in_buybox',
            [
                'type' => 'int',
                'label' => 'Include Related Products In Buybox',
                'input' => 'boolean',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'default' => 0,
                'required' => false,
                'sort_order' => 300,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
