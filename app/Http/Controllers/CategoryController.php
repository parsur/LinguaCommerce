<?php

namespace App\Http\Controllers;
use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\SubCategory;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreCategoryRequest; 
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new CategoryDataTable();

        // Category Table
        $vars['categoryTable'] = $dataTable->html();

        return view('category.categoryList', $vars);
    }

    // Category Table
    public function categoryTable(CategoryDataTable $dataTable) {
        return $dataTable->render('category.categoryList');
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

        $output = array('success' => $success_output);
        
        return json_encode($output);
    }

    // Store
    public function add($request) {
        DB::beginTransaction();
        try {
            $category = Category::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name')]
            );

            $category->statuses()->create(['status' => $request->get('status')]);

            Db::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->editRelation(Category::class,$request->get('id'),'statuses');
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Category::class, $id);
    }

    // Sub Categories based on categories
    public function ajax_subCategory(Request $request) {

        $c_id = $request->get('category_id');
        $subCategory = SubCategory::where('category_id', $c_id)->get();

        return json_encode($subCategory);
    }


}
