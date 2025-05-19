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
                        label="url" 
                        wire:model="masterForm.url" 
                        id="masterForm.url" 
                        url="masterForm.url" 
                        placeholder="url" 
                    />
                </div>
    
                <div class="mb-3">
                    <x-input 
                        label="imageable_id" 
                        wire:model="masterForm.imageable_id" 
                        id="masterForm.imageable_id" 
                        name="masterForm.imageable_id" 
                        placeholder="imageable_id" 
                    />
                </div>
    
                <div class="mb-3">
                    <x-input 
                        label="imageable_type" 
                        wire:model="masterForm.imageable_type" 
                        id="masterForm.imageable_type" 
                        name="masterForm.imageable_type" 
                        placeholder="imageable_type" 
                    />
                </div>
    
                  <div class="text-center mt-3">
                    <x-errors class="text-white mb-3" />
                    <x-button type="submit" :label="$id ? 'update' : 'store'" class="btn-success btn-sm text-white" />
                  </div>

                  <x-datepicker label="Date" wire:model="myDate1" icon="o-calendar" hint="Hi!" />

              </div>
          </x-form>
    
        <x-button label="Cancel" class="text-xs md:text-sm" wire.click="closeModal" />

    </x-card>
    

    @script



        <script>

            const datepicker = document.getElementById('datepicker');


            let $wire = {
                $watch(name, callback) { ... },
            }
            
            $wire.on('product-created', () => {
                console.log('product-created');
            });
        </script>
    @endscript

</div>