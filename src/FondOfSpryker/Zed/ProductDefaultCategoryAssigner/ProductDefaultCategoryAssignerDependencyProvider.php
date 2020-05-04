<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner;

use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductDefaultCategoryAssignerDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PRODUCT_CATEGORY = 'FACADE_PRODUCT_CATEGORY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductCategoryFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCategoryFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_CATEGORY] = static function (Container $container) {
            return new ProductDefaultCategoryAssignerToProductCategoryFacadeBridge(
                $container->getLocator()->productCategory()->facade()
            );
        };

        return $container;
    }
}
