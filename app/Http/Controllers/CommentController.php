<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feature;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Feature $feature)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $feature->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment created successfully');
    }

    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
