<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Blog;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.blog.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $blgo = new Blog;

      if($request->image!=''){
        $image = $request->image;

        $randomname = str_random(15);
        $extension  = $image->getClientOriginalExtension();

        $imagename = $randomname.'.'.$extension;

        if(!Storage::disk('public')->exists('blog'))
        {
            Storage::disk('public')->makeDirectory('blog');
        }
        $articleImage = Image::make($image)->resize(806,440)->save('foo');
        Storage::disk('public')->put('blog/'.$imagename, $articleImage);

        $blgo->image = $imagename;
      }

      if($request->image_title!=''){
        $blgo->image_title = $request->image_title;
      }

      $blgo->user_id = Auth::user()->id;
      $blgo->category_id = $request->category;
      $blgo->title = $request->title;
      $blgo->slug = str_slug($request->title);

      $blgo->body = $request->body;
      $blgo->save();
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
