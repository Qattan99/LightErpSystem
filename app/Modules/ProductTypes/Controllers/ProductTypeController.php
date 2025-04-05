<?php

namespace App\Modules\ProductTypes\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\SharedModules\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ProductTypeController extends Controller
{
    /**
     * Create New Product
     * @param Request $request
     * @return mixed
     */
    public function createType(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $product = ProductType::create($request->all());
        return ResponseHandler::success($product);
    }

    /**
     * Update Product
     * @param Request $request
     * @return mixed
     */
    public function updateType(Request $request)
    {
    }

    /**
     * Search For Products
     * @param Request $request
     * @return mixed
     */
    public function getTypes(): JsonResponse
    {
        try{

            $types = ProductType::get();

            return ResponseHandler::success($types);
        }
        catch (Throwable $e){
            return ResponseHandler::error($e->getMessage());
        }

    }
}
