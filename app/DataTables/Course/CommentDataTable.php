<?php

namespace App\DataTables\Course;

use App\Models\Comment;
use App\Models\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;


class CommentDataTable extends DataTable
{
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
                date_default_timezone_set('Asia/Tehran');
                return Jalalian::forge($comment->created_at)->format('%A, %d %B %y');
            })
            ->editColumn('commentable_id', function (Comment $comment) {
                return $comment->commentable->name;
            })
            ->filterColumn('commentable_id', function ($query, $keyword) {
                $courses = Comment::whereHas('commentable', function($subquery) use ($keyword) {
                    $subquery->where('name', 'LIKE', '%'.$keyword.'%');
                })->get()->pluck('id')->toArray();

                $query->whereIn('id', $courses);
            })
            ->addColumn('action', function(Comment $comment){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$comment->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showSubmissionModal('{$comment->id}')">
                                <i class="fa fa-paper-plane text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comment $model)
    {
        return $model::where('commentable_type',Course::class);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('courseCommentTable')
                ->minifiedAjax(route('courseComment.list.table'))
                ->columns($this->getColumns())
                ->columnDefs(
                    [
                        ["className" => 'dt-center text-center', "target" => '_all'],
                    ]
                )
                ->searching(true)
                ->info(false)
                ->ordering(true)
                ->responsive(true)
                ->pageLength(8)
                ->dom('PBCfrtip')
                ->orderBy(1)
                ->language(asset('js/Persian.json'));
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
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام کاربر')
                ->addClass('column-title'),
            Column::make('comment')
            ->title('دیدگاه')
                ->addClass('column-title'),
            Column::make('created_at')
            ->title('ساخته شده در')
                ->addClass('column-title'),
            Column::make('commentable_id')
            ->title('دوره مرتبط')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،تایید دیدگاه')
                ->addClass('column-title')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CourseComment_' . date('YmdHis');
    }
}
