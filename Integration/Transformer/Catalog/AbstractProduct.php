<?php
/**
 * BSeller Platform | B2W - Companhia Digital
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  ${MAGENTO_MODULE_NAMESPACE}
 * @package   ${MAGENTO_MODULE_NAMESPACE}_${MAGENTO_MODULE}
 *
 * @copyright Copyright (c) 2018 B2W Digital - BSeller Platform. (http://www.bseller.com.br)
 *
 * @author    Tiago Sampaio <tiago.sampaio@e-smart.com.br>
 */

namespace BitTools\SkyHub\Integration\Transformer\Catalog;

use BitTools\SkyHub\Integration\Transformer\AbstractTransformer;

use BitTools\SkyHub\Helper\Catalog\Product\Attribute\Mapping as AttributeMappingHelper;
use BitTools\SkyHub\Helper\Catalog\Product as ProductHelper;
use BitTools\SkyHub\Helper\Eav\Option as EavOptionHelper;
use BitTools\SkyHub\Helper\Catalog\Product\Attribute as AttributeHelper;
use Magento\Catalog\Helper\ImageFactory;
use BitTools\SkyHub\Integration\Context;
use BitTools\SkyHub\Model\Config\SkyhubAttributes\Data;
use Magento\CatalogInventory\Model\StockState;

abstract class AbstractProduct extends AbstractTransformer
{
    
    /** @var StockState */
    protected $stockState;
    
    /** @var Data */
    protected $skyhubConfig;
    
    /** @var ProductHelper */
    protected $productHelper;
    
    /** @var ImageFactory */
    protected $imageHelperFactory;
    
    /** @var AttributeHelper */
    protected $attributesHelper;
    
    /** @var AttributeMappingHelper */
    protected $attributeMappingHelper;
    
    /** @var EavOptionHelper */
    protected $eavOptionHelper;
    
    
    public function __construct(
        Context $context,
        StockState $stockState,
        ProductHelper $productHelper,
        ImageFactory $imageHelperFactory,
        AttributeHelper $attributesHelper,
        AttributeMappingHelper $attributeMappingHelper,
        EavOptionHelper $eavOptionHelper,
        Data $skyhubConfig
    )
    {
        parent::__construct($context);
        
        $this->stockState             = $stockState;
        $this->productHelper          = $productHelper;
        $this->imageHelperFactory     = $imageHelperFactory;
        $this->attributesHelper       = $attributesHelper;
        $this->attributeMappingHelper = $attributeMappingHelper;
        $this->eavOptionHelper        = $eavOptionHelper;
        $this->skyhubConfig           = $skyhubConfig;
    }
    
    
    /**
     * @param \Magento\Catalog\Model\Product $product
     *
     * @return $this|array
     */
    protected function getProductGalleryImages(\Magento\Catalog\Model\Product $product)
    {
        /** @var array $gallery */
        $gallery = $product->getMediaGalleryEntries();
    
        if (!$gallery || !count($gallery)) {
            return $this;
        }
        
        $images = [];
    
        /** @var \Magento\Catalog\Model\Product\Gallery\Entry $galleryImage */
        foreach ($gallery as $galleryImage) {
            /** @var \Magento\Catalog\Helper\Image $helper */
            $helper = $this->imageHelperFactory->create();
            $url    = $helper->setImageFile($galleryImage->getFile())->getUrl();
    
            $images[]['url'] = $url;
        }
    
        return $images;
    }
}