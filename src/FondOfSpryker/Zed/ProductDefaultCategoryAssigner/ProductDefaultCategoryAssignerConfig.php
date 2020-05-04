<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner;

use FondOfSpryker\Shared\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductDefaultCategoryAssignerConfig extends AbstractBundleConfig
{
    /**
     * @return int|null
     */
    public function getDefaultCategoryId(): ?int
    {
        return $this->get(ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID, null);
    }
}
