<?php

namespace App\DataTables\Article;

use App\Models\Article;
use App\Models\Media;
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
                return '<iframe src="'.$video->media_url.'"  width="50%"></iframe>';
            })
            ->addColumn('media_id', function (Media $video) {
                return $video->media->title;
            })
            ->filterColumn('media_id', function ($query, $keyword) {
                return $this->dataTable->setMediaCol($query, $keyword, 'articles');
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
        return $model->where('media_type', Article::class)
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
                $this->getColumns(), 'articleVideo');
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
            ->title('ویدئو')
                ->orderColumn(false),
            Column::make('media_id')
            ->title('مقاله مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| ویرایش')
        ];
    }
}
