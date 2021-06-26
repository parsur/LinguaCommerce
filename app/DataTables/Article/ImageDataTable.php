<?php

namespace App\DataTables\Article;

use App\Models\Media;
use App\Models\Article;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;

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
            ->editColumn('url', function(Media $image) {
                return "<img src=/images/" . $image->url . " class='dataTableImage' />";
            })
            ->editColumn('media_id', function (Media $image) {
                return $image->media->title;
            })
            ->filterColumn('media_id', function ($query, $keyword) {
                return $this->dataTable->setMediaCol($query, $keyword, 'articles');
            })
            ->addColumn('action', function(Media $image){
                return $this->dataTable->setAction($image->id);   
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
        return $model->where('media_type', Article::class)
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
                $this->getColumns(), 'articleImage');
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
            ->title('مقاله مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| ویرایش')
        ];
    }

}
