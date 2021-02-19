<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseVideoRequest;
use App\DataTables\CourseVideoDataTable;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Video;
use App\Models\Course;
use DB;

class CourseVideoController extends Controller
{
    // DataTable to blade
    public function list() {
        $dataTable = new CourseVideoDataTable;

        // Video Table
        $vars['courseVideoTable'] = $dataTable->html();

        return view('course.videoList', $vars);
    }

    // Rendering DataTable
    public function courseVideoTable(CourseVideoDataTable $dataTable) {
        return $dataTable->render('course.videoList');
    }

    public function store(StoreCourseVideoRequest $request,SuccessMessages $message) {

        // Insert or update
        $this->add($request);
        
        // Insert
        if($request->get('button_action') == 'insert') {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return json_encode($output);

    }

    // Add Video
    public function add($request) {

        // Course videos
        foreach($request->get('courses') as $course) {
            Video::updateOrCreate(
                ['id' => $request->get('id')],
                ['video_url' => $request->get('aparat_url'), 'video_id' => $course, 'video_type' => Course::class]
            );
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Video::class,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Video::class,$request->get('id'));
    }
}
