<div>

  <x-card>

    <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

      <x-form wire:submit.prevent="filter">


        <x-slot:actions>
          <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
          <x-button label="Clear" wire:click="clear" spinner />
        </x-slot:actions>

      </x-form>
    </x-drawer>

    <x-list-menu :title="$title" :url="$url" shadow />

    <div class="grid grid-cols-4 gap-4">
      <div>
        <img src="" alt="" srcset="">
      </div>
    </div>

  </x-card>

</div>
