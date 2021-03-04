<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CourseCommentDataTable;
use App\Http\Requests\StoreCourseCommentRequest;
use App\Providers\Action;
use App\Models\Comment;
use App\Providers\SuccessMessages;
use App\Models\Course;
use App\Models\Status;
use DB;

class CourseCommentController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CourseCommentDataTable();

        // Course comment Table
        $vars['courseCommentTable'] = $dataTable->html();

        return view('course.commentList', $vars);
    }

    // Get course comment
    public function courseCommentTable(CourseCommentDataTable $dataTable) {
        return $dataTable->render('course.commentList');
    }

    // Store
    public function store(StoreCourseCommentRequest $request,$course_id) {

        DB::beginTransaction();
        try {
            $comment = Comment::create(['comment' => $request->get('comment'), 
                'commentable_id' => $request->get('course'), 'commentable_type' => Course::class]);

            // Set the course's comment invisible
            $comment->statuses()->create(['status' => Status::INVISIBLE]);

            DB::commit();
            return response()->json('نظر درباره دوره با موفقیت ویرایش شد');

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Edit
    public function edit($id) {
        $vars['courseComment'] = Comment::findOrFail($id);
        return response()->json($vars); 
    }

    // Update
    public function update($id,StoreCourseCommentRequest $request,SuccessMessages $message) {
        DB::beginTransaction();
        try {
            $comment = Comment::find($id)->update(['comment' => $request->get('comment'), 
                'commentable_id' => $request->get('course'), 'commentable_type' => Course::class]);

            DB::commit();
            return response()->json('نظر درباره دوره با موفقیت ویرایش شد');

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Delete
    public function delete($id,Action $action) {
        return $action->delete(Comment::class, $id);
    }

    // Submit the comment
    public function submit(Request $request, SuccessMessages $message) {
        // Set the course's comment visible
        $comment = Comment::find($request->get('submission'));
        $comment->statuses()->update(['status' => Status::VISIBLE]);
        
        $output = array('success' => $message->getInsert());

        return json_encode($output);
    }

}
