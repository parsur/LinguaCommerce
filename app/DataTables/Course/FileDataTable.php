<?php

namespace App\DataTables\Course;

use App\Models\File;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable; 
use Storage;

class FileDataTable extends DataTable
{
    public $dataTable;

    public function ___construct() {
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
                $sql = 'course_id in (select id from courses where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
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
        return $dataTable->tableSetting($this->builder(), 
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
            Column::make('DT_RowIndex')
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('title')
            ->title('عنوان'),
            Column::make('url')
            ->title('محتوا'),
            Column::make('course_id')
            ->title('دوره')
                ->orderable(false),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | ویرایش | جزئیات(توضیحات،رسانه)')
        ];
    }
}
