<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssigner;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductDefaultCategoryAssignerBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerBusinessFactory
     */
    protected $productDefaultCategoryAssignerBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductDefaultCategoryAssignerConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductDefaultCategoryAssignerToProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productDefaultCategoryAssignerBusinessFactory = new ProductDefaultCategoryAssignerBusinessFactory();
        $this->productDefaultCategoryAssignerBusinessFactory->setConfig($this->configMock);
        $this->productDefaultCategoryAssignerBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateDefaultCategoryAssigner(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerDependencyProvider::FACADE_PRODUCT_CATEGORY)
            ->willReturn($this->productCategoryFacadeMock);

        $defaultCategoryAssigner = $this->productDefaultCategoryAssignerBusinessFactory->createDefaultCategoryAssigner();

        $this->assertInstanceOf(DefaultCategoryAssigner::class, $defaultCategoryAssigner);
    }
}
