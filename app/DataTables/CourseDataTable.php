<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\Article;
use App\Models\Status;
use App\Models\Image;
use App\Models\Video;
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
            ->rawColumns(['action','course_id','image_url','status'])
            ->addColumn('image_url', function(Course $course) {
                foreach($course->media as $media) { 
                    return "<img src=/images/" . optional($media)->url . " height='100px' width='150px' />";
                }
            })
            ->editColumn('price', function(Course $course) {
                if($course->price != null) return $course->price . ' تومان';
            })
            ->editColumn('category_id', function(Course $course) {
                return optional($course->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                $sql = 'category_id in (select id from categories where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('subCategory_id', function(Course $course) {
                return optional($course->subCategory)->name;
            })
            ->filterColumn('subCategory_id', function($query, $keyword) {
                $sql = 'subCategory_id in (select id from subCategories where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('status', function(Course $course) { 
                if($course->statuses->status === Status::VISIBLE) return 'موجود';
                else if($course->statuses->status === Status::INVISIBLE) return 'ناموجود';
            })  
            ->filterColumn('status', function ($query, $keyword) {
                switch($keyword) {
                    case 'موجود': $keyword = 0; break;
                    case 'ناموجود': $keyword = 1;
                }
                $statuses = Course::whereHas('statuses',  function ($subquery) use ($keyword) {
                    $subquery->where('status', $keyword);
                })->get()->pluck('id')->toArray();

                $query->whereIn('id', $statuses);
            })
            ->addColumn('action',function(Course $course) {
                $editCourse = URL::signedRoute('course.new', ['id' => $course->id]);
                $courseDetails = URL::signedRoute('course.adminDetails', ['id' => $course->id]);

                return '<a onclick="showConfirmationModal('.$course->id.')">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        <a href="'.$editCourse.'">
                            <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        <a href="'.$courseDetails.'">
                            <i class="fa fa-info-circle text-danger" aria-hidden="true"></i>
                        </a>';
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
            Column::make('name')
            ->title('نام')
                ->addCLass("column-title"),
            Column::computed('image_url')
            ->title('تصویر')
                ->addClass('column-title'),
            Column::make('price')
            ->title('هزینه')
                ->addClass('column-title'),
            Column::make('status')
            ->title('وضعیت')
                ->addClass('column-title'),
            Column::make('category_id')
            ->title('دسته بندی اول')
                ->class('column-title'),
            Column::make('subCategory_id')
            ->title('دسته بندی دوم')
                ->class('column-title'),
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
        return 'Course_' . date('YmdHis');
    }
}
