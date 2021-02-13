<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\Status;
use App\Models\Media;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;


class CourseDataTable extends DataTable
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
            ->rawColumns(['action','course_id','media'])
            ->addColumn('media', function (Course $course) {
                foreach($course->media as $media) {
                    if($media->type === MEDIA::IMAGE) 
                        return "<img src=/images/" . $media->media_url . " height='auto' width='50%' />";
                    else if($media->type === MEDIA::VIDEO) {
                        return '<iframe src="' . $media->media_url . '"  width="50%" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
                    }
                }
            })
            ->editColumn('price', function(Course $course) {
                if($course->price != null) return $course->price . ' تومان';
                else return '-';
            })
            ->editColumn('category_id', function(Course $course) {
                return optional($course->category)->name;
            })
            ->editColumn('subCategory_id', function(Course $course) {
                return optional($course->subCategory)->name;
            })
            ->addColumn('status', function(Course $course) {

                if($course->statuses->status === Status::VISIBLE) return 'فعال';
                else if($course->statuses->status === Status::INVISIBLE) return 'غیر فعال';
                else return '-';
            })
            ->editColumn('course_id', function(Course $course) {
                $address = URL::signedRoute('course.eachDesc', ['id' => $course->id]);
                // return <<<ATAG
                //             <a href="{$address}">باز کردن توضیحات</a>
                //         ATAG;
                return optional($course->description_type)->description;
            })
            ->addColumn('action',function(Course $course) {
                $button = <<<ATAG
                                <a onclick="showConfirmationModal('{$course->id}')">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                </a>
                            ATAG;
                $button .= "&nbsp;";
                $button .= '<a href="'.route('course.newCourse', ['id' => $course->id]).'">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>';
                return $button;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Course $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
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
            ->setTableId('courseTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('course.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(false)
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
            Column::make('name')
            ->title('نام')
                ->addCLass("column-title"),
            Column::computed('media')
            ->title('ویدئو | عکس')
                ->addCLass("column-title"),
            Column::make('price')
            ->title('هزینه')
                ->addClass('column-title'),
            Column::computed('status')
            ->title('وضعیت')
                ->addClass('column-title'),
            Column::make('category_id')
            ->title('دسته بندی اول')
                ->class('column-title'),
            Column::make('subCategory_id')
            ->title('دسته بندی دوم')
                ->class('column-title'),
            Column::make('course_id')
            ->title('توضیحات')
                ->addClass('column-title'),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش')
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
        return 'Course_' . date('YmdHis');
    }
}
