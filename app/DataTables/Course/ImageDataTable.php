<?php

namespace App\DataTables\Course;

use App\Models\Media;
use App\Models\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\Datatables\Facades\Datatables;
use File;

class ImageDataTable extends DataTable
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
            ->rawColumns(['action','url']) 
            ->editColumn('url', function(Media $media) {
                return "<img src=/images/" . $media->url . " height='auto' width='80%' />";
            })
            ->addColumn('media_id', function (Media $media) {
                return $media->media->name;
            })
            ->filterColumn('media_id', function ($query, $keyword) {
                $sql = 'media_id in (select id from courses where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function(Media $media){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$media->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$media->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Media $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Media $model)
    {
        return $model::where('media_type', Course::class)->where('type', $model::IMAGE);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('courseImageTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('courseImage.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->lengthChange(true)
            ->info(false)
            ->responsive(true)
            ->dom('PBCfrtip')
            ->buttons(
                Button::make('print'),
                Button::make('copy')
            )
            ->orderBy(1)
            ->language(asset('js/persian.json'));
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
            Column::make('url')
            ->title('رسانه')
                ->addClass('column-title'),
            Column::make('media_id')
            ->title('دوره مرتبط')
                ->addClass('column-title')
                ->orderable(false),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | ویرایش')
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
        return 'CourseImage_' . date('YmdHis');
    }
}
