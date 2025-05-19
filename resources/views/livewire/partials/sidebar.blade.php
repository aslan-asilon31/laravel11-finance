<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

    {{-- BRAND --}}
    <div class="flex items-center justify-center w-full">
      <img src="{{ asset('my-logo-aslan-circle90x90.png') }}" alt="" srcset="">
    </div>

    {{-- MENU --}}
    <x-menu activate-by-route>

      {{-- User --}}
      <x-menu-sub title="Setting" icon="o-cog-6-tooth">
        <x-menu-item title="Profile" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="logout" title="Logout" icon="o-x-circle" />
        {{-- <x-menu-item title="sample" icon="o-arrow-right-circle" link="#" /> --}}
      </x-menu-sub>
      <x-menu-separator />


      <x-menu-item title="{{ __('dashboard.dashboard') }}" icon="o-home" link="/" :class="request()->is('dasbor') ? 'active' : ''" />
      <x-menu-sub title="Language" icon="o-cog-6-tooth">
        <a href="{{ route('set-language', ['locale' => 'en']) }}" class="menu-item">English</a>
        <a href="{{ route('set-language', ['locale' => 'jp']) }}" class="menu-item">Japan</a>
        <a href="{{ route('set-language', ['locale' => 'id']) }}" class="menu-item">Indonesia</a>
      </x-menu-sub>
      <x-menu-separator title="Test" icon="o-sparkles" />
      <x-menu-item title="Post" icon="o-home" link="/posts" :class="request()->is('post') ? 'active' : ''" />
      <x-menu-item title="User" icon="o-home" link="/users" :class="request()->is('user') ? 'active' : ''" />
      <x-menu-item title="Image" icon="o-home" link="/images" :class="request()->is('image') ? 'active' : ''" />
      <x-menu-item title="Video" icon="o-home" link="/videos" :class="request()->is('video') ? 'active' : ''" />
      <x-menu-item title="Comment" icon="o-home" link="/comments" :class="request()->is('comment') ? 'active' : ''" />
      <x-menu-item title="Tag" icon="o-home" link="/tags" :class="request()->is('tag') ? 'active' : ''" />

        <x-menu-separator title="Roles & Permissions" icon="o-sparkles" />
      <x-menu-item title="{{ __('dashboard.roles') }}" icon="o-home" link="/role" :class="request()->is('dasbor') ? 'active' : ''" />
      <x-menu-item title="{{ __('dashboard.permissions') }}" icon="o-home" link="/permission" :class="request()->is('dasbor') ? 'active' : ''" />


      <x-menu-separator title="Main" icon="o-sparkles" />

      <x-menu-sub title="{{ __('dashboard.cash-book') }}" icon="o-cog-6-tooth">
        <x-menu-item title="daftar buku kas dan bank" icon="o-user-circle" link="/company" />
        <x-menu-item wire:click="" title="daftar transfer" icon="o-x-circle" />
      </x-menu-sub>

      <x-menu-sub title="{{ __('dashboard.receipts') }}" icon="o-cog-6-tooth">
        <x-menu-item title="daftar penerimaan" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="" title="rekonsiliasi penerimaan penjualan" icon="o-x-circle" />
      </x-menu-sub>

      <x-menu-sub title="{{ __('dashboard.expenses') }}" icon="o-cog-6-tooth">
        <x-menu-item title="daftar penerimaan" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="" title="rekonsiliasi penerimaan penjualan" icon="o-x-circle" />
      </x-menu-sub>


      <x-menu-sub title="{{ __('dashboard.expense-list') }}" icon="o-cog-6-tooth">
        <x-menu-item title="daftar biaya" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="" title="daftar tagihan rutin" icon="o-x-circle" />
        <x-menu-item title="daftar daftar " icon="o-user-circle" link="#" />
      </x-menu-sub>

      <x-menu-sub title="{{ __('dashboard.financial-report') }}" icon="o-cog-6-tooth">
        <x-menu-item title="laporan jurnal" icon="o-user-circle" link="#" />
        <x-menu-item wire:click="" title="laporan neraca" icon="o-x-circle" />
        <x-menu-item title="laporan laba rugi" icon="o-user-circle" link="#" />
        <x-menu-item title="laporan buku besar" icon="o-user-circle" link="#" />
        <x-menu-item title="laporan arus kas" icon="o-user-circle" link="#" />
        <x-menu-item title="laporan hutang" icon="o-user-circle" link="#" />
        <x-menu-item title="laporan piutang" icon="o-user-circle" link="#" />
      </x-menu-sub>


      <x-menu-sub title="{{ __('dashboard.account-list') }}" icon="o-cog-6-tooth">
        <x-menu-item title="akun" icon="o-user-circle" link="#" />
        <x-menu-item title="jurnal umum" icon="o-user-circle" link="#" />
      </x-menu-sub>

      <x-menu-item title="{{ __('dashboard.users') }}" icon="o-squares-2x2" link="/pengguna" :class="request()->is('pengguna') ? 'active' : ''" />
      <x-menu-item title="Company" icon="o-squares-2x2" link="/company" :class="request()->is('company') ? 'active' : ''" />
    </x-menu>

  </x-slot:sidebar>
</div>
