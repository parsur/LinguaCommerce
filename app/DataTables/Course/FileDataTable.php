<?php

namespace App\DataTables\Course;

use App\Models\File;
use App\Datatables\GeneralDataTable; 
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Storage;

class FileDataTable extends DataTable
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
            ->addColumn('course_id', function(File $file) {
                return $file->course->name;
            })
            ->filterColumn('course_id', function($query, $keyword) {
                return $this->dataTable->filterColumn($query, 
                        'course_id in (select id from courses where name like ?)', $keyword);
            })
            ->editColumn('url', function(File $file) {
                return "<a href='$file->url' target='_blank'>باز کردن آدرس</a>";
            })
            ->addColumn('action', function (File $file){
                return $this->dataTable->setAction($file->id);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\File $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(File $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'courseFile');
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
            Column::make('title')
            ->title('عنوان'),
            Column::make('url')
            ->title('محتوا'),
            Column::make('course_id')
            ->title('دوره')
                ->orderable(false),
            $this->dataTable->setActionCol('| ویرایش | جزئیات')
        ];
    }
}
