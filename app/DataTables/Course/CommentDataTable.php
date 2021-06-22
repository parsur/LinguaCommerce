<?php

namespace App\DataTables\Course;

use App\Models\Comment;
use App\Models\Course;
use App\Datatables\GeneralDataTable; 
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable; 
use \Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use URL;


class CommentDataTable extends DataTable
{
    public $dataTable;

    public function __construct() {
        $this->dataTable = new GeneralDataTable();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function(Comment $comment){
                return Jalalian::forge($comment->created_at);
            })
            ->editColumn('comment', function(Comment $comment) {
                return Str::limit(optional($comment)->comment, 15, '(جزئیات)');
            })
            ->addColumn('commentable_id', function (Comment $comment) {
                return $comment->commentable->name;
            })
            ->filterColumn('commentable_id', function ($query, $keyword) {
                $sql = 'id in (select commentable_id from comments where comment like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function(Comment $comment){
                $id = $comment->id;
                $details = '';

                if($comment->comment)
                    $details = URL::signedRoute('courseComment.details', ['id' => $id]);

                return $this->action($id, $details); 
            });
    } 

     // Action column
     public function action($id, $details) {

        return $this->dataTable->deleteAction($id) . 
                '&nbsp; <a onclick="showSubmissionModal('.$id.')">
                    <i class="fa fa-paper-plane text-danger" aria-hidden="true"></i>
                </a>'.
                $this->dataTable->detailsAction($details); 
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comment $model)
    {
        return $model::where('commentable_type', Course::class);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'courseComment');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام کاربر'),
            Column::make('comment')
            ->title('دیدگاه'),
            Column::make('created_at')
            ->title('ساخته شده در'),
            Column::make('commentable_id')
            ->title('دوره مرتبط')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | تایید دیدگاه | جزئیات')
        ];
    }
}
