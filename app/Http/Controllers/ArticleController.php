<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CategoriesModel;
use File;

    
    
    
class ArticleController extends Controller
    {
        public function categories(){
            $categories = CategoriesModel::get();
            return $categories;
        }
    
        public function addcategories(Request $request){
            CategoriesModel::create([
                'id' => $request->id,
                'name' => $request->name,
            ]);
            return response()->json('Added');
        }
        
            
        public function deletecategories($id){
    
            // hapus data
            CategoriesModel::where('id',$id)->delete();
            
            return response()->json('Deleted');
        }
    
        public function updatecategories(Request $request,$id){
            
            $categories = CategoriesModel::where('id',$id)->get();
            //print_r($gambar); die();
    
            
            CategoriesModel::where('id',$id)->update([
                'id' => $request->id,
                'name' => $request->name,
                

            ]);
            return response()->json('Updated');
        }
    
    
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
        //
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
