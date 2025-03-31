<div>
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

        {{-- BRAND --}}
        <img src="{{ asset('my-logo-aslan-circle90x90.png') }}" alt="" srcset="">

        {{-- MENU --}}
        <x-menu activate-by-route>

            {{-- User --}}
            <x-menu-sub title="Setting" icon="o-cog-6-tooth">
            <x-menu-item title="Profile" icon="o-user-circle" link="#" />
            <x-menu-item wire:click="logout" title="Logout" icon="o-x-circle" />
            {{-- <x-menu-item title="sample" icon="o-arrow-right-circle" link="#" /> --}}
            </x-menu-sub>
            <x-menu-separator />


            <x-menu-item title="Dashboard" icon="o-home" link="/"  :class="request()->is('dasbor') ? 'active' : ''" />
            <x-menu-separator title="Main" icon="o-sparkles" />

            <x-menu-sub title="buku kas" icon="o-cog-6-tooth">
                <x-menu-item title="daftar buku kas dan bank" icon="o-user-circle" link="#" />
                <x-menu-item wire:click="" title="daftar transfer" icon="o-x-circle" />
            </x-menu-sub>

            <x-menu-sub title="penerimaan" icon="o-cog-6-tooth">
                <x-menu-item title="daftar penerimaan" icon="o-user-circle" link="#" />
                <x-menu-item wire:click="" title="rekonsiliasi penerimaan penjualan" icon="o-x-circle" />
            </x-menu-sub>

            <x-menu-sub title="pengeluaran" icon="o-cog-6-tooth">
                <x-menu-item title="daftar penerimaan" icon="o-user-circle" link="#" />
                <x-menu-item wire:click="" title="rekonsiliasi penerimaan penjualan" icon="o-x-circle" />
            </x-menu-sub>

            <x-menu-sub title="daftar pengeluaran" icon="o-cog-6-tooth">
                <x-menu-item title="daftar biaya" icon="o-user-circle" link="#" />
                <x-menu-item wire:click="" title="daftar tagihan rutin" icon="o-x-circle" />
                <x-menu-item title="daftar daftar " icon="o-user-circle" link="#" />
            </x-menu-sub>

            <x-menu-sub title="laporan keuangan" icon="o-cog-6-tooth">
                <x-menu-item title="laporan jurnal" icon="o-user-circle" link="#" />
                <x-menu-item wire:click="" title="laporan neraca" icon="o-x-circle" />
                <x-menu-item title="laporan laba rugi" icon="o-user-circle" link="#" />
                <x-menu-item title="laporan buku besar" icon="o-user-circle" link="#" />
                <x-menu-item title="laporan arus kas" icon="o-user-circle" link="#" />
                <x-menu-item title="laporan hutang" icon="o-user-circle" link="#" />
                <x-menu-item title="laporan piutang" icon="o-user-circle" link="#" />
            </x-menu-sub>


            <x-menu-sub title="daftar akun" icon="o-cog-6-tooth">
                <x-menu-item title="akun" icon="o-user-circle" link="#" />
                <x-menu-item title="jurnal umum" icon="o-user-circle" link="#" />
            </x-menu-sub>

            <x-menu-sub title="Language" icon="o-cog-6-tooth">
                <x-menu-item title="English"  link="{{ route('dasboard', ['lang' => 'en']) }}" :active="false" />
                <x-menu-item title="Japan"  link="{{ route('dasboard', ['lang' => 'jp']) }}" :active="false" />
                <x-menu-item title="Indonesia"  link="{{ route('dasboard', ['lang' => 'id']) }}" :active="false" />
            </x-menu-sub>

            <x-menu-item title="Pengguna" icon="o-squares-2x2" link="/pengguna" :class="request()->is('pengguna') ? 'active' : ''" />
        </x-menu>
    </x-slot:sidebar>
</div>
