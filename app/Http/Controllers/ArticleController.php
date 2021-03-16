<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Description;
use App\Models\Status;
use App\Models\SubCategory;
use App\DataTables\ArticleDataTable;
use App\Http\Requests\StoreArticleRequest;
use App\Providers\Action;
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
        // Categories
        $vars['categories'] = Category::select('id','name')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('id','name')->get();

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
        // Status
        $vars['status'] = Status::select('id','status')->get();
        // Description
        $vars['description'] = Description::select('id','description')->get();

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

        return json_encode($output);
    }


    // Insert
    public function add($request) {

        $id = $request->get('id');

        DB::beginTransaction();
        
        try {
            $article = Article::updateOrCreate(
                ['id' => $id],
                ['title' => $request->get('title'), 'category_id' => $this->subSet($request->get('categories')), 
                'subCategory_id' => $this->subSet($request->get('subCategories'))]
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

    // Product SubSet
    public function subSet($request) {
        // Category Or Sub Category
        switch($request) {
            case '':
                return null;
                break;
            default:
                return $request;
        }
    }

    // Edit Course
    public function edit(Action $action, Request $request) {
        // Edit
        return $action->editCourseArticle(Article::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Article::class, $id);
    }

    // Search
    public function search(Request $request) {
        $action->search(Article::class,$request->get('search'),'title');
    }

    // Admin details
    public function adminDetails(Request $request) {

        $article = Article::findOrFail($request->get('id'));    
        return view('article.details', compact('article'));
    }

    // User details
    public function userDetails($id) {

        $article = Article::find($id);
        return response()->json($article);
        
    }   

}
