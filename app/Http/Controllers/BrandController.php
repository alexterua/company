<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Brand Longer Then 4 Characters',
            ]
        );

        $brand_image = $request->file('brand_image');

//        $name_gen = hexdec(uniqid());
//        $img_ext = strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen . '.' . $img_ext;
//        $up_location = 'image/brand/';
//        $last_img = $up_location . $img_name;
//        $brand_image->move($up_location, $img_name);

        $name_gen = hexdec(uniqid()) . '.' . strtolower($brand_image->getClientOriginalExtension());
        Image::make($brand_image)->resize(250, 200)->save('image/brand/' . $name_gen);

        $last_img = 'image/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand Insert Successfull');
    }

    public function Edit($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Brand Longer Then 4 Characters',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Brand Update Successfull');
    }

    public function Delete($id)
    {
        $image = Brand::find($id)->brand_image;
        unlink($image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Delete Successfull');
    }

    /*  This is for Multi Image All Methods  */

    public function MultiPic()
    {
        $images = MultiPic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request)
    {
        $image = $request->file('image');

        foreach ($image as $multi_img) {
            $name_gen = hexdec(uniqid()) . '.' . strtolower($multi_img->getClientOriginalExtension());
            Image::make($multi_img)->resize(250, 200)->save('image/multi/' . $name_gen);

            $last_img = 'image/multi/' . $name_gen;

            MultiPic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Multi Image Insert Successfull');
    }
}
