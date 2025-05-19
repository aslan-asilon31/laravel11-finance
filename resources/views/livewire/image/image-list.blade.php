<div>

  <x-button label="Export Fast Excel" wire:click="exportFastExcel" />

  <x-card :title="$title" shadow separator class="border shadow">

    <div class="my-2">
      <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
    </div>

    <div class="">

      <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" show-empty-text
        :rows="$this->rows" :sort-by="$sortBy" with-pagination>

        @scope('cell_no_urut', $row)
          {{ $row->no_urut }}
        @endscope

        @scope('cell_url', $row)
            <img src="{{ $row->url }}" class="w-16 h-16" alt="" srcset="">
        @endscope

        @scope('cell_action', $row)
          <x-dropdown class="btn-xs">
            <x-menu-item class="" title="Edit" icon="o-pencil-square" link="/products/edit/{{ $row->id }}" />
            <x-menu-item class="" title="Show" icon="o-eye"
              link="/products/show/{{ $row->id }}/readonly" />
          </x-dropdown>
        @endscope

        @scope('cell_is_activated', $row)
          <x-badge :value="$row->is_activated == 1 ? 'Yes' : 'No'"
            class=" {{ $row->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
        @endscope

      </x-table>

    </div>
  </x-card>



  @script
    <script>
      document.addEventListener('livewire:load', function() {
        const datepicker = document.getElementById('datepicker');

        datepicker.addEventListener('change', function() {
          @this.set('myDate1', this.value);
        });

      });
    </script>

    <script>
      $js('dataIncrement', (data) => {
        console.log('Your post has been saved successfully! data count', data)
      })


      Livewire.hook('component.initialized', ({
        component,
        cleanup
      }) => {
        let countValue = $wire.$get('count');
        document.getElementById('count-value').innerText = countValue;
        console.log('cek initialized', countValue);

      })


      Livewire.hook('element.init', ({
        component,
        el
      }) => {
        let countValue1 = $wire.$get('count');
        console.log('cek hook', countValue1);
      })




      Livewire.hook('component.init', ({
        component,
        cleanup
      }) => {


        let countValue = $wire.$get('count');
        document.getElementById('count-value').innerText = countValue;

        document.getElementById('increment-btn').addEventListener('click', () => {
          $wire.increment();

          $wire.$refresh();

          $wire.$on('sudah-count', () => {
            console.log('dispatch sudah count')
          });

          $wire.$watch('count', (value, old) => {
            console.log('data baru :', value, 'data lama :', old)
          });
        });

        document.getElementById('decrement-btn').addEventListener('click', () => {
          console.log('decrement1', countValue);

          $wire.$js('decrement', () => {
            console.log('decrement2', countValue);

          });

        });
      })




      console.log('cek id', $wire.$id);
    </script>

    <script></script>
  @endscript
</div>
