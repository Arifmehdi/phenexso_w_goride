<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Media;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('posts', 'allPosts');
        $data['newses'] = BlogPost::latest()->paginate(50);
        return view('admin.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blog_posts')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('blog_posts')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }

    public function create()
    {
        menuSubmenu('posts', 'storePost');
        $data['categories'] = BlogCategory::all();
        $data['writers'] = User::where('writer', 1)->get();
        $data['medias'] = Media::latest()->paginate(20);
        return view('admin.news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        menuSubmenu('posts', 'storePost');

        $this->validate($request, [
            'title' => 'required|string',
            'category_id' => 'required',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
        ]);

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $image_ex =  $image->getClientOriginalExtension();
            $file_path = date('ymdhis') . '.' . $image_ex;
            Image::make($image)->resize(1200, 500);
            $image->storeAs('post_images', $file_path, 'public');
        } else {
            $file_path =  null;
        }


        $blogPost = new BlogPost();
        $blogPost->title = $request->title;
        $blogPost->category_id = $request->category_id;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->description = $request->description;
        $blogPost->tags = $request->tags;
        $blogPost->active = $request->active ?? 0;
        $blogPost->editor = $request->editor ?? 0;
        $blogPost->featured_slider = $request->featured_slider ?? 0;
        $blogPost->addedby_id = Auth::id();
        $blogPost->feature_image = $file_path;
        $blogPost->save();


        Session::flash('success', 'News Create Successfully');
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        menuSubmenu('posts', 'allPosts');
        return view('admin.news.view', ['news' => BlogPost::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        menuSubmenu('posts', 'allPosts');

        $data['news'] = BlogPost::find($id);
        $data['categories'] = BlogCategory::Where('active', 1)->get();
        $data['writers']    = User::where('writer', 1)->get();
        $data['medias'] = Media::latest()->paginate(20);
        $data['ots'] = $data['news']->tags ? explode(", ", $data['news']->tags) : null;
        $data['authors'] = $data['news']->authors ? explode(", ", $data['news']->authors) : null;
        return view('admin.news.edit', $data);
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

        menuSubmenu('posts', 'storePost');

        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'status' => 'required',
            'feature_image' => 'nullable|image|sometimes|mimes:jpeg,webp,jpg,png',

        ]);

        $blogPost = BlogPost::find($id);

        try {
            if ($request->hasFile('feature_image')) {
                if ($blogPost->feature_image) {
                    Storage::delete('public/post_images/' . $blogPost->feature_image);
                }
                $image = $request->file('feature_image');
                $image_ex =  $image->getClientOriginalExtension();
                $file_path = date('ymdhis') . '.' . $image_ex;
                $image->storeAs('post_images', $file_path, 'public');
            } else {
                $file_path =  $blogPost->feature_image;
            }

            $blogPost->title = $request->title;
            $blogPost->category_id = $request->category_id;
            $blogPost->excerpt = $request->excerpt;
            $blogPost->description = $request->description;
            $blogPost->tags = $request->tags;
            $blogPost->active = $request->active ?? 0;
            $blogPost->editor = $request->editor ?? 0;
            $blogPost->featured_slider = $request->featured_slider ?? 0;
            $blogPost->status = $request->status ?? 'pending';
            $blogPost->editedby_id = Auth::id();
            $blogPost->feature_image = $file_path;
            $blogPost->save();
        
            Session::flash('success', 'News update Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        menuSubmenu('journal_posts', 'alljournalPosts');
        $post = BlogPost::find($id);
        if ($post->feature_image) {
            Storage::delete('public/post_images/' . $post->image);
        }
        $post->delete();
        return redirect()->route('news.index')->with('success', 'Successfully Deleted');
    }



}
