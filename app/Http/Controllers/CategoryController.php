<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Subcategory;
use App\Providers\Action;
use App\Http\Requests\StoreCategoryRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    // Datatable to blade
    public function list() {
        // Datatable
        $dataTable = new CategoryDataTable();

        // Category table
        $vars['categoryTable'] = $dataTable->html();

        return view('category.categoryList', $vars);
    }

    // Category table
    public function categoryTable(CategoryDataTable $dataTable) {
        return $dataTable->render('category.categoryList');
    }

    // Store
    public function store(StoreCategoryRequest $request) {

        $id = $request->get('id');

        \DB::beginTransaction();
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

            \DB::commit();

        } catch(Exception $e) {
            throw $e;
            \DB::rollBack();
        }

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action, Request $request) {
        return $action->editWithStatus(Category::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Category::class, $id);
    }

    // Sub Categories based on categories
    public function ajax_sub_category(Request $request) {

        $category_id = $request->get('category_id');
        
        $subcategory = Subcategory::where('category_id', $category_id)->get();

        return response()->json($subcategory);
    }
 

}
