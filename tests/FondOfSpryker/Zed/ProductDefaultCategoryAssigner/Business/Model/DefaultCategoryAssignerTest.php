<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class DefaultCategoryAssignerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssigner
     */
    protected $defaultCategoryAssigner;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductDefaultCategoryAssignerConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductDefaultCategoryAssignerToProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->defaultCategoryAssigner = new DefaultCategoryAssigner(
            $this->configMock,
            $this->productCategoryFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testAssign(): void
    {
        $idCategory = 2;
        $idProductAbstract = 1;

        $this->configMock->expects($this->atLeastOnce())
            ->method('getDefaultCategoryId')
            ->willReturn($idCategory);

        $this->productAbstractTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->productCategoryFacadeMock->expects($this->atLeastOnce())
            ->method('createProductCategoryMappings')
            ->with($idCategory, [$idProductAbstract]);

        $productAbstractTransfer = $this->defaultCategoryAssigner->assign($this->productAbstractTransferMock);

        $this->assertEquals($this->productAbstractTransferMock, $productAbstractTransfer);
    }
}
