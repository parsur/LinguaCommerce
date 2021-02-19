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

        $id = $request->get('id');

        DB::beginTransaction();
        try {
            $category = Category::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name')]
            );

            // Status
            $category->statuses()->updateOrCreate(
                ['status_id' => $id],
                ['status' => $request->get('status'), 'status_type' => Category::class]
            );

            Db::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->editWithStatus(Category::class, $request->get('id'));
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
