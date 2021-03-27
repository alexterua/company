<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
//        $sliders = DB::table('sliders')->get();
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:4',
            'description' => 'required|min:3',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => 'Please Input Slider Name',
            'title.min' => 'Slider Name Longer Then 4 Char',
        ]);
        $image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
        Image::make($image)->resize(1920, 1088)->save('image/slider/' . $name_gen);

        $last_img = 'image/slider/' . $name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Insert Successfull');
    }
}
