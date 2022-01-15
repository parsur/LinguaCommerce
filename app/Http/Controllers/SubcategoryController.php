<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\DataTables\SubcategoryDataTable;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Providers\Action;
use DB;

class SubcategoryController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }

    // Get category
    public function list(Request $request) {

        $datatable = new SubcategoryDataTable;
        
        // Subcategories
        $vars['subcategoryTable'] = $datatable->html();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();

        return view('category.subcategoryList', $vars);
    }

    // Render datatable
    public function subcategoryTable(SubcategoryDataTable $datatable) {
        return $datatable->render('category.subcategoryList');
    }

    // Store or update 
    public function store(StoreSubcategoryRequest $request) {

        DB::transaction(function() use($request) {

            $id = $request->get('id');

            $subcategory = Subcategory::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name'), 'category_id' => $request->get('categories')]
            );

            // Status
            $subcategory->statuses()->updateOrCreate(
                ['status_id' => $id],
                ['status' => $request->get('status'), 'status_type' => Subcategory::class]
            );

        });

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Request $request) {
        return $this->action->editWithStatus(Subcategory::class, $request->get('id'));
    }

    // Delete
    public function delete($id) {
        return $this->action->delete(Subcategory::class, $id);
    }
}
