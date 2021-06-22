<?php

namespace App\DataTables;

use App\Models\Consultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;
use \Illuminate\Support\Str;
use URL;

class ConsultationDataTable extends DataTable
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
            ->rawColumns(['action'])
            ->addColumn('user_name', function(Consultation $consultation) {
                return optional($consultation->user)->name;
            })
            ->filterColumn('user_name', function($query, $keyword) {
                return $this->dataTable->filterUserCol($query, $keyword);
            })
            ->addColumn('description', function(Consultation $consultation) {
                return Str::limit(optional($consultation->description)->description, 30, '(جزئیات)');
            })
            ->filterColumn('description', function($query, $keyword) {
                return $this->dataTable->filterColumn($query, 
                    'id in (select description_id from descriptions where description like ?)', $keyword);
            })
            ->addColumn('action',function(Consultation $consultation) {
                $id = $consultation->id;
                $details = '';

                if($consultation->descriptions)
                    $details = URL::signedRoute('consultation.details', ['id' => $id]);

                return $this->dataTable->deleteDetailsAction($id, $details);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Consultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
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
                $this->getColumns(), 'consultation');
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
            Column::make('user_name')
            ->title('نام کاربر')
                ->orderable(false),
            Column::make('phone_number')
            ->title('شماره تلفن'),
            Column::make('description')
            ->title('توضیحات')
                ->orderable(false),
            $this->dataTable->setActionCol('| جزئیات')
        ];
    }

}
