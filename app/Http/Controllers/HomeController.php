<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        // Categories
        $vars['categories'] = Category::select('id','name')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('id','name')->get();
        // Courses
        $vars['courses'] = Course::select('id','name')->get();
        // Articles
        $vars['articles'] = Article::select('id','title')->get();

        return response()->json($vars);

        // $test = Category::all();
        // return $test->toJson();

    }
}
