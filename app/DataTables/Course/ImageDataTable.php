<?php

namespace App\DataTables\Course;

use App\Models\Media;
use App\Models\Course;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use File;

class ImageDataTable extends DataTable
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
            ->editColumn('url', function(Media $media) {
                return "<img src=/images/" . $media->url . " class='dataTableImage' />";
            })
            ->addColumn('media_id', function (Media $media) {
                return $media->media->name;
            })
            ->filterColumn('media_id', function ($query, $keyword) {
                return $this->dataTable->setMediaCol($query, $keyword, 'courses');
            })
            ->addColumn('action', function(Media $media){
                return $this->dataTable->setAction($media->id);
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
        return $model::where('media_type', Course::class)
                    ->where('type', $model::IMAGE);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'courseImage');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            $this->dataTable->getIndexCol(),
            Column::make('url')
            ->title('رسانه'),
            Column::make('media_id')
            ->title('دوره مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| ویرایش')
            
        ];
    }
}
