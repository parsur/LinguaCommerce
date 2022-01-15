<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Article;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Status;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use App\DataTables\ArticleDataTable;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\SearchRequest;
use DB;

class ArticleController extends Controller
{
    public $action;

    public function __construct() {

        $this->action = new CourseArticleAction();

        // Categories
        $this->categories = Category::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->with('courses')->get();

        // Subcategories
        $this->subcategories = Subcategory::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->get();
        
    }

    // Datatable to blade
    public function list() {
        
        $dataTable = new ArticleDataTable();

        // Article Table
        $vars['articleTable'] = $dataTable->html();

        return view('article.list', $vars);
    }

    // Article Table
    public function articleTable(ArticleDataTable $dataTable) {
        return $dataTable->render('article.list');
    }

    // Get Course Description Page
    public function new(Request $request) {
        // Edit
        if($request->get('id')) {
            $vars['article'] = Article::find($request->get('id'));
        } else {
            $vars['article'] = '';
        }
    
        // Categories
        $vars['categories'] = $this->categories;

        // Sub Categories
        $vars['subcategories'] = $this->subcategories;

        return view('article.create', $vars);
    }

    // Store Course
    public function store(StoreArticleRequest $request) {

        DB::transaction(function() use($request) {
            
            $id = $request->get('id');

            $article = Article::updateOrCreate(
                ['id' => $id],
                ['title' => $request->get('title'), 'category_id' => $request->get('categories'), 
                'subcategory_id' => $request->get('subcategories')]
            );
            // Status
            $article->statuses()->updateOrCreate(
                ['status_id' => $id],
                ['status' => $request->get('status'), 'status_type' => Article::class]
            );

            // Description
            $article->description()->updateOrCreate(
                ['description_id' => $id],
                ['description' => $request->get('description'), 'description_type' => Article::class]
            );

        });

        return $this->getAction($request->get('button_action'));
    }


    // Edit Course
    public function edit(Request $request) {
        // Edit
        return $this->action->edit(Article::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Article::class, $id);
    }

    // Show
    public function show() {
        // Articles
        $vars['artciles'] = Article::select('id', 'title', 'created_at', 'updated_at', 'category_id', 'subcategory_id')->with(['statuses:status_id,status',
            'description:description_id,description','category:id,name','subcategory:id,name',
            'media' => function($query) {
                $query->image()->first();
            }])->get();
        
        // Categories
        $vars['categories'] = $this->categories;
        
        // Sub Categories
        $vars['subcategories'] = $this->subcategories;

        return response()->json($vars);
    }

    // Search
    public function search(SearchRequest $request) {
        return $this->action->search($request, Article::class);
    }

    // Details
    public function details(Request $request) {
        return $this->action->details($request, 'App\Models\Article');
    }

}
