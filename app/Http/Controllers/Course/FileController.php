<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\FileDataTable;
use App\Http\Requests\StoreCourseFileRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use Illuminate\Support\Str;
use Storage;
use ZipArchive;
use File;


class FileController extends Controller
{
    public $file = 'App\Models\File';
    
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new FileDataTable();

        // CourseFile Table
        $vars['courseFileTable'] = $dataTable->html();

        return view('course.fileList', $vars);
    }

    // Get Course Image
    public function courseFileTable(FileDataTable $dataTable) {
        return $dataTable->render('course.fileList');
    }

    // Store
    public function store(StoreCourseFileRequest $request,SuccessMessages $message) {
        // Insert
        if($request->get('button_action') == 'insert') {
            $this->insert($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->update($request);
            $success_output = $message->getUpdate();
        }
        
        $output = array('success' => $success_output);
        return json_encode($output);
    }

    // Update
    public function update($request) {
        foreach($request->file('files') as $file) {
            // Original file name
            $fileName = $file->getClientOriginalName();

            // Update
            $fileUpload = $this->file::find($request->get('id'));
            $fileUpload->course_id = $request->get('course');

            // Store this storage
            $file->storeAs('courseFiles', $fileName);

            if(isset($fileName)) {
                Storage::disk('public')->delete($fileUpload->url); 
                $fileUpload->url = $fileName;
            }
            
            $fileUpload->save();
        }

    }

    // insert
    public function insert($request) {
        foreach($request->file('files') as $file) {
            // File name
            $fileName =  $file->getClientOriginalName();

            $fileUpload = new $this->file();
            // Original file name
            $fileUpload->course_id = $request->get('course');
            // File url
            $file->storeAs('courseFiles', $fileName);
            $fileUpload->url = $file->getClientOriginalName();

            $fileUpload->save();
        }
    }

    // Delete
    public function delete($id) {
        $courseFile = \App\Models\File::find($id);
        if ($courseFile) {
            Storage::disk('public')->delete($fileUpload->url);
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit($this->file,$request->get('id'));
    }

    // Download file
    public function download() {
        // Zip file
        $zip = new ZipArchive;
        $zip_file = 'courseFiles.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        if($zip->open(public_path('storage/'.$zip_file), \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            // Adding file: second parameter is what will the path inside of the archive
            // So it will create another folder called "storage/" inside ZIP, and put the file there.
            foreach(File::files(public_path('storage/courseFiles')) as $key => $file) {
                $relativeName = basename($file);
                $zip->addFile($file, $relativeName);
            }
        }

        // Close
        $zip->close();

        return response()->download(public_path('storage/'.$zip_file));
    }
}
