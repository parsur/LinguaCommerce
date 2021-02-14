<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Media;
use App\Models\Description;
use App\Models\Status;
use App\Models\SubCategory;
use App\DataTables\ArticleDataTable;
use App\Http\Requests\StoreArticleRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreCourseRequest;
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
        // Media
        $vars['media'] = Media::select('id','media_url')->get();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('name','id')->get();
        // Status
        $vars['status'] = Status::select('id','status')->get();
        // Description
        $vars['description'] = Description::select('id','description')->get();

        return view('article.create', $vars);
    }

    // Store
    public function store(StoreArticleRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == "insert") {

            $this->add($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {

            $this->add($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success'   =>  $success_output);

        return json_encode($output);
    }

    // Edit Article
    public function edit(Request $request) {
        // Edit
        $article = Article::find($request->get('id'))->with('statuses','media', 'description_type')->first();
        return json_encode($article);
    }

    // Store
    public function add($request) {

        DB::beginTransaction();
        try {
            $article = Article::updateOrCreate(
                ['id' => $request->get('id')],
                ['title' => $request->get('title')]
            );
            // Status
            $article->statuses()->create(['status' => $request->get('status')]);

            // Description
            $article->description_type()->create(['description' => $request->get('description')]);

            // Image
            if($request->hasFile('media_url')) {
                foreach($request->file('media_url') as $media_url) {
                    $file = $media_url->getClientOriginalName();
                    $media_url->move(public_path('images'), $file);
                    // Media
                    $article->media()->create(['media_url' => $file, 'type' => 0]);
                }
            } 
            if($request->get('aparat_url')){
                $article->media()->create(['media_url' => $request->get('aparat_url'), 'type' => 1]);
            }
            DB::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Category::class,$id);
    }
}
