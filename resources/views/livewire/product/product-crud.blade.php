<div>
    <x-card :title="$title" shadow separator class="border shadow">

        <x-form wire:submit="{{ $id ? 'update' : 'store' }}" >
            <div class="text-center mt-3">
                Product
            </div>
            <x-menu-separator />

            <div id="pertanyaan">

                <div class="mb-3">
                    <x-input 
                        label="Name" 
                        wire:model="masterForm.name" 
                        id="masterForm.name" 
                        name="masterForm.name" 
                        placeholder="Name" 
                    />
                </div>

                <div class="mb-3">
                    <x-input 
                        label="Detail" 
                        wire:model="masterForm.detail" 
                        id="masterForm.detail" 
                        name="masterForm.detail" 
                        placeholder="Detail" 
                    />
                </div>

                <div class="text-center mt-3">
                    <x-errors class="text-white mb-3" />
                    <x-button type="submit" :label="$id ? 'update' : 'store'" class="btn-success btn-sm text-white" />
                </div>

                @if($id)
                    <div wire:dirty>Unsaved changes...</div> 
                @endif

            </div>
        </x-form>

        <x-button label="Cancel" class="text-xs md:text-sm" wire.click="closeModal" />

    </x-card>

    @script
        <script>

            let $wire = {
                $watch(name, callback) { ... },
            }

            $wire.$set(name, value, live = true) { 
                
            },

            
            $wire.on('product-created', () => {
                console.log('product-created');
            });
        </script>
    @endscript

</div>