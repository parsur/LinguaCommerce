<?php

namespace App\DataTables\Course;

use App\Models\Media;
use App\Models\Course;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoDataTable extends DataTable
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
            ->rawColumns(['action','url']) 
            ->editColumn('url', function(Media $video) {
                return '<iframe src="'.$video->url.'" width="50%"></iframe>';
            })
            ->addColumn('media_id', function (Media $video) {
                return $video->media->name;
            })
            ->filterColumn('media_id', function ($query, $keyword) {
                return $this->dataTable->setMediaCol($query, $keyword, 'courses');
            })
            ->addColumn('action', function(Media $video){
                return $this->dataTable->setAction($video->id);
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
        return $model->where('media_type', Course::class)
                    ->where('type', $model::VIDEO);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'courseVideo');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex') // connect to line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('url')
            ->title('ویدئو'),
            Column::make('media_id')
            ->title('دوره مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| ویرایش | تایید دیدگاه')
        ];
    }
}
