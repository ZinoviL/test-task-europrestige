<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $product = new Product();

        DB::beginTransaction();
        $product->fill($requestData)->save();
        $parameterValues = $this->getParameterValues($product, $requestData['parameter_values']);
        $product->parameterValues()->delete();
        $product->parameterValues()->insert($parameterValues);
        $product->categories()->sync($requestData['categories']);
        DB::commit();

        return new JsonResponse(null, 204);
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $requestData = $request->validated();

        DB::beginTransaction();
        $product->fill($requestData)->save();
        $parameterValues = $this->getParameterValues($product, $requestData['parameter_values']);
        $product->parameterValues()->delete();
        $product->parameterValues()->insert($parameterValues);
        $product->categories()->sync($requestData['categories']);
        DB::commit();

        return new JsonResponse(null, 204);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return new JsonResponse(null, 204);
    }

    protected function getParameterValues(Product $product, $data): array
    {
        return array_map(function($value) use ($product) {
            return [
                'value' => $value['value'],
                'product_id' => $product->id,
                'parameter_id' => $value['parameter_id'],
            ];
        }, $data);
    }
}
