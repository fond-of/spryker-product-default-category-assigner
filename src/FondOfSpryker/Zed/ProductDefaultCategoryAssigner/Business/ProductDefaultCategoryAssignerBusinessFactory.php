<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business;

use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssigner;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssignerInterface;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig getConfig()
 */
class ProductDefaultCategoryAssignerBusinessFactory extends AbstractBusinessFactory
{
    public function createDefaultCategoryAssigner(): DefaultCategoryAssignerInterface
    {
        return new DefaultCategoryAssigner(
            $this->getConfig(),
            $this->getProductCategoryFacade()
        );
    }

    protected function getProductCategoryFacade(): ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
    {
        return $this->getProvidedDependency(ProductDefaultCategoryAssignerDependencyProvider::FACADE_PRODUCT_CATEGORY);
    }
}
