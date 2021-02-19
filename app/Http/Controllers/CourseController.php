<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Image;
use App\Models\Video;
use App\Models\SubCategory;
use App\Models\Status;
use App\Models\Description;
use App\DataTables\CourseDataTable;
use App\Http\Requests\StoreCourseRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
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
        
        // Status
        $vars['status'] = Status::select('id','status')->get();
        // Description
        $vars['description'] = Description::select('id','description')->get();

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

        return json_encode($output);
    }


    // Insert
    public function add($request) {

        $id = $request->get('id');

        DB::beginTransaction();
        try {
            $course = Course::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name'), 'price' => $this->convertToEnglish($request->get('price')), 
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

    // Convert To English
    public function convertToEnglish($number) {

        if($number != null) {
            $newNumbers = range(0,9);
            // 1. Persian Numeric
            $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    
            return str_replace($persian, $newNumbers, $number);
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
    public function edit(Request $request) {
        // Edit
        $course = Course::where('id', $request->get('id'))->with('statuses','image', 'video', 'description')->first();
        return json_encode($course);
    }

    // Delete Each Course
    public function delete(Action $action,$id) {
        return $action->delete(Course::class, $id);
    }

    // Details
    public function details(Request $request) {

        $course = Course::where('id', $request->get('id'))->first();
        return view('course.details', compact('course'));
    }

    // Get Course Image Page
    public function newImage(Request $request) {
        // Store Image
        $vars['courses'] = Course::select('name', 'id')->get();
        return view('course.create', $vars);
    }

    // Store Course Image
    public function storeImage(StoreCourseRequest $request,SuccessMessages $message) {

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

        return json_encode($output);
    }

}
