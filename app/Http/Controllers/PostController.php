<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use Auth;
use App\category;
use App\User;
use App\comment;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        ///validate
        $this->validate($request, [
            'post' => 'required',

        ]);

        
        
            ////////store category
            category::create([
                'name' => $request->category_name,
            ]);
        

        

        ///////////////check image exists
        if ($request->hasFile('image')) {

            $image = $request->image;
            $image->move('uploades', $image->getClientOriginalName());
        }


        ///////////////////
        $category_id = category::latest()->first()->id;
        ///////store post
        post::create([
            'user_id' => Auth::user()->id,
            'category_id' => $category_id,
            'post' => $request->post,
            'image' => $image->getClientOriginalName()

        ]);
        toastr()->success('Post Added!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $post=post::where('id','=',$id)->first();
     $comments=comment::where('post_id','=',$id)->orderBy('created_at', 'desc')->get();

     return view('singel-post',compact('post','comments'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
