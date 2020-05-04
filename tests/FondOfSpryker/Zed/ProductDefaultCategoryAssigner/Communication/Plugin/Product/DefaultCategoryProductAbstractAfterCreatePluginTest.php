<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class DefaultCategoryProductAbstractAfterCreatePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacade
     */
    protected $productDefaultCategoryAssignerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\Product\DefaultCategoryProductAbstractAfterCreatePlugin
     */
    protected $defaultCategoryProductAbstractAfterCreatePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productDefaultCategoryAssignerFacadeMock = $this->getMockBuilder(ProductDefaultCategoryAssignerFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->defaultCategoryProductAbstractAfterCreatePlugin = new DefaultCategoryProductAbstractAfterCreatePlugin();
        $this->defaultCategoryProductAbstractAfterCreatePlugin->setFacade(
            $this->productDefaultCategoryAssignerFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->productDefaultCategoryAssignerFacadeMock->expects($this->atLeastOnce())
            ->method('assignProductAbstractToDefaultCategory')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        $productAbstractTransfer = $this->defaultCategoryProductAbstractAfterCreatePlugin
            ->create($this->productAbstractTransferMock);

        $this->assertEquals($this->productAbstractTransferMock, $productAbstractTransfer);
    }
}
