<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Database\Factories\CategoryFactory;
use Database\Factories\CategoryParameterFactory;
use Database\Factories\CategoryProductFactory;
use Database\Factories\ParameterFactory;
use Database\Factories\ParameterValueFactory;
use Database\Factories\ProductFactory;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testScopeWithParameterValuesByCategoryReturnsOnlyParametersFromCategory()
    {
        $parameters = ParameterFactory::new()->count(3)->create();
        $firstParameter = $parameters->first();
        /** @var Product $product */
        $product = ProductFactory::new()->createOne();
        /** @var Category $category */
        $category = CategoryFactory::new()->createOne();
        CategoryProductFactory::new()->product($product)->category($category)->createOne();
        CategoryParameterFactory::new()->category($category)->parameter($firstParameter)->createOne();

        $parameterValueFactory = ParameterValueFactory::new()->product($product);
        foreach ($parameters as $parameter) {
            $parameterValueFactory->parameter($parameter)->createOne();
        }

        $selectedProduct = Product::withParameterValuesByCategory($category)->first();

        $this->assertEquals([$firstParameter->id], $selectedProduct->parameterValues->pluck('id')->toArray());
    }
}
