<?php

namespace FondOfSpryker\Zed\ProductDefaultCategoryAssigner\Dependency\Facade;

interface ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
{
    /**
     * @param int $idCategory
     * @param int[] $productIdsToAssign
     *
     * @return void
     */
    public function createProductCategoryMappings(int $idCategory, array $productIdsToAssign): void;
}
