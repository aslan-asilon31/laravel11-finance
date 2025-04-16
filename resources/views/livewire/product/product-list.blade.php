<div>

    

    <div class="text-center container-fluid ">

        <header class="border-2 py-2">
            <div class="grid grid-cols-3 gap-4">
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


        <main class="mx-auto  mt-4">


            <div>
                <h1 >{{ $count ?? 0 }}</h1> <br>
                <button class="px-2 bg-red-900 text-sm text-white font-bold" wire:click="addOne">+1</button>
                <button class="px-2 bg-red-900 text-sm text-white font-bold" wire:click="minusOne">-1</button>
                <button class="px-2 bg-red-900 text-sm text-white font-bold" wire:click="resetCounter">Reset</button>
            </div>

            <hr class="my-16">

            <div class="m-4 ">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4" >
                    @foreach ($products as $product)
                        <div class="w-full h-64 border-4">
                            <div class="bg-green-800 w-full h-auto"></div>
                            <p>{{ $product['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr class="my-16">

            <div class="flex flex-col   border-2 m-4">
                <div class=" ">
                    <div class="flex gap-2 justify-center">
                        <h1>Products</h1>
                        <x-button class="btn-sm p-2" link="/product/create">Create</x-button>


                    </div>

    <div>
        mount : {{ $mount }} <br/>
        boot : {{ $boot }}
    </div>

                    <div class="  m-4">
                        <x-icon name="o-magnifying-glass" />
                        <input class="border" type="text" wire:model.live="search" />
                    </div>
                </div>
                   

                <div class="flex justify-center">
                    

                    <table class="border-separate border-spacing-1 border .">
                        <thead>
                            <tr>
                                <th class=" p-2 ">id</th>
                                <th class=" p-2 ">name</th>
                                <th class=" p-2 ">detail</th>
                                <th class=" p-2 ">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class=" p-2 " wire:key="{{ $product['id'] }}">{{ $product['id'] }}</td>
                                    <td class=" p-2 " >{{ $product['name'] }}</td>
                                    <td class=" p-2 ">{{ $product['detail'] }}</td>
                                    <td class=" p-2 ">
                                        <x-button link="/product/edit/{{ $product['id'] }}">Edit</x-button>
                                        <x-button link="">Delete</x-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>



        </main>

    </div>





</div>
