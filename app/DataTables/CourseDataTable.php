<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\Article;
use App\Models\Status;
use App\DataTables\GeneralDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;


class CourseDataTable extends DataTable
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
            ->rawColumns(['action','image_url','status'])
            ->addColumn('image_url', function(Course $course) {
                foreach($course->media as $media) { 
                    return "<img src=/images/" . optional($media)->url . " class='dataTableImage' />";
                }
            })
            ->editColumn('price', function(Course $course) {
                if($course->price != null) return $course->price . ' تومان';
                else return 'رایگان';
            })
            ->editColumn('category_id', function(Course $course) {
                return optional($course->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                return $this->dataTable->filterCategoryCol($query, $keyword);
            })
            ->editColumn('subcategory_id', function(Course $course) {
                return optional($course->subcategory)->name;
            })
            ->filterColumn('subcategory_id', function($query, $keyword) {
                return $this->dataTable->filterSubcategoryCol($query, $keyword);
            })
            ->addColumn('status', function(Course $course) { 
                return $this->dataTable->setStatusCol($course->statuses->status);
            })  
            ->filterColumn('status', function ($query, $keyword) {
                return $this->dataTable->filterStatusCol($query, $keyword);
            })
            ->addColumn('action',function(Course $course) {
                $id = $course->id;

                $edit = URL::signedRoute('course.new', ['id' => $id]);
                $details = URL::signedRoute('course.details', ['id' => $id, 'role' => 'admin']);

                // DataTable
                return $this->setAction($id, $edit, $details);
            });
    }

    // Action column
    public function setAction($id, $edit, $details) {

        return $this->dataTable->setDelAction($id) . $this->dataTable->setEditAction($edit) . 
                    $this->dataTable->setDetAction($details);
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
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'course');
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
            Column::make('name')
            ->title('نام'),
            Column::make('image_url')
            ->title('تصویر')
                ->orderable(false),
            Column::make('price')
            ->title('هزینه'),
            Column::make('status')
            ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول'),
            Column::make('subcategory_id')
            ->title('دسته بندی دوم'),
            $this->dataTable->setActionCol('| ویرایش | جزئیات')
        ];
    }
}
