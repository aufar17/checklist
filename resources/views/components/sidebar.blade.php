<style>
    .navlink {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
    }

    .navlink:hover {
        background-color: #fff !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        border-radius: 0.5rem;
    }

    .navlink:hover .icon-container {
        background-color: #ea0606 !important;
    }

    .navlink:hover .icon-container i {
        color: #fff !important;
    }
</style>

@props([
'notifBadge' => 0,
'user' => null
])

@php
$dept = $user?->dept ?? 'default';
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html"
            target="_blank">
            <img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/KYB_Corporation_company_logo.svg/2560px-KYB_Corporation_company_logo.svg.png') }}"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Kayaba Indonesia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <x-navlink href="{{ route('admin') }}" :active="request()->is('admin') " :notifBadge="$notifBadge"
                icon="fa-house">
                Dashboard
            </x-navlink>
            @if($dept === 'EHS')
            <x-navlink href="{{ route('hydrant') }}"
                :active="request()->is(['hydrant','new-hydrant','detail-hydrant']) " icon="fa-list">
                Hydrant
            </x-navlink>
            @endif
            @if($dept === 'PE-2W')
            <x-navlink href="{{ route('hydrant') }}"
                :active="request()->is(['hydrant','new-hydrant','detail-hydrant']) " icon="fa-list">
                Machine
            </x-navlink>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            <li class="nav-item position-relative">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="navlink nav-link w-85 text-start bg-transparent border-0 px-3">
                        <div
                            class="icon-container icon icon-shape icon-sm shadow border rounded bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-from-bracket fa-lg text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </button>
                </form>
            </li>



        </ul>
    </div>
</aside>