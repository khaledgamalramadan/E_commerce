<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['route'] = 'products';
        $data['products'] = Product::select('id', 'category_id', 'name', 'image', 'status', 'trend')->get();
        return view('Admin.product.index',$data);
    }

    public function create()
    {
        $data['route'] = 'products';
        $categories = Category::select('id', 'name', 'image', 'is_showing', 'is_populer')->get();
        return view('Admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            'name_ar' => 'required',
            'name_en' => 'required',
            'slug' => 'required',
            'short_description_ar' => 'required',
            'short_description_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'image' => 'required|image',
            'qty' => 'required',
            'tax' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description_ar' => 'required',
            'meta_description_en' => 'required',
        ]);

        try {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();

            $path = $request->file('image')->storeAs($request->name_en, $image_name, 'public_uploads');

            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $product->slug = $request->slug;
            $product->short_description = ['ar' => $request->short_description_ar, 'en' => $request->short_description_en];
            $product->description = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $product->status = $request->status ? '1' : '0';
            $product->trend = $request->trend ? '1' : '0';
            $product->price = $request->price;
            $product->selling_price = $request->selling_price;
            $product->qty = $request->qty;
            $product->tax = $request->tax;
            $product->meta_title = $request->meta_title;
            $product->meta_description = ['ar' => $request->meta_description_ar, 'en' => $request->meta_description_en];
            $product->meta_keywords = $request->meta_keywords;
            $product->image = $path;

            $product->save();
            flash()->success(trans("messages_trans.Success_save"));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error_catch', $e->getMessage());
        }

    }
    public function show(Product $product)
    {
        $data['route'] = 'products';
        $data['product'] = $product;
        return view('Admin.Product.show', $data);
    }

    public function edit(Product $product)
    {
        $data['route'] = 'products';
        $data['product'] = $product;
        $data['categories'] = Category::select('id', 'name')->get();
        return view('Admin.Product.edit', $data );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {

         $validate = $request->validate([
            'category_id'          => 'required|exists:App\Models\Category,id',
            'name_ar'              => 'required',
            'name_en'              => 'required',
            'slug'                 => 'required',
            'short_description_ar' => 'required',
            'short_description_en' => 'required',
            'description_ar'       => 'required',
            'description_en'       => 'required',
            'price'                => 'required',
            'selling_price'        => 'required',
            'image'                => 'image',
            'qty'                  => 'required',
            'tax'                  => 'required',
            'meta_title'           => 'required',
            'meta_keywords'        => 'required',
            'meta_description_ar'  => 'required',
            'meta_description_en'  => 'required',
        ]);

        try {
        $path = $product->image;
        if ($request->hasFile('image')) {
            if ($path) {
                Storage::disk('public_uploads')->delete($path);
            }
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('products', $image_name, 'public_uploads');

        }

            $product->update([
                'category_id'         => $request->category_id,
                'name'                => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'slug'                => $request->slug,
                'short_description'   => ['ar' => $request->short_description_ar, 'en' => $request->short_description_en],
                'description'         => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'status'              => $request->status ? '1' : '0',
                'trend'               => $request->trend ? '1' : '0',
                'price'               => $request->price,
                'selling_price'       => $request->selling_price,
                'qty'                 => $request->qty,
                'tax'                 => $request->tax,
                'meta_title'          => $request->meta_title,
                'meta_description_ar' => ['ar' => $request->meta_description_ar, 'en' => $request->meta_description_en],
                'meta_keywords'       => $request->meta_keywords,
                'image'               => $path,
            ]);
        return redirect()->route('products.index')->with('success', trans('messages_trans.success_update'));
    } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error_catch' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', trans('messages_trans.Success_delete'));
    }
}
