<?php

namespace App\Http\Controllers;

use App\favorite;
use Auth;
use DB;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
       
        $post_exist= DB::table('favorites')->where('post_id',$request->post_id)->first();
        if(!$post_exist) {
          
            $favorite= favorite::create([

                'user_id'=>Auth::user()->id,
                'post_id'=>$request->post_id,
    
            ]);
            ///////////check 
            if ($favorite)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
                'data' =>$favorite,
            ]);
    
           
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);
         }


         

            
        
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(favorite $favorite)
    {
        //
    }
}
