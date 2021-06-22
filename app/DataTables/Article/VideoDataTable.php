<?php

namespace App\DataTables\Article;

use App\Models\Article;
use App\Models\Media;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;  

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
                return '<iframe src="'.$video->media_url.'"  width="50%" allowFullScreen="true" 
                                webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
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
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('url')
            ->title('ویدئو')
                ->orderColumn(false),
            Column::make('media_id')
            ->title('مقاله مرتبط')
                ->orderable(false),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | ویرایش')
        ];
    }
}
