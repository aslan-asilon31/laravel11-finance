<div>
  <x-button label="Accounting" link="/accounting/dashboard" class="bg-[#800080] btn-sm text-white" />
  <x-button label="Warehouse" link="/warehouse/dashboard" class="bg-[#800080] btn-sm text-white" />
  <x-button label="Finance" link="/finance/dashboard" class="bg-[#800080] btn-sm text-white" />
  <x-button label="Marketing" link="/marketing/dashboard" class="bg-[#800080] btn-sm text-white" />
  <x-button label="Human Resource" link="/human-resource/dashboard" class="bg-[#800080] btn-sm text-white" />
</div>

<x-header title="{{ $title }}" subtitle="" class="text-xs" separator>
  <x-slot:actions>
    @if (empty($id))
      @if ('/' . request()->path() == $url . '/create')
      @else
        @if (request()->path() != $url)
          <x-button icon-right="o-plus-circle" label="Create" link="{{ $url . '/create' }}"
            class=" btn-ghost btn-outline" />
        @endif
      @endif
    @else
      <x-button icon-right="o-list-bullet" label="{{ $title }} list" link="{{ $url }}"
        class=" btn-ghost btn-outline" />
      <x-button icon-right="o-trash" wire:click="delete" wire:confirm="Yakin hapus data?" label="Delete"
        class=" btn-error btn-outline" />
    @endif

    <x-button label="Filters" @click="$wire.filterDrawer = true" responsive icon="o-funnel" class="btn-primary" />

  </x-slot:actions>
</x-header>
