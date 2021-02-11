<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;
use App\DataTables\ArticleDataTable;

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

        return view('article.articleList', $vars);
    }

    // Category Table
    public function categoryTable(CategoryDataTable $dataTable) {
        return $dataTable->render('article.articleList');
    }

    // Store
    public function store(StoreCategoryRequest $request,SuccessMessages $message) {
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

    // Store
    public function add($request) {
        DB::transaction(function () {
            $category = Article::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name')]
            );

            $category->statuses()->create(['status' => $request->get('status')]);
        });
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->editRelation(Category::class,$request->get('id'),'statuses');
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Category::class,$id);
    }
}
