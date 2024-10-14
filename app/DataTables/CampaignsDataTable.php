<?php

namespace App\DataTables;

use App\Models\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CampaignsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Campaign $campaign) {
                return '<div class="flex flex-wrap gap-2">
                        <a href="' . route("campaigns.edit", $campaign->id) . '" class="btn btn-primary btn-sm">Edit</a>
                        <form action="' . route("campaigns.destroy", $campaign->id) . '" method="POST">
                            ' . @csrf_field() . '
                            ' . @method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
            })
            ->editColumn('campaign_image', function (Campaign $campaign) {
                $campaign_image_url = $campaign->getMedia('campaign_featured_image')->first() ? $campaign->getMedia('campaign_featured_image')->first()->getUrl() : 'https://ui-avatars.com/api/?name=shaheencampaign&color=7F9CF5&background=EBF4FF';
                return '<img src="' . $campaign_image_url . '" class="rounded-full h-10 w-10" alt="' . $campaign->campaign_name . '">';
            })
            ->editColumn('masjid_id', function (Campaign $campaign) {
                $masjid = $campaign->masjid;
                return $masjid->masjid_name . ' -' . $masjid->address_1 . ' ' . $masjid->address_2 . ' ' . $masjid->district . ' ' . $masjid->state . ' ' . $masjid->postcode;
            })
            ->editColumn('status', function (Campaign $campaign) {
                return $campaign->status == 'Active' ? getBadge('Active', 'primary') : getBadge('InActive', 'danger');
            })
            ->editColumn('volunteers', function (Campaign $campaign) {
                if (count($campaign->volunteers)) {
                    $volunteers = '<div class="flex flex-wrap gap-2">';
                    for($i = 0; $i < count($campaign->volunteers); $i++) {
                        $volunteers .= '<span class="font-bold">'.User::find($campaign->volunteers[$i])->name.'</span>';
                    }
                    return $volunteers . '</div>';
                } else {
                    return 'No Volunteers';
                };
            })
            ->editColumn('start_date', function (Campaign $campaign) {
                return Carbon::parse($campaign->start_date)->format('d M Y');
            })
            ->editColumn('end_date', function (Campaign $campaign) {
                return Carbon::parse($campaign->end_date)->format('d M Y');
            })
            // ->editColumn('created_at', function (Campaign $campaign) {
            //     return $campaign->created_at->diffForHumans();
            // })
            // ->editColumn('updated_at', function (Campaign $campaign) {
            //     return $campaign->updated_at->diffForHumans();
            // })
            ->rawColumns(['action', 'campaign_image', 'volunteers', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Campaign $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('campaigns-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->autoWidth(true)
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive(true)
                    ->buttons([
                        Button::make('add')->text('Add New Campaign')->action('function(){
                            window.location = "'.route('campaigns.create').'"
                        }')->className('btn btn-primary'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('campaign_name')->title('Name'),
            Column::make('campaign_image')->title('Featured Image'),
            Column::make('campaign_description')->title('Description'),
            Column::make('masjid_id')->title('Masjid'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('location'),
            Column::make('volunteers'),
            Column::make('status'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
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
        return 'Campaigns_' . date('YmdHis');
    }
}