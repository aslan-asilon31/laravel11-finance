<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

    {{-- BRAND --}}
    <div class="flex items-center justify-center   w-full my-8">
      <img src="{{ asset('LOGO-KU.png') }}" alt="" srcset="" class="text-center w-32">
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



      @forelse ($menuList as $item)
        <x-menu-item title="{{ $item['title'] }}" icon="o-home" link="{{ $item['link'] }}" :class="$item['route-name']" />
      @empty
        <x-menu-item title="" icon="o-home" link="" />
      @endforelse

    </x-menu>

  </x-slot:sidebar>
</div>
