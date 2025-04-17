<div>
    <x-button label="Create" link="product/create" />

        <input class="border-2" type="text" wire:model.live="search">
        <div>{{ $search }}</div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->products as $product)
                        <tr wire:key="{{ $product->id }}">
                            <td >{{ $product->name }}</td>
                            <td> 
                                <x-button label="Edit" link="product/edit/{{ $product->id }}" />
                                <x-button label="Show" wire:click="openModal({{ $product->id }})" />
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr><td colspan="2">{{ $this->products->links() }}</td></tr>  
                </tbody>
            </table>
    



    <hr>


    <x-modal wire:model="modalProduct" title="Product Show" class="backdrop-blur">

        <div class="mb-3">
            <x-input  label="Name" value="{{ $product->name }}" id="masterForm.name" name="masterForm.name" placeholder="Name" readonly/>
        </div>

        <div class="mb-3">
            <x-input  label="Detail" value="{{ $product->detail }}" id="masterForm.name" name="masterForm.name" placeholder="Detail" readonly/>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modalProduct = false" />
        </x-slot:actions>
    </x-modal>



</div>