<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCategory()
    {

        /*$categories = DB::table('categories')
            ->join('users', 'categories.user_id', 'users.id')
            ->select('categories.*', 'users.name')
            ->latest()->paginate(5);*/

//        $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);
        $trashCategories = Category::onlyTrashed()->latest()->paginate(3);

//        $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCategories'));
    }

    public function AddCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category Less Then 255 Chars',
        ]
        );

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        /*$category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();*/

        /*$data = [];
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);*/

        return Redirect()->back()->with('success', 'Category Insert Successfull');
    }

    public function Edit($id)
    {
//        $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        /*$update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);*/

        $data = [];
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Update Successfull');
    }

    public function SoftDelete($id)
    {

        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', 'Category Soft Delete Successfull');
    }

    public function Restore($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success', 'Category Restore Successfull');
    }

    public function PDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success', 'Category Permanently Delete Successfull');
    }
}
