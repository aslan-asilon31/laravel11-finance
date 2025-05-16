<div>

  <x-list-menu :title="$title" :url="$url" shadow />

  <x-button class="" wire:click="export">Export</x-button>
  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="Name" placeholder="Filter By Name" wire:model="filterForm.name" icon="o-magnifying-glass"
        clearable />
      <x-input label="Description" placeholder="Filter By Description" wire:model="filterForm.last_name"
        icon="o-magnifying-glass" clearable />desc

      <x-select label="Is Activated" wire:model="filterForm.is_activated" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]"
        placeholder="- Is Activated -" placeholder-value="" />

      <x-datepicker label="Created At" wire:model="filterForm.created_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />
      <x-datepicker label="Updated At" wire:model="filterForm.updated_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">

    <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
      :sort-by="$sortBy" with-pagination show-empty-text>

      @scope('cell_action', $row)
        <x-dropdown>
          <x-menu-item title="Edit" icon="o-pencil-square" link="/company/edit/{{ $row->id }}" />
          <x-menu-item title="Show" icon="o-eye" link="/company/show/{{ $row->id }}" />
        </x-dropdown>
      @endscope

      @scope('cell_is_activated', $row)
        <x-badge :value="$row->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $row->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

    </x-table>

  </div>




</div>
