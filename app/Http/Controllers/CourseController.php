<?php

namespace App\Http\Controllers;
use App\DataTables\CourseDataTable;
use App\Http\Requests\StoreCourseRequest;
use App\Providers\SuccessMessages;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public $course = 'App\Models\Course';
    
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CourseDataTable();

        // Course Table
        $vars['courseTable'] = $dataTable->html();

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
            $this->addCourse($request);
            $success_message = $message->getInsert();

        }
        // Update
        if($request->get('button_action') == 'update') {
            $this->addCourse($request);
            $success_message = $message->getUpdate();
        }

        $output = array('success' => $success_message);

        return json_encode($output);
    }

    // Add Course
    public function addCourse($request) {
        // Edit
        $course = Course::find($request->get('id'));
        if(!$course) {
            $course = new Course();
        }
        $course->name = $request->get('name');
        $course->price = $Request->get('price');
        $course->status = $request->get('status');
        
        $course->save();
    }

    // Delete Each Course
    public function delete(Action $action, $id) {
        return $action->delete($this->course,$id);
    }

    // Edit Course
    public function edit(Action $action,Request $request) {
        return $action->edit($this->course,$request->get('id'));
    }
}
