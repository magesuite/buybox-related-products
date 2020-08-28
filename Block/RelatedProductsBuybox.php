<?php

namespace MageSuite\BuyboxRelatedProducts\Block;

class RelatedProductsBuybox extends \Magento\Catalog\Block\Product\ProductList\Related
{
    public function canDisplayRelatedProductsSection()
    {
        $product = $this->getProduct();

        if ($product->getIncludeRelatedProductsInBuybox()) {
            return true;
        }

        return false;
    }
}
