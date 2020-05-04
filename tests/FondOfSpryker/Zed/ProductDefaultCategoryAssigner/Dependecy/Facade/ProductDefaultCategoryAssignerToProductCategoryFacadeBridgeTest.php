<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependecy\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeBridge;
use Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface;

class ProductDefaultCategoryAssignerToProductCategoryFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productDefaultCategoryAssignerToProductCategoryFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productDefaultCategoryAssignerToProductCategoryFacadeBridge = new ProductDefaultCategoryAssignerToProductCategoryFacadeBridge(
            $this->productCategoryFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testCreateProductCategoryMappings(): void
    {
        $idCategory = 2;
        $productIdsToAssign = [1];

        $this->productCategoryFacadeMock->expects($this->atLeastOnce())
            ->method('createProductCategoryMappings')
            ->with($idCategory, $productIdsToAssign);

        $this->productDefaultCategoryAssignerToProductCategoryFacadeBridge->createProductCategoryMappings(
            $idCategory,
            $productIdsToAssign
        );
    }
}
