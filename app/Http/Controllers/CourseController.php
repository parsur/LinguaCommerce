<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Status;
use App\Models\Media;
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

    // Get Course Description Page
    public function new(Request $request) {
        // Edit
        if($request->get('id')) {
            $vars['course'] = Course::find($request->get('id'));
        } else {
            $vars['course'] = '';
        }
        // Media
        $vars['media'] = Media::select('id','media_url')->get();
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('name','id')->get();
        // Status
        $vars['status'] = Status::select('id','status')->get();
        // Description
        $vars['description'] = Description::select('id','description')->get();

        return view('course.create', $vars);
    }

    // Store Course
    public function store(StoreCourseRequest $request,SuccessMessages $message, Action $action) {

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

    // Edit Course
    public function edit(Request $request) {
        // Edit
        $courses = Course::find($request->get('id'))->with('statuses','media', 'description_type')->first();
        return json_encode($courses);
    }

    // Add Course
    public function add($request) {

        DB::beginTransaction();
        try {
            $course = Course::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'price' => $this->convertToEnglish($request->get('price')), 
                'category_id' => $this->subSet($request->get('categories')), 
                'subCategory_id' => $this->subSet($request->get('subCategories'))]
            );
            // Status
            $course->statuses()->create(['status' => $request->get('status')]);

            // Description
            $course->description_type()->create(['description' => $request->get('description')]);

            // Image
            if($request->hasFile('media_url')) {
                foreach($request->file('media_url') as $media_url) {
                    $file = $media_url->getClientOriginalName();
                    $media_url->move(public_path('images'), $file);
                    // Media
                    $course->media()->create(['media_url' => $file, 'type' => 0]);
                }
            } 
            if($request->get('aparat_url')){
                $course->media()->create(['media_url' => $request->get('aparat_url'), 'type' => 1]);
            }
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

    // Convert To English
    public function convertToEnglish($number) {
        if($number != null) {
            $newNumbers = range(0,9);
            // 1. Persian Numeric
            $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    
            return str_replace($persian, $newNumbers, $number);
        } 
    }

    // Delete Each Course
    public function delete($id) {
        $course = Course::find($id);
        if($course) {
            foreach($course->media as $media) {
                // Media Image
                $imageDelete = public_path("images/" . $media->media_url);
                if($imageDelete) {
                    File::delete($imageDelete); 
                }
                $course->delete();
            }
        } 
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Details
    // public function details(Request $request) {
    //     Course::find($request->get('id'))->wit

    // }

}
