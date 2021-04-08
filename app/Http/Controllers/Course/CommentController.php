<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\CommentDataTable;
use App\Http\Requests\StoreCommentRequest;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use App\Providers\SuccessMessages;
use App\Models\Comment;
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

        return view('course.comment.list', $vars);
    }

    // Get course comment
    public function courseCommentTable(CommentDataTable $dataTable) {
        return $dataTable->render('course.comment.list');
    }

    // Store
    public function store(StoreCommentRequest $request) {

        DB::beginTransaction();
        try {
            $comment = Comment::create(['name' => $request->get('name'), 'comment' => $request->get('comment'), 
                'commentable_id' => $request->get('course_id'), 'commentable_type' => Course::class]);

            // Set the course's comment invisible
            $comment->statuses()->create(['status' => Status::INVISIBLE]);

            DB::commit();
            return response()->json('دیدگاه مرتبط به دوره با موفقیت ثبت شد', JSON_UNESCAPED_UNICODE);

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Edit
    public function edit(Action $action, Request $request) {
        $action->edit(Comment::class, $request->get('id')); 
    }

    // Update
    public function update(StoreCommentRequest $request,SuccessMessages $message) {
        DB::beginTransaction();
        try {
            $comment = Comment::where('id', $request->get('id'))->where('commentable_type', Course::class)
                ->update(['comment' => $request->get('comment')]);

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

    // Comment submitted by admin to be shown for user.
    public function submit(Request $request, CourseArticleAction $action) {
        // Set the course's comment visible
        return $action->comment($request->get('submission'));
    }

    // Details
    public function details(Request $request) {
        $vars['comment'] = Comment::find($request->get('id'));
        return view('course.comment.details', $vars);
    }

}
