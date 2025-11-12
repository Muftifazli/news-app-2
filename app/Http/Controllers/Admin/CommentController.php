<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        // Sort berdasarkan parameter
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        $comments = Comment::with('news')
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.comments.index', compact('comments', 'sort', 'order'));
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil dihapus');
    }
}
