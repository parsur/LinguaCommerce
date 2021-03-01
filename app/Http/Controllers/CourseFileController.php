<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CourseFileDataTable;
use App\Http\Requests\StoreCourseFileRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Models\File;

class CourseFileController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new CourseFileDataTable();

        // CourseFile Table
        $vars['courseFileTable'] = $dataTable->html();

        return view('course.fileList', $vars);
    }

    // Get Course Image
    public function courseFileTable(CourseFileDataTable $dataTable) {
        return $dataTable->render('course.fileList');
    }

    // Store
    public function store(StoreCourseFileRequest $request,SuccessMessages $message) {

        // insert or update
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

    // Add file
    public function add($request) {
;
        foreach($request->file('files') as $file) {
            // Original file name
            $fileName = $file->getClientOriginalName();
            // Save the file
            $path = $file->storeAs('courseFiles', $fileName, 'public');

            // Update
            $fileUpload = File::find($request->get('id'));
            if(!$fileUpload) {
                // Insert
                $fileUpload = new File();
            }
            $fileUpload->course_id = $request->get('course');

            if(isset($fileName)) {
                $fileUpload->url = $fileName;
            }
            $fileUpload->save();
        }

    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(File::class, $id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(File::class,$request->get('id'));
    }
}
