<div>

    <input type="text" id="changeId"/> {{ $id }}

    <div class="text-center container-fluid ">

        <header class="border-2 py-2">
            <div class="flex space-x-4">
                <div class=" ">
                    logo
                </div>
                <div class="flex justify-center">
                    <div class="px-2">
                        <a class=" " href="">Home</a>
                    </div>
                    <div class="px-2">
                        <a class="" href="">About</a>
                    </div>
                    <div class="px-2">
                        <a class="" href="">Contact</a>
                    </div>
                </div>
                <div class=" ">
                    <a href="">profile dropdown</a>
                </div>

            </div>
        </header>


        <main class=" mx-auto  mt-4">

                <div class="flex justify-center items-center flex-col m-4">
                    
                    <h1 class="py-8">Form ( {{ $this->getBookmarkedProducts ? 'Bookmarked': 'Not Bookmark'}} )</h1>
                    <div class="p-8 w-96 border-2 ">
                        <x-form wire:submit="{{ $id ? 'update' : 'store' }}" no-separator>
                            <x-input label="Name" wire:model="form.name" />
                            <div>@error('name') {{ $message }} @enderror</div>

                            <x-input label="Detail" wire:model="form.detail" />
                            <div>@error('detail') {{ $message }} @enderror</div>

                            <x-slot:actions>
                                <span wire:loading>Saving...</span> 
                                <x-button :label="$id ? 'Update' : 'Store'" class="btn-primary" type="submit" spinner="Update" />
                            </x-slot:actions>
                        </x-form>

                    </div>

                </div>


        </main>

    </div>

    @script 
        <script>
            document.addEventListener('livewire:initialized', () => {
                var cekIdLocked = $wire.id;
                var cekNumber = $wire.number;
                console.log('id Locked : ', cekIdLocked ,'dan Number', cekNumber);
                $wire.gantiValueNumber();


                $wire.on('product-updated', () => {
                    console.log('product sudah di update');
                });

                document.getElementById('changeId').addEventListener('keyup', function(event) {
                    $wire.$set('id', '1234');  
                });
                
            })
        </script>
    @endscript 

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('value-number-diubah', (event) => {
                console.log('value number sudah di ubah menjadi',event.number);
            });
        });
    </script> 


</div>
