<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $categories = Category::query()->with('parameters')->get();
        return CategoryResource::collection($categories)->toResponse($request);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = new Category();
        $this->saveCategory($category, $request->validated());
        return new JsonResponse(null, 204);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $this->saveCategory($category, $request->validated());
        return new JsonResponse(null, 204);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return new JsonResponse(null, 204);
    }

    /**
     * @param Category $category
     * @param array $data
     * @return void
     */
    protected function saveCategory(Category $category, array $data)
    {
        $category->fill($data);
        $category->save();
        $category->parameters()->sync($data['parameters']);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function listProducts(Request $request, Category $category): JsonResponse
    {
        $products = Product::withParameterValuesByCategory($category)
            ->whereHas('categories', function (Builder $builder) use ($category) {
                $builder->where('category_id', '=', $category->id);
            })
            ->get();
        return ProductResource::collection($products)->toResponse($request);
    }
}
