<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Article\CommentDataTable;
use App\Http\Requests\StoreArticleCommentRequest;
use App\Providers\Action;

class CommentController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CommentDataTable();

        // Article comment Table
        $vars['articleCommentTable'] = $dataTable->html();

        return view('article.commentList', $vars);
    }

    // Get article comment
    public function articleCommentTable(CommentDataTable $dataTable) {
        return $dataTable->render('article.commentList');
    }

    // Store
    public function store($article_id, StoreCommentRequest $request) {
        DB::beginTransaction();
        try {
            $comment = Comment::create(['name' => $request->get('name'), 'comment' => $request->get('comment'), 
                'commentable_id' => $article_id, 'commentable_type' => Article::class]);

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
    public function update($article_id, Request $request) {
        DB::beginTransaction();
        try {
            $comment = Comment::where('commentable_id', $article_id)->where('commentable_type', Article::class)
                ->update(['comment' => $request->get('comment'), 
                'commentable_id' => $article_id, 'commentable_type' => Article::class]);

            DB::commit();
            return response()->json('نظر درباره دوره با موفقیت ویرایش شد');

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    // Submit the comment
    public function submit(StoreCommentRequest $request, SuccessMessages $message) {
        // Set the article's comment visible
        $comment = Comment::find($request->get('submission'));
        $comment->statuses()->update(['status' => Status::VISIBLE]);
        
        $output = array('success' => $message->getInsert());

        return json_encode($output);
    }

    // Delete
    public function delete($id,Action $action) {
        return $action->delete(Comment::class, $id);
    }
}
