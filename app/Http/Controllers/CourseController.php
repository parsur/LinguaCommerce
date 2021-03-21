<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\DataTables\CourseDataTable;
use App\Http\Requests\StoreCourseRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Providers\EnglishConvertion;
use Illuminate\Http\Request;
use DB;
use File;

class CourseController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CourseDataTable();

        // Course Table
        $vars['courseTable'] = $dataTable->html();

        return view('course.list', $vars);
    }

    // Get Course
    public function courseTable(CourseDataTable $dataTable) {
        return $dataTable->render('course.list');
    }

    // Get Course Page
    public function new(Request $request) {
        // Edit
        if($request->get('id')) {
            $vars['course'] = Course::find($request->get('id'));
        } else {
            $vars['course'] = '';
        }
        // Categories
        $vars['categories'] = \App\Models\Category::select('id','name')->get();
        // Sub Categories
        $vars['subCategories'] = \App\Models\SubCategory::select('id','name')->get();
        // Status
        $vars['status'] = \App\Models\Status::select('id','status')->get();
        // Description
        $vars['description'] = \App\Models\Description::select('id','description')->get();

        return view('course.create', $vars);
    }

    // Store Course
    public function store(StoreCourseRequest $request,SuccessMessages $message) {
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
        return response()->json($output);
    }

    // Insert
    public function add($request) {

        $id = $request->get('id');

        // English convertion
        $englishConvertion = new EnglishConvertion();

        DB::beginTransaction();

        try {
            $course = Course::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name'), 'price' => $englishConvertion->convert($request->get('price')), 
                'category_id' => $this->subSet($request->get('categories')), 'subCategory_id' => $this->subSet($request->get('subCategories'))]
            );
            // Status
            $course->statuses()->updateOrCreate(
                ['status_id' => $id],
                ['status' => $request->get('status'), 'status_type' => Course::class]
            );

            // Description
            $course->description()->updateOrCreate(
                ['description_id' => $id],
                ['description' => $request->get('description'), 'description_type' => Course::class]
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
        return $action->editCourseArticle(Course::class, $request->get('id'));
    }

    // Delete Each Course
    public function delete(Action $action,$id) {
        return $action->delete(Course::class, $id);
    }

    // Show course page
    public function show() {
        $vars['courses'] = Course::all();
        return response()->json($courses);
    }

    // Search
    public function search(Action $action,Request $request) {
        $action->search(Course::class,$request->get('search'),'name');
    }

    // Admin Details
    public function details(Request $request) {

        $course = Course::findOrFail($request->get('id'));
        return view('course.details', compact('course'));
    }

    // User datails
    public function userDetails($id) {

        $course = Course::findOrFail($id);
        return response()->json($course);
    }


}
