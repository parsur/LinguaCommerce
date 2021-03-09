<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\FileDataTable;
use App\Http\Requests\Course\StoreFileRequest;
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
    public function store(StoreFileRequest $request,SuccessMessages $message) {
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
        // Insert Course videos
        $this->file::updateOrCreate(
            ['id' => $request->get('id')],
            ['url' => $request->get('url'), 'course_id' => $request->get('course')]
        );
    }


    // Delete
    public function delete($id, Action $action) {
        return $action->delete($this->file,$id);
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
