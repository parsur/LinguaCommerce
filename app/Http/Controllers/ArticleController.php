<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Status;
use App\DataTables\ArticleDataTable;
use App\Http\Requests\StoreArticleRequest;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use App\Providers\SuccessMessages;
use DB;

class ArticleController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
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
    public function new(Request $request, CourseArticleAction $action) {
        // Edit
        if($request->get('id')) {
            $vars['article'] = Article::find($request->get('id'));
        } else {
            $vars['article'] = '';
        }
    
        // Categories
        $vars['categories'] = Category::select('id', 'name')->with('articles')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('id', 'name')->with('articles')->get();

        return view('article.create', $vars);
    }

    // Store Course
    public function store(StoreArticleRequest $request,SuccessMessages $message) {
        // Insert or update
        $this->add($request);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return response()->json($output);
    }


    // Insert
    public function add($request) {

        $id = $request->get('id');

        // Course article
        $courseArticle = new CourseArticleAction;

        DB::beginTransaction();
        try {
            $article = Article::updateOrCreate(
                ['id' => $id],
                ['title' => $request->get('title'), 'category_id' => $courseArticle->subSet($request->get('categories')), 
                'subCategory_id' => $courseArticle->subSet($request->get('subCategories'))]
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

            DB::commit();
        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Edit Course
    public function edit(CourseArticleAction $action, Request $request) {
        // Edit
        return $action->edit(Article::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Article::class, $id);
    }

    // Show
    public function show() {
        // Articles
        $vars['artciles'] = Article::select('id', 'title','created_at','updated_at')->with('statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name',
            'media:media_id,url', 'comments:commentable_id,comment')->get();
        
        // Categories
        $vars['categories'] = Category::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->with('courses')->get();
        
        // Sub Category
        $vars['subCategories'] = SubCategory::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->with('courses')->get();

        return response()->json($vars);
    }

    // Search
    public function search(Request $request) {
        return $action->search(Article::class,$request->get('search'),'title');
    }

    // Details
    public function details(CourseArticleAction $action, Request $request) {
        return $action->details($request->get('id'), Article::class, 'article', $request->get('role'));
    }

}
