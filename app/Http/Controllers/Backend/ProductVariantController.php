<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product' => ['integer', 'required'],
            'name'    => ['required', 'max:200'],
            'status'  => ['required']
        ]);

        $variant = new ProductVariant();

        $variant->product_id = $request->product;
        $variant->name   = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr()->success('Create Successfully!');
        return redirect()->route('admin.products-variant.index', ['product' => $request->product]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variant = ProductVariant::findOrFail($id);
        return view('admin.product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => ['required', 'max:200'],
            'status'  => ['required']
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->name       = $request->name;
        $variant->status     = $request->status;
        $variant->save();

        toastr()->success('Updated Successfully!');
        return redirect()->route('admin.products-variant.index', ['product' => $variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * change Status Product Variant.
     */
    public function changeStatus(Request $request)
    {
        $category = ProductVariant::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }

}
