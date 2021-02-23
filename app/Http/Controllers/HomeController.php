<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Article;
use App\Models\Status;
use App\Models\Comment;


class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        // Articles
        $vars['articles'] = Article::select('id','title','created_at','updated_at')->get();
        // Comments
        $vars['comments'] = Comment::select('id','idea','created_at')->get();
        // Courses
        $vars['courses'] = Course::select('id','name','price')->with('category','subCategory')->get();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('name','id')->get();

        return response()->json($vars);
    }

    // Search
    public function search(Action $action,Request $request) {
        // If search is requested
        if($request->get('courses')) {
            $action->search(Course::class, $request->get('courses'), 'name');
        } 
        else if($request->get('articles')) { 
            $action->search(Article::class, $request->get('articles'), 'title');
        }
    }
}
