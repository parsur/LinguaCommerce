<?php

namespace App\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Morilog\Jalali\Jalalian;
use App\Models\Status;

class GeneralDataTable 
{
    /**
     * Column = Col
     * Delete = Del
     * Detials = Det
     */

    /**
     * html builder and table settings | dataTable builder / table columns / table name
     * 
     * @return \Yajra\DataTables\Html\Builder
     */
    public function tableSetting($builder, $columns, $table)
    {
        return $builder
            ->setTableId("{$table}Table")
            ->minifiedAjax(route("{$table}.list.table"))
            ->columns($columns)
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->lengthMenu([10,25,40])
            ->info(false)
            ->ordering(true)
            ->responsive(true)
            ->pageLength(8)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('print')->className('btn btn-theme'),     
                Button::make('copy')->className('btn btn-theme')
            )
            ->language(asset('js/persian.json'));
    }

    /**
     * Get index column(0 | 1 | 2 .....).
     */
    public function getIndexCol()
    {
        return Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false);
    }   

    /**
     * Get action column.
     */
    public function setActionCol($title)
    {
        return Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title("حذف $title");
    }   

    // Computed column in datatables for delete,update and details
    public function setAction($id) {

        return $this->setDelAction($id) . "&nbsp;
                <a onclick='showEditModal({$id})'>
                    <i class='fa fa-edit text-danger'></i>
                </a>";
    }

    // Computed column in datatables for delete and details
    public function setDelDetAction($id, $details) {

        return $this->setDelAction($id) . $this->setDetAction($details);
    }
    
    // Computed column in datatables for delete
    public function setDelAction($id) {

        return "<a onclick='showConfirmationModal({$id})'>
                    <i class='fa fa-trash text-danger'></i>
                </a>";
    }

    // Computed column in datatables for edit
    public function setEditAction($id) {

        return "&nbsp; <a href='{$id}'>
                    <i class='fa fa-edit text-danger'></i>
                </a>";
    }

    // Computed column in datatables for edit
    public function setDetAction($details) {

        return  "&nbsp; <a href='{$details}'>
                    <i class='fa fa-info-circle text-danger'></i>
                </a>";
    }

    // Set status column
    public function setStatusCol($status) {
        return ($status == Status::ACTIVE) ? 'موجود' : 'ناموجود';
    }

    // Filter status column 
    public function filterStatusCol($query, $rkeyword) {

        switch($keyword) {
            case 'موجود': $keyword = 0; 
            break;
            case 'ناموجود': $keyword = 1;
        }

        return $this->filterColumn($query, 'id in (select status_id from 
                        status where status like ?)', $keyword);
    }

    // Filter user column
    public function filterUserCol($query, $keyword) {

        return $this->filterColumn($query, 'user_id in 
                        (select id from users where name like ?)', $keyword);
    }

    // Filter status column 
    public function filterSubcategoryCol($query, $keyword) {

        return $this->filterColumn($query, 'subcategory_id 
                in (select id from subcategories where name like ?)', $keyword);
    }

    // Filter category column
    public function filterCategoryCol($query, $keyword) {

        return $this->filterColumn($query, 'category_id in 
                (select id from categories where name like ?)', $keyword);
    }   

    // Filter media column
    public function filterMediaCol($query, $keyword, $table) {

        $sql = "media_id in (select id from {$table} where title like ?)";
        return $this->filterColumn($query, $sql, $keyword);
    }

    // Filter comment column
    public function filterCommentCol($query, $keyword) {
        
        return $this->filterColumn($query, 
                        'id in (select commaentble_id from comments where comment like ? )', $keyword);
    }

    // Filter column
    public function filterColumn($query, $sql, $keyword) {
        return $query->whereRaw($sql, ["%{$keyword}%"]);
    }

    //  Jalali timestamps
    public function showJalaliTime($timestamps) {
        return Jalalian::forge($timestamps);
    }
}
