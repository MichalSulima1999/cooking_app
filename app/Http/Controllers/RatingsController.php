<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|min:1|max:5|integer',
        ]);

        $rated = Rating::where('recipe_id', $request->id)
            ->where('user_id', auth()->user()->id)
            ->exists(); //true or false

        if(!$rated){
            $id = $request->id;
            $post = Recipe::find($id);
            $rating = new Rating;
            $rating->rating = $request->rate;
            $rating->user_id = auth()->user()->id;
            $post->ratings()->save($rating);
            return $rating->id;
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rate' => 'required|min:1|max:5|integer',
        ]);

        if (!$validator->fails()) {
            $rating = Rating::find($id);

            $rating->rating = $request->rate;

            $rating->save();
        }
        return $rating->id;
    }
}
