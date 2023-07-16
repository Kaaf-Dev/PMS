<?php

namespace App\Http\Livewire\Admin\TicketCategory;

use App\Models\TicketCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;

    public function getListeners()
    {
        return [
            'ticket-category-added' => '$refresh',
            'ticket-category-updated' => '$refresh',
            'ticket-category-deleted' => '$refresh',
        ];
    }

    public function render()
    {

        $ticket_categories = ($this->ready_to_load)
            ? TicketCategory::where('title', 'like', '%'. $this->search .'%')
                ->paginate()
            : [];
        $view_data = [
            'ticket_categories' => $ticket_categories,
        ];

        return view('livewire.admin.ticket-category.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function addTicketCategory()
    {
        $this->emit('show-ticket-category-create-modal');
    }

    public function updateTicketCategory($ticket_category)
    {
        $this->emit('show-ticket-category-update-modal', [
            'ticket_category' => $ticket_category,
        ]);
    }

    public function deleteTicketCategory($ticket_category)
    {
        $this->emit('show-ticket-category-delete-modal', [
            'ticket_category' => $ticket_category,
        ]);
    }

}
