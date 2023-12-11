<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function Termwind\render;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands     = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_product' => ['required', 'image', 'max:3000'],
            'name'     => ['required', 'max:200'],
            'category' => ['required'],
            'brand'    => ['required'],
            'price'    => ['required'],
            'qty'      => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description'  => ['required'],
            'seo_title'       => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status'          => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image_product', 'uploads');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->vendor_id   = Auth::user()->vendor->id;
        $this->saveProduct($request, $product);

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.products.index');
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
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $brands     = Brand::all();
        $subCategories   = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        return view('admin.product.edit', compact('categories', 'brands', 'product', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image_product' => ['nullable', 'image', 'max:3000'],
            'name'     => ['required', 'max:200'],
            'category' => ['required'],
            'brand'    => ['required'],
            'price'    => ['required'],
            'qty'      => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description'  => ['required'],
            'seo_title'       => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status'          => ['required']
        ]);
        $product = Product::findOrFail($id);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image_product', 'uploads', $product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $this->saveProduct($request, $product);

        toastr('Update Successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        /** Delete Product gallery images*/
        $this->deleteImage($product->thumb_image);

        /** Delete Product gallery images*/
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $galleryImage){
            $this->deleteImage($galleryImage->image);
            $galleryImage->delete();
        }

        /** Delete Product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * get change Status product.
     */
    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true'? 1 : 0;
        $product->save();

        return response(["message" => "Status has been updated!"]);
    }


    /**
     * get SubCategories.
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subCategories;
    }

    /**
     * get ChildCategories.
     */
    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $childCategories;
    }

    /**
     * @param Request $request
     * @param $product
     */
    public function saveProduct(Request $request, $product): void
    {
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();
    }
}
