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
        foreach($request->get('courses') as $course) {
            Media::updateOrCreate(
                ['id' => $request->get('id')],
                ['url' => $request->get('aparat_url'), 'media_id' => $course, 'media_type' => Course::class, 'type' => Media::VIDEO]
            );
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
