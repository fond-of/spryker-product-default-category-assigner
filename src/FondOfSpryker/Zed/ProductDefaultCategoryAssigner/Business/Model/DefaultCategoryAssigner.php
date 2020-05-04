<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model;

use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class DefaultCategoryAssigner implements DefaultCategoryAssignerInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig
     */
    protected $config;

    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig $config
     * @param \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface $productCategoryFacade
     */
    public function __construct(
        ProductDefaultCategoryAssignerConfig $config,
        ProductDefaultCategoryAssignerToProductCategoryFacadeInterface $productCategoryFacade
    ) {
        $this->config = $config;
        $this->productCategoryFacade = $productCategoryFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function assign(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $defaultCategoryId = $this->config->getDefaultCategoryId();
        $productIdsToAssign = [$productAbstractTransfer->getIdProductAbstract()];

        $this->productCategoryFacade->createProductCategoryMappings($defaultCategoryId, $productIdsToAssign);

        return $productAbstractTransfer;
    }
}
