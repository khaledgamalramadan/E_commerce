<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::select('id','name', 'image', 'is_showing', 'is_populer')->get();
        return view('Admin.Category.index',compact('categories'));
    }

    public function create()
    {
        return view('Admin.Category.create');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_ar'               => 'required',
            'name_en'               => 'required',
            'slug'                  => 'required',
            'description_ar'        => 'required',
            'description_en'        => 'required',
            'image'                 => 'required|image',
            'meta_title_ar'         => 'required',
            'meta_title_en'         => 'required',
            'meta_description_ar'   => 'required',
            'meta_description_en'   => 'required',
            'meta_keywords'         => 'required'
        ]);

        try {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();

            $path = $request->file('image')
                ->storeAs($request->name_en, $image_name, 'public_uploads');

            $category = new Category();
            $category->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $category->slug = $request->slug;
            $category->description = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $category->is_showing = $request->is_showing ? '1' : '0';
            $category->is_populer = $request->is_populer ? '1' : '0';
            $category->meta_title = ['ar' => $request->meta_title_ar, 'en' => $request->meta_title_en];
            $category->meta_description = ['ar' => $request->meta_description_ar, 'en' => $request->meta_description_en];
            $category->meta_keywords = $request->meta_keywords;
            $category->image = $path;
            $category->save();
            flash()->success(trans("messages_trans.Success_save"));
            return redirect()->route('categories.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors('error_catch', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data['category'] = $category;
        return view('Admin.Category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data ['category'] = $category;
        return view('Admin.Category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try{


            $validate = $request->validate([
                'name_ar'               => 'required',
                'name_en'               => 'required',
                'slug'                  => 'required',
                'description_ar'        => 'required',
                'description_en'        => 'required',
                'meta_title_ar'         => 'required',
                'meta_title_en'         => 'required',
                'meta_description_ar'   => 'required',
                'meta_description_en'   => 'required',
                'meta_keywords'         => 'required'
            ]);

            $path = $category->image;
            if ($request->hasFile('image')) {
                if ($path) {
                    Storage::disk('public_uploads')->delete($path);
                }
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('image')->storeAs('categories', $image_name, 'public_uploads');
            }


            $category->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'slug' => $request->slug,
            'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            'is_showing' => $request->is_showing ? '1' : '0',
            'is_populer' => $request->is_populer ? '1' : '0',
            'meta_title' => ['ar' => $request->meta_title_ar, 'en' => $request->meta_title_en],
            'meta_description' => ['ar' => $request->meta_description_ar, 'en' => $request->meta_description_en],
            'meta_keywords' => $request->meta_keywords,
            'image' => $path,

            ]);
            flash()->success(trans("messages_trans.Success_update"));
            return view('Admin.Category.create');
        }
        catch (\Exception $exception){
            return redirect()->withErrors('error_catch', $exception->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->delete();
        flash()->success(trans("messages_trans.Success_delete"));
        return redirect()->route('categories.index');
    }
}
