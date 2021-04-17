<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\ImageDataTable;
use App\Http\Requests\Course\StoreImageRequest;
use App\Models\Media;
use App\Models\Course;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use File;


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

    // Get course image
    public function courseImageTable(ImageDataTable $dataTable) {
        return $dataTable->render('course.imageList');
    }

    // Store
    public function store(StoreImageRequest $request, Action $action) {

        // insert or update
        $imageUploader = Media::find($request->get('id'));
        $action->image($imageUploader, $request, $request->get('course'), Course::class);

        // Insert
        if($request->get('button_action') == 'insert') {
            $success_output = $this->getInsertionMessage();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $this->getUpdateMessage();
        }
        
        return response()->json(['success' => $success_output]);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class,$id,'url');
    }
}

