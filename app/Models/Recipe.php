<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Meal;
use App\Models\Comment;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'image_path', 'meal_id', 'ingredients', 'user_id', 'cooking_time', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal() {
        return $this->belongsTo(Meal::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
