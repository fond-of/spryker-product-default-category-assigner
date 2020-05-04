<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConstants;

class ProductDefaultCategoryAssignerConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productDefaultCategoryAssignerConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productDefaultCategoryAssignerConfig = $this->getMockBuilder(ProductDefaultCategoryAssignerConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetDefaultCategoryId(): void
    {
        $this->productDefaultCategoryAssignerConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID, null)
            ->willReturn(null);

        $this->assertEquals(null, $this->productDefaultCategoryAssignerConfig->getDefaultCategoryId());
    }

    /**
     * @return void
     */
    public function testGetDefaultCategoryIdWithCustomValue(): void
    {
        $this->productDefaultCategoryAssignerConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID, null)
            ->willReturn(1);

        $this->assertEquals(1, $this->productDefaultCategoryAssignerConfig->getDefaultCategoryId());
    }
}
