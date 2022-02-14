<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $product = Product::where('removed', 0)->get();

            $response = [
                'success' => true,
                'message' => 'All products successfully retrieved',
                'data' => $product
            ];
            if (!$product) {
                $response = [
                    'success' => false,
                    'message' => 'All products could not be retrieved',
                    'data' => $product
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'All products could not retrieved',
                'data' => $e
            ];
        }
        return response($response);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'product_name' => 'required|string',
            'quantity_in_stock' => 'required|integer',
            'price_per_item' => 'required|integer',
        ]);

        try {
            $createProduct = Product::create([
                'product_name' => $fields['product_name'],
                'quantity_in_stock' => $fields['quantity_in_stock'],
                'price_per_item' => $fields['price_per_item'],
                'removed' => 0,
            ]);
            $response = [
                'success' => true,
                'message' => 'Product successfully created',
            ];
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e,
            ];
        }
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::where('id', $id)
                ->where('removed', 0)->get();

            $response = [
                'success' => true,
                'message' => 'Product successfully retrieved',
                'data' => $product
            ];
            if (!$product) {
                $response = [
                    'success' => false,
                    'message' => 'Product could not be retrieved',
                    'data' => $product
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Product could not retrieved',
                'data' => $e
            ];
        }
        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            // 'id' => 'required|integer',
            'product_name' => 'required|string',
            'quantity_in_stock' => 'required|integer',
            'price_per_item' => 'required|integer',
        ]);

        $updateProduct = Product::where('id', $id)
            ->where('removed', 0)
            ->update([
                'product_name' => $fields['product_name'],
                'quantity_in_stock' => $fields['quantity_in_stock'],
                'price_per_item' => $fields['price_per_item'],
            ]);
        $response = [
            'success' => true,
            'message' => 'Product successully updated',
        ];
        if (!$updateProduct) {
            $response = [
                'success' => false,
                'message' => 'Product could not updated',
            ];
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteContact = Product::where('id', $id)
            ->where('removed', 0)
            ->update([
                'removed' => 1,
            ]);
        $response = [
            'success' => true,
            'message' => 'Product successully deleted',
        ];

        if (!$deleteContact) {
            $response = [
                'success' => false,
                'message' => 'Product could not deleted',
            ];
        }

        return response($response);
    }
}
