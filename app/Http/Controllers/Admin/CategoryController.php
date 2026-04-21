<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('posts','allCategories');
        $data['categories'] = BlogCategory::paginate(50);
        return view('admin.categories.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('posts','createCategory');
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function categoryActive(Request $request){
        if($request->mode=='true'){
            DB::table('blog_categories')->where('id',$request->id)->update(['active'=>1]);
        }
        else{
            DB::table('blog_categories')->where('id',$request->id)->update(['active'=>0]);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }

    public function store(Request $request)
    {
        menuSubmenu('posts','createCategory');

        $this->validate($request,[
            'name'=>'required',
        ]);

       
        $category = new BlogCategory();
        $category->name       = $request->name;
        $category->addedby_id = Auth::id();
        $category->save();
        return redirect()->route('categories.create')->with('success','Successfully Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        menuSubmenu('posts','allCategories');

        return view('admin.categories.view',['category'=>BlogCategory::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        menuSubmenu('posts','allCategories');

        return view('admin.categories.edit',['category'=>BlogCategory::find($id)]);

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
        menuSubmenu('posts','allCategories');

        $this->validate($request,[
            'name'=>'required',
        ]);

        $category =  BlogCategory::find($id);
        $category->name        = $request->name;
        $category->active      = $request->active ?? 0;
        $category->editedby_id = Auth::id();
        $category->save();
    
        return redirect()->back()->with('success','Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        menuSubmenu('posts','allCategories');

        $category =  BlogCategory::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Successfully Deleted');

    }
}
