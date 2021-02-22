<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Article;
use App\Models\Status;
use App\Models\Comment;

use Illuminate\Http\Request;

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
    public function search(Request $request) {
        // If search is requested
        if(!empty($request->get('search'))) {

            if($request->get('courses')) {

                $courses = Course::where('name', $request->get('search'))->paginate(9);
                $this->searchExist($courses);
            } 
            else if($request->get('articles')) { 
                
                $articles = Article::where('title',$request->get('search'))->paginate(9);
                $this->searchExist($articles);
            }
        }
        else {
            return response()->json('لطفا نوشته مورد نظر خود را جستجو کنید');
        }
    }

    // Check if search exists
    public function searchExist($row) {
        if(count($row) > 0)
            return response()->json($row);
        else 
            return response()->json('متاسفانه نتیجه ای یافت نشد');
    }
}
