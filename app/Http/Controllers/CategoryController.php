<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\StoreCategoryRequest; 
use App\Models\Category;
use App\Models\Subcategory;
use App\Providers\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }

    // Datatable to blade
    public function list() {
        
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

        DB::transaction(function() use($request) {

            $id = $request->get('id');

            $category = Category::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name')]
            );

            // Status
            $category->statuses()->updateOrCreate(
                ['status_id' => $id],
                ['status' => $request->get('status'), 'status_type' => Category::class]
            );
        });

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Request $request) {
        return $this->action->editWithStatus(Category::class, $request->get('id'));
    }

    // Delete
    public function delete($id) {
        return $this->delete(Category::class, $id);
    }

    // Sub Categories based on categories
    public function ajax_sub_category(Request $request) {

        $category_id = $request->get('category_id');
        $subcategory = Subcategory::where('category_id', $category_id)->get();

        return response()->json($subcategory);
    }
 

}
