<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\FileDataTable;
use App\Http\Requests\StoreCourseFileRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Models\File;
use Illuminate\Support\Str;
use Storage;
use ZipArchive;

class FileController extends Controller
{
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
            $fileUpload = File::find($request->get('id'));
            $fileUpload->course_id = $request->get('course');

            // Store this storage
            $file->storeAs('public/courseFiles', $fileName);

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

            $fileUpload = new File();
            // Original file name
            $fileUpload->course_id = $request->get('course');
            // File url
            $file->storeAs('public/courseFiles', $fileName);
            $fileUpload->url = $file->getClientOriginalName();

            $fileUpload->save();
        }
    }

    // Delete
    public function delete($id) {
        $courseFile = File::find($id);
        if ($courseFile) {
            Storage::disk('public')->delete($fileUpload->url);
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(File::class,$request->get('id'));
    }

    // Download file
    public function download() {
        // Zip file
        $zip = new ZipArchive;
        $zip_file = 'invoices.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $invoice_file = 'CGtoIELTS-video-10.mp4';

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        $zip->addFile(storage_path($invoice_file), $zip_file);
        $zip->close();

        return response()->json('test');


    }
}
