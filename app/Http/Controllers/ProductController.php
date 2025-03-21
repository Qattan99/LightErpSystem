<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\SharedModules\ResponseHandler;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {

        return response()->json(Product::all(), 200);
    }

    // Show a single product
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    // Add a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'type_id' => 'required|integer',
            'color' => 'nullable|string',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'details' => 'sometimes|string',
            'type_id' => 'sometimes|integer',
            'color' => 'nullable|string',
        ]);

        $product->update($request->all());
        return response()->json($product, 200);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    // Search products by name
    public function search(Request $request)
    {
        $request->validate([
            'type_id' => 'required|integer',
            'name' => 'nullable|string',
            'pageNumber' => 'required',
            'pageSize' => 'required',
        ]);

        $query = Product::query();

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        $products = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber);

        return ResponseHandler::success($products, $request->pageSize, $request->pageNumber);
        // change master after merging with branchB.
    }
}
