<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Status;
use App\DataTables\CourseDataTable;
use App\Http\Requests\StoreCourseRequest;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use App\Providers\SuccessMessages;
use App\Providers\EnglishConvertion;
use Auth;
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
    public function new(Request $request, CourseArticleAction $action) {

        // Edit
        if($request->get('id')) {
            $vars['course'] = Course::find($request->get('id'));
        } else {
            $vars['course'] = '';
        }

        // Categories
        $vars['categories'] = Category::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->with('courses')->get();

        // Sub Categories
        $vars['subCategories'] = SubCategory::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->with('courses')->get();

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

        // Course article
        $courseArticle = new CourseArticleAction;
        // English convertion
        $englishConvertion = new EnglishConvertion();

        DB::beginTransaction();

        try {
            $course = Course::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name'), 'price' => $request->get('price'), 
                'category_id' => $courseArticle->subSet($request->get('categories')), 
                'subCategory_id' => $courseArticle->subSet($request->get('subCategories'))]
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

    // Edit
    public function edit(CourseArticleAction $action, Request $request) {
        return $action->edit(Course::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Course::class, $id);
    }

    // Show course list page
    public function show() {
        // Courses
        $vars['courses'] = Course::select('id', 'name', 'price')->with('statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name',
            'media:media_id,url')->get();
    
        // Categories
        $vars['categories'] = Category::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->get();

        // Sub Categories
        $vars['subCategories'] = SubCategory::select('id', 'name')->whereHas('statuses', function($query) {
            $query->active();
        })->get();
        
        return response()->json($vars);
    } 

    // Search
    public function search(Action $action, Request $request) {
        return $action->search(Course::class, $request->get('search'), 'name');
    }

    // Details
    public function details(CourseArticleAction $action, Request $request) {
        return $action->details($request->get('id'), Course::class, 'course', $request->get('role'));
    }

    // User details
    // public function userDetails($id, CourseArticleAction $action) {
    //     return $this->detailsHandler($request->get('id'), 'user');
    // }   

    // // Detials handler
    // public function detailsHandler($id, $role = 'admin') {
    //     $vars['course'] = Course::find($id);

    //     if($role != 'admin')
    //         return response()->json($vars);

    //     return view('course.details', $vars);
    // }

}
