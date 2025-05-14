<div>


    <x-card :title="$title" shadow separator class="border shadow">
        
        <div class="w-full p-4">
            <div class="flex border-2 justify-center">
                <div class="justify-center">
                    <div x-data="{ count: $wire.$entangle('count') }">
                    <br>
                    <div class="flex"> alpine : <h1 x-text="$wire.count"></h1></div>
                    <br>
                    <div class="flex">
                        <div id="count-value" ></div> | <div wire:text="count"></div>
                    </div>
                    <br>
                    <x-button id="increment-btn">increment +</x-button>
                    <x-button id="decrement-btn">decrement -</x-button>
                    <button wire:click="$js.increment">part 2 decrement -</button>
                </div>
            </div>
            <hr>
            <br>
    
            <div >
    
                <div class="flex ">
                    jumlah karakter
                    (<h2 x-text="$wire.get('todo').length"></h2>) :
                    <input type="text" wire:model="todo" class="border-2">
                    <hr>
    
                </div>
                <br>
                <input type="file" id="fileInput">
    
            </div>
    
        </div>

@dd($myDate2)
        @php
            $config1 = ['altFormat' => 'd/m/Y'];
        @endphp

        <x-datepicker label="Alt" wire:model="myDate2" icon="o-calendar" :config="$config1" />

    </x-card>



    @script


        <script>
            document.addEventListener('livewire:load', function () {
                const datepicker = document.getElementById('datepicker');
        
                datepicker.addEventListener('change', function () {
                    @this.set('myDate1', this.value);
                });
        
            });
        </script>
        
        <script>


            $js('dataIncrement', (data) => {
                    console.log('Your post has been saved successfully! data count',data)
            })


            Livewire.hook('component.initialized', ({ component, cleanup }) => {
                let countValue = $wire.$get('count');
                 document.getElementById('count-value').innerText = countValue;
                 console.log('cek initialized', countValue);

            })


            Livewire.hook('element.init', ({ component, el }) => {
                let countValue1 = $wire.$get('count');
                console.log('cek hook', countValue1);
            })




            Livewire.hook('component.init', ({ component, cleanup }) => {
   

                let countValue = $wire.$get('count');
                document.getElementById('count-value').innerText = countValue;

                document.getElementById('increment-btn').addEventListener('click', () => {
                        $wire.increment(); 
                  
                        $wire.$refresh();

                        $wire.$on('sudah-count', () => { console.log('dispatch sudah count') });

                        $wire.$watch('count', (value, old) => { console.log('data baru :',value,'data lama :',old) });
                });
    
                document.getElementById('decrement-btn').addEventListener('click', () => {
                    console.log('decrement1',countValue);
    
                        $wire.$js('decrement', () => { 
                                console.log('decrement2',countValue);
    
                         });
              
                });
            })




            console.log('cek id', $wire.$id);


 

        </script>

        <script>



        </script>

    @endscript
</div>