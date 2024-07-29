<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
      $data=blog::all();

      return view('admin.blog.list', compact('data'));  
    }
    public function getBlog(){
        return view('admin.blog.add');
    }
    public function postBlog(BlogRequest $request){
        $blog=new Blog();
        $blog->Title=$request->input('Title');
        $blog->Image=$request->input('Image');
        $blog->Description=$request->input('Description');
        $blog->Content=$request->input('Content');
        $blog->save();

        return redirect()->route('admin/blog');
    }
    public function editBlog($id){
        $blogg= Blog::find($id);

        return view('admin.blog.edit', compact('blogg'));
    }
    public function updateBlog(BlogRequest $request, $id){
        $blog = Blog::find($id);
        $blog->update([
            'Title' => $request->input('Title'),
            'Image' => $request->input('Image'),
            'Description' => $request->input('Description'),
            'Content' => $request->input('Content'),
        ]);

         return redirect()->route('admin/blog')->with("success","Cập nhật thành công");
    }
    public function deleteBlog($id){
        Blog::destroy($id);

        return redirect()->route('admin/blog');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
