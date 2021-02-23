<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CourseImageDataTable;
use App\Http\Requests\StoreCourseImageRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Image;
use App\Models\Course;
use DB;


class CourseImageController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new CourseImageDataTable();

        // Course Image Table
        $vars['courseImageTable'] = $dataTable->html();
        // Courses
        $vars['courses'] = Course::select('id','name')->get();

        return view('course.imageList', $vars);
    }

    // Get Course Image
    public function courseImageTable(CourseImageDataTable $dataTable) {
        return $dataTable->render('course.imageList');
    }

    // Store
    public function store(StoreCourseImageRequest $request,SuccessMessages $message) {

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

        DB::beginTransaction();

        try {
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $file = $image->getClientOriginalName();
                $image->move(public_path('images'), $file);
            }   

            foreach($request->get('courses') as $image_id) {
                // Update
                $imageUpload = Image::find($request->get('id'));
                if(!$imageUpload) {
                    // Insert
                    $imageUpload = new Image();
                }
                $imageUpload->image_id = $image_id;
                $imageUpload->image_type = Course::class;
    
                if(isset($file)) {
                    $imageUpload->image_url = $file;
                }
                $imageUpload->save();
            }

            DB::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Image::class,$id,'image_url');
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Image::class,$request->get('id'));
    }
}
