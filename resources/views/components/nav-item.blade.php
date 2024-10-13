<li class="menu nav-item">
    <a href="{{ route($href) }}"
        class="nav-link group {{ in_array(request()->route()->getName(), $activeCnd) ? 'active' : '' }}">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center">
                {!! loadSvg($svg) !!}
                <span class="ltr:pl-3 rtl:pr-3 text-black">{{ $title }}</span>
            </div>
        </div>
    </a>
</li>
