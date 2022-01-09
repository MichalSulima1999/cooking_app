<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'recipe_id' => $request->input('recipe_id')
        ]);

        return back();
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::where('id', $id)
            ->update([
            'comment' => $request->input('comment')
        ]);
        
        return back();
    }
}
