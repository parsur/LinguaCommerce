<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\CommentDataTable;
use App\Http\Requests\StoreCommentRequest;
use App\Providers\Action;
use App\Models\Comment;
use App\Providers\SuccessMessages;
use App\Models\Course;
use App\Models\Status;
use DB;

class CommentController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CommentDataTable();

        // Course comment Table
        $vars['courseCommentTable'] = $dataTable->html();

        return view('course.commentList', $vars);
    }

    // Get course comment
    public function courseCommentTable(CommentDataTable $dataTable) {
        return $dataTable->render('course.commentList');
    }

    // Store
    public function store($course_id, StoreCourseCommentRequest $request) {

        DB::beginTransaction();
        try {
            $comment = Comment::create(['name' => $request->get('name'), 'comment' => $request->get('comment'), 
                'commentable_id' => $course_id, 'commentable_type' => Course::class]);

            // Set the course's comment invisible
            $comment->statuses()->create(['status' => Status::INVISIBLE]);

            DB::commit();
            return response()->json('دیدگاه مرتبط به دوره با موفقیت ویرایش شد', JSON_UNESCAPED_UNICODE);

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
    public function update($course_id,StoreCommentRequest $request,SuccessMessages $message) {
        DB::beginTransaction();
        try {
            $comment = Comment::where('commentable_id', $course_id)->where('commentable_type', Course::class)
                ->update(['comment' => $request->get('comment'), 
                'commentable_id' => $course_id, 'commentable_type' => Course::class]);

            DB::commit();
            return response()->json('دیدگاه مرتبط به دوره با موفقیت ویرایش شد', JSON_UNESCAPED_UNICODE);

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
    public function submit(Request $request) {
        // Set the course's comment visible
        $comment = Comment::find($request->get('submission'));
        $comment->statuses()->update(['status' => Status::VISIBLE]);
        
        $output = array('success' => '<div class="alert alert-success">دیدگاه کاربر با موفقیت تایید شد</div>');

        return response()->json($output);
    }

}
