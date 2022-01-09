<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\File;
use \App\Http\Requests\StoreRecipeRequest;
use App\Models\Comment;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recipes = Recipe::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%'.$term.'%')->get();
                }
            }],
            [function ($query) use ($request) {
                if(($meals = $request->meals)) {
                    $query->whereIn('meal_id', $meals)->get();
                }
            }],
            [function ($query) use ($request) {
                if(($request->myRecipes)) {
                    $query->orWhere('user_id', '=', Auth::user()->id)->get();
                }
            }]
        ])->paginate(12);

        $meals = Meal::all();

        return view('recipes.index', [
            'recipes' => $recipes,
            'meals' => $meals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meals = Meal::all();

        return view("recipes.create", [
            'meals' => $meals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $validated = $request->validated();

        $newImageName = time().'-'.$request->name . '.'.$request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        $recipe = Recipe::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'cooking_time' => $request->input('hours')*60 + $request->input('minutes'),
            'image_path' => $newImageName,
            'ingredients' => implode('!!', $request['ingredients']),
            'user_id' => auth()->user()->id,
            'meal_id' => $request->input('meal')
        ]);

        return redirect('recipes/'.$recipe->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        if(is_null($recipe)){
            return redirect('/recipes');
        }

        $ingredients = explode('!!', $recipe->ingredients);

        if(auth()->user() != NULL){
            $rated = Rating::where([
                ['user_id', '=', auth()->user()->id],
                ['recipe_id', '=', $id]
            ])->first();
        } else {
            $rated = NULL;
        }

        $comments = $recipe->comments;

        return view("recipes.show", [
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'rated' => $rated,
            'comments' => $comments
        ]);
    }

    public function getRating($id)
    {
        $recipe = Recipe::find($id);
        $ratingAvg = $recipe->ratings->avg("rating");
        return $ratingAvg;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $meals = Meal::all();
        $ingredients = explode('!!', $recipe->ingredients);

        return view("recipes.edit", [
            'meals' => $meals,
            'recipe' => $recipe,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecipeRequest $request, $id)
    {
        $validated = $request->validated();

        $img_changed = false;

        if(is_null($request->image)){
            $newImageName = Recipe::find($id)->image_path;
        } else {
            $newImageName = time().'-'.$request->name . '.'.$request->image->extension();

            $request->image->move(public_path('images'), $newImageName);
            $img_changed = true;
        }

        if($img_changed){
            if (File::exists(public_path('/images/'.Recipe::find($id)->image_path))){
                File::delete(public_path('/images/'.Recipe::find($id)->image_path));
            } else {
                dd('File does not exists.');
            }
        }

        $recipe = Recipe::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'cooking_time' => $request->input('hours')*60 + $request->input('minutes'),
                'image_path' => $newImageName,
                'ingredients' => implode('!!', $request['ingredients']),
                'meal_id' => $request->input('meal')
        ]);

        return redirect('recipes/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        if (File::exists(public_path('/images/'.$recipe->image_path))){
            File::delete(public_path('/images/'.$recipe->image_path));
        } else {
            dd('File does not exists.');
        }

        $recipe->delete();

        return redirect('/recipes');
    }

    public function myRecipes(){
        $recipes = Recipe::where('user_id', '=', auth()->user()->id)->paginate(8);

        return view('recipes.myRecipes', [
            'recipes' => $recipes
        ]
    );
    }
}