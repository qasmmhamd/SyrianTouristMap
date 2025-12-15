<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with('user:id,name')
            ->where('place_id', $request->query('place_id'))
            ->get();

        return response()->json([
            'message' => 'تم احظار التعليق بنجاح',
            'data' => $comments
        ]);
    }
    public function store(Request $request)
    {
         $validated = $request->validate([
              'place_id' => 'required|exists:places,id',
              'content'  => 'required|string',
          ]);

         $comment = Comment::create([
               'user_id'  => $request->user()->id,
               'place_id'=> $validated['place_id'],
               'content' => $validated['content'],
               'date' => now(),
            ]);

             return response()->json([
                 'message' => 'تم اضافه التعليق بنجاح',
                 'data' => $comment
               ], 201);
     }

}
