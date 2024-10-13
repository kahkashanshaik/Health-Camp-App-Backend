<?php

namespace App\DataTables;

use App\Models\Masjid;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MasjidsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Masjid $masjid) {
                return '<div class="flex flex-wrap gap-2">
                        <a href="'. route("masjids.edit", $masjid->id).'" class="btn btn-primary btn-sm">Edit</a>
                        <form action="'.route("masjids.destroy", $masjid->id ).'" method="POST">
                            '.@csrf_field().'
                            '.@method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
            })
            ->editColumn('status', function (Masjid $masjid) {
                return $masjid->status == 'Active' ? getBadge('Active', 'primary') : getBadge('InActive', 'danger');
            })
            ->editColumn('masjid_address', function (Masjid $masjid) {
                return $masjid->address_1 . ', ' . $masjid->address_2 . ', ' . $masjid->district . ', ' . $masjid->state . ', ' . $masjid->postcode;
            })
            ->editColumn('created_at', function (Masjid $masjid) {
                return $masjid->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function (Masjid $masjid) {
                return $masjid->updated_at->diffForHumans();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Request $request,Masjid $model): QueryBuilder
    {
        return $model->newQuery()->where(function($query) use ($request){
            if(isset($request->status)){
                return $query->where('status', $request->status);
            }
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('masjids-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add')->text('Add New Masjid')->action('function(){
                            window.location = "'.route('masjids.create').'"
                        }')->className('btn btn-primary'),
                        Button::make('csv'),
                        // Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }
    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowId')->title('No')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('masjid_name'),
            Column::make('masjid_address')->orderable(false)->searchable(false),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Masjids_' . date('YmdHis');
    }
}