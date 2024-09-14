<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function restaurant(Category $category, Request $request) {
        $query = $category->restaurants();
        $today = Carbon::now()->dayName;
        if($request->open) {
            $query->leftJoin('open_times', $today);
        }
    }
}