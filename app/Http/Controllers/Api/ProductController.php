<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $data = Product::with(['category', 'subcategory'])->where('featured_product', 1)->where('deleted_at', null)->get();
            foreach ($data as $row) {
                $row['imageUrl'] = asset('uploads/product/' . $row->thumbnail);
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the products.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
    public function new_arrival()
    {
        try {
            $data = Product::with(['category', 'subcategory'])->where('new_arrival', 1)->where('deleted_at', null)->get();
            foreach ($data as $row) {
                $row['imageUrl'] = asset('uploads/product/' . $row->thumbnail);
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the products.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
    public function today_deals()
    {
        try {
            $data = Product::with(['category', 'subcategory'])->where('today_deals', 1)->where('deleted_at', null)->get();
            foreach ($data as $row) {
                $row['imageUrl'] = asset('uploads/product/' . $row->thumbnail);
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the products.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
    public function productCategory()
    {
        try {
            $data = Category::with(['subcategory'])->where('deleted_at', null)->get();
            foreach ($data as $row) {
                $row['imageUrl'] = asset('uploads/category/' . $row->image);
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the products.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
    public function productDetails($id)
    {
        try {
            $data = Product::with(['subcategory', 'category', 'featuredImages'])->where('id', $id)->where('deleted_at', null)->first();

            $data['thumbnail'] = asset('uploads/product/' . $data->thumbnail);
            foreach ($data->featuredImages as $row) {
                $row['image'] = asset('uploads/product/' . $row->image);
            }
            unset($data->created_at);
            unset($data->updated_at);
            unset($data->deleted_at);
            unset($data->status);
            unset($data->term);
            unset($data->policy);
            unset($data->point);

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the products.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
}
