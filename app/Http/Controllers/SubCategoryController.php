<?php

namespace App\Http\Controllers;

use App\Providers\SuccessMessages;
use Illuminate\Database\Eloquent\Model;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Providers\Action;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use DB;
use File;

class SubCategoryController extends Controller
{
    // get Category Data
    public function list(Request $request) {
        $datatable = new SubCategoryDataTable;
        
        // Sub categories
        $vars['subCategoryTable'] = $datatable->html();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();

        return view('category.subCategoryList', $vars);
    }

    // Render Datatable
    public function subCategoryTable(SubCategoryDataTable $datatable) {
        return $datatable->render('category.subCategoryList');
    }

    // Store or Update Category
    public function store(StoreSubCategoryRequest $request,SuccessMessages $message) {
        // Add
        $this->add($request);
        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return response()->json($output);
    }

    // Add SUb Category
    public function add($request) {

        DB::beginTransaction();
        try {
            $subCategory = SubCategory::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'category_id' => $request->get('categories')]
            );

            // Status
            $subCategory->statuses()->updateOrCreate(
                ['status_id' => $request->get('id')],
                ['status' => $request->get('status'), 'status_type' => SubCategory::class]
            );

            DB::commit();
            
        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Edit Sub Catgory Data
    public function edit(Action $action,Request $request) {
        return $action->editWithStatus(SubCategory::class, $request->get('id'));
    }

    // Delete Each Category
    public function delete(Action $action,$id) {
        return $action->delete(SubCategory::class,$id);
    }


}
