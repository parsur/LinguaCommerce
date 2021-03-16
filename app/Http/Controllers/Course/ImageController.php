<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\ImageDataTable;
use App\Http\Requests\Course\StoreImageRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Media;
use App\Models\Course;


class ImageController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new ImageDataTable();

        // CourseImage Table
        $vars['courseImageTable'] = $dataTable->html();

        return view('course.imageList', $vars);
    }

    // Get Course Image
    public function courseImageTable(ImageDataTable $dataTable) {
        return $dataTable->render('course.imageList');
    }

    // Store
    public function store(StoreImageRequest $request,SuccessMessages $message) {
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

    // Add Image
    public function add($request) {
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                // File
                $file = $image->getClientOriginalName();

                // Update
                $imageUpload = Media::find($request->get('id'));
                if(!$imageUpload) {
                    // Insert
                    $imageUpload = new Media();
                }
                $imageUpload->media_id = $request->get('course');
                $imageUpload->media_type = Course::class;
                // 0 = image
                $imageUpload->type = Media::IMAGE;

                if(isset($file)) {
                    File::delete(public_path("images/$imageUpload->url")); 
                    $imageUpload->url = $file;
                    $image->move(public_path('images'), $file);
                }
                $imageUpload->save();
            }
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class,$id,'url');
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}

