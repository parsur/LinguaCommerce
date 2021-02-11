<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Description;
use App\DataTables\CourseDataTable;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\StoreDescriptionRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use Illuminate\Http\Request;
use DB;

class CourseController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CourseDataTable();

        // Course Table
        $vars['courseTable'] = $dataTable->html();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('name','id')->get();

        return view('course.courseList', $vars);
    }

    // Get Course
    public function courseTable(CourseDataTable $dataTable) {
        return $dataTable->render('course.courseList');
    }

    // Store Course
    public function store(StoreCourseRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == 'insert') {
            $this->add($request);
            $success_message = $message->getInsert();
        }
        // Update
        if($request->get('button_action') == 'update') {
            $this->add($request);
            $success_message = $message->getUpdate();
        }

        $output = array('success' => $success_message);

        return json_encode($output);
    }

    // Add Course
    public function add($request) {
        
        DB::transaction(function () {
            $course = Course::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'price' => $this->convertToEnglish($request->get('price')), 
                'category_id' => $this->subSet($request->get('categories')), 'subCategory_id' => $this->subSet($request->get('subCategories'))]
            );
            $course->statuses()->create(['status' => $request->get('status')]);
        });
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

    // Convert To English
    public function convertToEnglish($number) {
        $newNumbers = range(0,9);
        // 1. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        return str_replace($persian, $newNumbers, $number); 
    }

    // Delete Each Course
    public function delete(Action $action, $id) {
        return $action->delete(Course::class,$id);
    }

    // Edit Course
    public function edit(Action $action,Request $request) {
        return $action->editRelation(Course::class,$request->get('id'),'statuses');
    }

    // Sub Categories based on categories
    public function ajax_subCategory(Request $request) {
        $c_id = $request->get('category_id');
        $subCategory = SubCategory::where('category_id', $c_id)->get();

        return json_encode($subCategory);
    }

    // Get Course Description Page
    public function newDesc() {

        $courses = Course::select('name','id')->get();
        return view('course.newDescription', compact('courses'));
    }

    // Store Description
    public function storeDesc(StoreDescriptionRequest $request,SuccessMessages $message) {

        foreach($request->get('courses') as $course) {
            Description::create([
                'description' => $request->get('description'),
                'description_id' => $course,
                'description_type' => $request->get('model')
            ]);
        }

        $success_message = $message->getInsert();
        $output = array('success' => $success_message);

        return json_encode($output);
    }
}
