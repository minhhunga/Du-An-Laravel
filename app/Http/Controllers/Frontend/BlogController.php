<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     

    public function blog()
    {
        $data=blog::orderBy('created_at', 'desc')->paginate(3);

        return view('Frontend.blog.blog', compact('data'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function rateBlog(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Vui lòng đăng nhập để đánh giá.']);
        }
        $data = $request->all();
        $blogId = $data['id_blog'];
        $rate = $data['rate'];

        $saverate = Rate::where('id_user', $user->id)->where('id_blog', $blogId)->first();

        if ($saverate) {
        
             $saverate->update(['rate' => $rate]);

        } else {
            
            Rate::create([
                'id_user' => $user->id,
                'id_blog' => $blogId,
                'rate' => $rate,
            ]);
        }

        return response()->json(['success' => 'Đánh giá thành công.']);
    }


    public function show(string $id)
    {
        $blog = Blog::find($id);

        $nextBlog = Blog::where('id', '>', $id)->orderBy('id')->first();
        $previousBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $ratings = Rate::where('id_blog', $id)->get();
        $tong = $ratings->sum('rate');
        $songuoidanhgia = $ratings->count();

        // Tính trung bình cộng
        if ($songuoidanhgia > 0) {
            $tbc = $tong / $songuoidanhgia;
        } else {
            $tbc = 0;
        }

        $comments = Comment::where('id_blog', $id)->get();
        
        return view('Frontend.blog.show', compact('blog', 'nextBlog', 'previousBlog', 'tbc', 'comments'));
    }
// - dung js kiem tra da lopgin chua
// - kiem tra da nhap cmt chua
// - return flase de form dung lai 
// - neu 2 cai tren ok thi cho true form chay (bo url vao acction)
// - qua controller lay data insert vao 


    public function saveComment(Request $request)
{
    
    if (Auth::check()) {
    $userId = Auth::id();
    $user = Auth::user(); // Lấy thông tin người dùng
    $avatar = $user->avatar;
    $name = $user->name;
    $data = $request->all();
    //dd($data);
    $cmt = $data['cmt'];
    $blogId = $data['id_blog'];
   
    $comment = new Comment();
    $comment->cmt = $cmt;
    $comment->id_blog = $blogId;
    $comment->id_user = $userId;
    $comment->avatar = $avatar;
    $comment->name = $name;

    $comment->level = $data['level'];

    $comment->save();
    return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
} else {
    return redirect()->back()->with('error', 'Vui lòng đăng nhập để bình luận.');
}

}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


