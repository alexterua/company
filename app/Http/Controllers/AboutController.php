<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AboutController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function HomeAbout()
    {
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.about.index', compact('homeAbout'));
    }

    public function AddAbout()
    {
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:home_abouts|min:4',
            'short_desc' => 'required|unique:home_abouts|min:4',
            'content' => 'required|unique:home_abouts',
        ],
        [
            'title.required' => 'Please Input Home About Name',
            'title.min' => 'Home About Name Longer Then 4 Char',
            'short_desc.required' => 'Please Input Home About Description',
            'short_desc.min' => 'Home About Description Longer Then 4 Char',
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'Home About Insert Successfull');
    }

    public function EditAbout($id)
    {
        $homeAbout = HomeAbout::find($id);

        return view('admin.about.edit', compact('homeAbout'));
    }

    public function UpdateAbout(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'short_desc' => 'required|min:4',
            'content' => 'required',
        ],
        [
            'title.required' => 'Please Input Home About Name',
            'title.min' => 'Home About Name Longer Then 4 Char',
            'short_desc.required' => 'Please Input Home About Description',
            'short_desc.min' => 'Home About Description Longer Then 4 Char',
        ]);

        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
        ]);

        return Redirect()->route('home.about')->with('success', 'Home About Update Successfull');
    }

    public function DeleteAbout($id)
    {
        HomeAbout::find($id)->delete();

        return Redirect()->back()->with('success', 'Home About Delete Successfull');
    }
}
