<?php

namespace App\DataTables;

use App\Models\File;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Storage;

class CourseFileDataTable extends DataTable
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
            ->editColumn('course_id', function(File $file) {
                return $file->course->name;
            })
            ->filterColumn('course_id', function($query, $keyword) {
                $sql = 'course_id in (select id from courses where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('url', function(File $file) {
                $suffix = pathinfo(storage_path("$file->url"), PATHINFO_EXTENSION);
                // All video formats
                $videoFormats = array("flv", "mp4", "m3ub", "ts","3gp", "mov", "avi", "wmv", "mkv");
                // Url
                $url = Storage::url('courseFiles/'.$file->url);
                // Check if it exists in array
                if (in_array($suffix, $videoFormats)) { 
                    return "<video height='200px' src='".$url."' controls></video>";
                } else {
                    return "<audio height='200px' src='".$url."' controls></audio>";
                } 
            })
            ->addColumn('action', function (File $file){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$file->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$file->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
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
        return $this->builder()
            ->setTableId('courseFileTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('courseFile.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->info(false)
            ->responsive(true)
            ->dom('PBCfrtip')
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
            Column::make('DT_RowIndex')
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::computed('url')
            ->title('محتوا')
                ->addClass('column-title'),
            Column::make('course_id')
            ->title('دوره')
                ->addClass('column-title'),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش،جزئیات(توضیحات،رسانه)')
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
        return 'CourseFile_' . date('YmdHis');
    }
}
