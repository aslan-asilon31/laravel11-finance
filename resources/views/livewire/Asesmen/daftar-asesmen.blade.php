<div>

    <header class="bg-white shadow-md p-4 mb-10 rounded-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-sm md:text-md font-bold text-orange-900">Umedalife</h1>
            <span id="asesmen-durasi" class="font-bold text-orange-900">00:00</span>
            <x-profile-dropdown />
        </div>
    </header>


    @php
        // Set locale ke bahasa Indonesia
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="flex justify-center">


        <div class=" h-screen max-w-4xl mx-auto bg-white p-8 rounded-md shadow-lg ">
            <h1 class="text-md sm:text-lg font-bold mb-6 text-orange-900 text-center">Daftar Asesmen</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @forelse ($asesmens as $asesmen)
                    <div class="transform transition-transform duration-300 hover:shadow-2xl hover:scale-105 bg-gray-100 p-4 rounded-md shadow-md transform transition-transform duration-300 hover:shadow-lg hover:scale-105 " style="background-image: url({{ asset('bg-brown.png') }}); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 bg-black opacity-50 rounded-md z-1"></div>
                        <div class="relative z-99 text-center">
                            <h2 class="text-sm md:text-md font-semibold text-white">{{ $asesmen->judul }}</h2>
                            <div class="py-4 flex flex-col md:flex-row justify-between">
                                <div class="flex flex-col p-2 text-left">
                                    <p class="text-gray-100 text-xs">Waktu:</p>
                                    <p class="text-gray-100 text-xs text-[9px]">
                                        {{ \Carbon\Carbon::parse($asesmen->tgl_mulai)->translatedFormat('l, d F Y') }} - {{ \Carbon\Carbon::parse($asesmen->tgl_selesai)->translatedFormat('l, d F Y') }} WIB
                                    </p>
                                </div>
                                <div class="flex flex-col p-2 text-left">
                                    <p class="text-gray-100 text-xs">Durasi:</p>
                                    <p class="text-gray-100 text-[9px]">{{ $asesmen->durasi }} menit </p>
                                </div>
                            </div>

                            <a href="/konfirmasi-mulai/{{ $asesmen->id }}" class="mt-4 text-xs w-full  bg-orange-800 hover:bg-orange-900 text-white py-2 px-4 rounded">
                                Mulai Assesment
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="transform transition-transform duration-300 hover:shadow-2xl hover:scale-105 bg-gray-100 p-4 rounded-md shadow-md transform transition-transform duration-300 hover:shadow-lg hover:scale-105">
                        <h2 class="text-sm md:text-md font-semibold">-</h2>
                    </div>
                @endforelse

            </div>
        </div>
    </div>




</div>
