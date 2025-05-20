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



      @foreach ($menuList as $menu)
        @if (isset($menu['children']))
          {{-- Menu with Submenu --}}
          <x-menu-sub title="{{ $menu['title'] }}" icon="{{ $menu['icon'] }}" icon-classes="text-warning">
            @foreach ($menu['children'] as $child)
              @if (isset($child['children']) && is_array($child['children']))
                {{-- Submenu dalam submenu --}}
                <x-menu-sub title="{{ $child['title'] }}" icon="{{ $child['icon'] }}" icon-classes="text-warning">
                  @foreach ($child['children'] as $grandChild)
                    @if (isset($grandChild['children']) && is_array($grandChild['children']))
                      {{-- Submenu level ketiga --}}
                      <x-menu-sub title="{{ $grandChild['title'] }}" icon="{{ $grandChild['icon'] }}"
                        icon-classes="text-warning">
                        @foreach ($grandChild['children'] as $greatGrandChild)
                          <x-menu-item title="{{ $greatGrandChild['title'] }}" icon="{{ $greatGrandChild['icon'] }}"
                            link="{{ $greatGrandChild['link'] }}" :class="$greatGrandChild['route-name']" />
                        @endforeach
                      </x-menu-sub>
                    @else
                      <x-menu-item title="{{ $grandChild['title'] }}" icon="{{ $grandChild['icon'] }}"
                        link="{{ $grandChild['link'] }}" :class="$grandChild['route-name']" />
                    @endif
                  @endforeach
                </x-menu-sub>
              @else
                <x-menu-item title="{{ $child['title'] }}" icon="{{ $child['icon'] }}" link="{{ $child['link'] }}"
                  :class="$child['route-name']" />
              @endif
            @endforeach

          </x-menu-sub>
        @else
          {{-- Single Menu --}}
          <x-menu-item title="{{ $menu['title'] }}" icon="{{ $menu['icon'] }}" link="{{ $menu['link'] }}"
            :class="$menu['route-name']" />
        @endif
      @endforeach


      <x-menu-separator title="Test Eloquent Polymorph" icon="o-sparkles" />
      <x-menu-item title="Post" icon="o-home" link="/posts" :class="request()->is('post') ? 'active' : ''" />
      <x-menu-item title="User" icon="o-home" link="/human-resource/users" :class="request()->is('user') ? 'active' : ''" />
      <x-menu-item title="Image" icon="o-home" link="/images" :class="request()->is('image') ? 'active' : ''" />
      <x-menu-item title="Video" icon="o-home" link="/videos" :class="request()->is('video') ? 'active' : ''" />
      <x-menu-item title="Comment" icon="o-home" link="/comments" :class="request()->is('comment') ? 'active' : ''" />
      <x-menu-item title="Tag" icon="o-home" link="/tags" :class="request()->is('tag') ? 'active' : ''" />


      <x-menu-separator title="Test fromSub" icon="o-sparkles" />
      <x-menu-item title="Post" icon="o-home" link="/from-sub/posts" :class="request()->is('from-sub.post') ? 'active' : ''" />
      <x-menu-item title="User" icon="o-home" link="/from-sub/human-resource/users" :class="request()->is('user') ? 'active' : ''" />
      <x-menu-item title="Image" icon="o-home" link="/from-sub/images" :class="request()->is('image') ? 'active' : ''" />
      <x-menu-item title="Video" icon="o-home" link="/from-sub/videos" :class="request()->is('video') ? 'active' : ''" />
      <x-menu-item title="Comment" icon="o-home" link="/from-sub/comments" :class="request()->is('comment') ? 'active' : ''" />
      <x-menu-item title="Tag" icon="o-home" link="/from-sub/tags" :class="request()->is('tag') ? 'active' : ''" />


    </x-menu>

  </x-slot:sidebar>
</div>
