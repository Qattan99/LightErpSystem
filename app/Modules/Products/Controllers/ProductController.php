<?php

namespace App\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Modules\Products\Resources\ProductDetailResource;
use App\Modules\Products\Resources\ProductSearchResource;
use App\SharedModules\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    /**
     * Create new product.
     * @param Request $request
     * @return JsonResponse
     */
    public function createProduct(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'type_id' => 'required|integer|exists:product_types,id',
            'color' => 'nullable|string|max:50',
            'cost' => 'required|numeric|min:0',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'details' => $request->details,
            'type_id' => $request->type_id,
            'color' => $request->color,
            'cost' => $request->cost,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = [];
            $path = 'images/products';

            foreach ($request->file('images') as $image) {
                $file_extension = $image->getClientOriginalExtension();
                $file_name = uniqid() . '_' . time() . '.' . $file_extension;
                $image->move(public_path($path), $file_name);

                $images[] = [
                    'product_id' => $product->id,
                    'image' => $path . '/' . $file_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Batch insert for better performance
            ProductImage::insert($images);
        }

        // Load the relationship for the response
        $product->load('productImage');

        return ResponseHandler::success($product);
    }

    /**
     * Update Product
     * @param Request $request
     * @return mixed
     */
    public function updateProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'sometimes|string|max:255',
            'details' => 'sometimes|string',
            'type_id' => 'sometimes|integer',
            'color' => 'nullable|string',
        ]);

        $product = Product::find($request->input('id'));

        if (!$product) {
            return ResponseHandler::error('Product not found.');
        }

        $product->update($request->all());
        return ResponseHandler::success(null);
    }

    /**
     * Search For Products
     * @param Request $request
     * @return mixed
     */
    public function searchForProduct(Request $request)
    {
        try{
            $request->validate([
                'typeId' => 'required|integer',
                'productId' => 'nullable|integer',
                'name' => 'nullable|string',
                'pageNumber' => 'required',
                'pageSize' => 'required',
            ]);

            $query = Product::query();

            if ($request->has('keyword')) {
                $query->where('name', 'like', "%{$request->keyword}%");
            }

            if ($request->has('typeId')) {
                $query->where('type_id', $request->typeId);
            }

            if($request->has('productId') && $request->productId != '') {
                $query->where('id', $request->productId);
            }

            $query->with(['oneImage']);

            $products = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber)->toArray();

            return ResponseHandler::success(ProductSearchResource::collection($products['data']), $products['total'], $products['current_page']);
        }
        catch (Throwable $e){
            return ResponseHandler::error($e->getMessage());
        }

    }

    /**
     * Get product details
     * @param Request $request
     */
    public function productDetails(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer',
        ]);

        $product = Product::where('id', $request->productId)->with('productImage')->first();

        if(!$product){
            return ResponseHandler::error("No data available.");
        }

        return ResponseHandler::success(new ProductDetailResource($product));
    }


    /**
     * Delete product.
     * @param Request $request
     * @return mixed
     */
    public function deleteProduct(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer',
        ]);

        $product = Product::findOrFail($request->productId);

        $product->delete();

        return ResponseHandler::success(null);
    }
}
