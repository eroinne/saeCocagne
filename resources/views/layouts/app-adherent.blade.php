<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="icon" type="image/x-icon" href="{{asset('images/jardin.ico')}}">
        <title>Jardin de cocagne</title>

        @vite('resources/css/app.css')

        @livewireStyles
        @stack('styles')
        @stack('head-scripts')
    </head>

    <body>
        @vite('resources/js/app.js')
        @php
            // Get the current route name.
            $routeName = Route::currentRouteName();
        @endphp

        <div x-data="{openSidebar: false}">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" >
                <!--
                    Off-canvas menu backdrop, show/hide based on off-canvas menu state.

                    Entering: "transition-opacity ease-linear duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                    Leaving: "transition-opacity ease-linear duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div x-cloak x-show="openSidebar" class="fixed inset-0 bg-gray-900/80"></div>

                <div x-cloak x-show="openSidebar" class="fixed inset-0 flex" >
                    <!--
                        Off-canvas menu, show/hide based on off-canvas menu state.

                        Entering: "transition ease-in-out duration-300 transform"
                        From: "-translate-x-full"
                        To: "translate-x-0"
                        Leaving: "transition ease-in-out duration-300 transform"
                        From: "translate-x-0"
                        To: "-translate-x-full"
                    -->
                    <div x-cloak x-show="openSidebar" class="relative mr-16 flex w-full max-w-xs flex-1">
                        <!--
                            Close button, show/hide based on off-canvas menu state.

                            Entering: "ease-in-out duration-300"
                            From: "opacity-0"
                            To: "opacity-100"
                            Leaving: "ease-in-out duration-300"
                            From: "opacity-100"
                            To: "opacity-0"
                        -->
                        <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                            <button x-on:click="openSidebar = !openSidebar" type="button" class="-m-2.5 p-2.5">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-green-900 px-6 pb-4 ring-1 ring-white/10">
                            <div class="flex h-16 shrink-0 items-center">
                                <img class="h-8 w-auto" src="{{asset('images/jardin.ico')}}" alt="Logo cocagne">
                            </div>
                            <nav class="flex flex-1 flex-col">
                                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li>
                                                <!-- Current: "bg-green-800 text-white", Default: "text-gray-400 hover:text-white hover:bg-green-800" -->
                                                <a href="{{ route('dashboard') }}" class=" {{ $routeName == 'dashboard' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                                    </svg>
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard.account') }}" class="{{ $routeName == 'dashboard.account' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                    <svg class="h-6 w-6 shrink-0 {{ $routeName == 'dashboard.account' ? 'fill-white' : 'fill-gray-400' }} group-hover:fill-white" stroke-width="1" viewBox="0 0 448 512" stroke="currentColor" aria-hidden="true">
                                                        <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                                                    </svg>
                                                    Mon compte
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard.shop') }}" class="{{ $routeName == 'dashboard.shop' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                    <svg class="h-6 w-6 shrink-0 {{ $routeName == 'dashboard.shop' ? 'fill-white' : 'fill-gray-400' }} group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                        <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                                    </svg>
                                                    Boutique
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard.calendar') }}" class="{{ $routeName == 'dashboard.calendar' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                    </svg>
                                                    Calendrier
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="mt-auto">
                                        <a href="/api/documentation" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-green-800 hover:text-white">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            API
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-green-900 px-6 pb-4">
                    <div class="flex h-16 shrink-0 items-center">
                        <img class="h-8 w-auto" src="{{asset('images/jardin.ico')}}" alt="Logo cocagne">
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <!-- Current: "bg-green-800 text-white", Default: "text-gray-400 hover:text-white hover:bg-green-800" -->
                                        <a href="{{ route('dashboard') }}" class=" {{ $routeName == 'dashboard' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dashboard.account') }}" class="{{ $routeName == 'dashboard.account' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 {{ $routeName == 'dashboard.account' ? 'fill-white' : 'fill-gray-400' }} group-hover:fill-white" stroke-width="1" viewBox="0 0 448 512" stroke="currentColor" aria-hidden="true">
                                                <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                                            </svg>
                                            Mon compte
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dashboard.shop') }}" class="{{ $routeName == 'dashboard.shop' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 {{ $routeName == 'dashboard.shop' ? 'fill-white' : 'fill-gray-400' }} group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                            </svg>
                                            Boutique
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dashboard.calendar') }}" class="{{ $routeName == 'dashboard.calendar' ? 'text-white bg-green-800' : 'text-gray-400 hover:text-white hover:bg-green-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                            </svg>
                                            Calendrier
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="mt-auto">
                                <a href="/api/documentation" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-green-800 hover:text-white">
                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    API
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="lg:pl-72">
                <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                    <button x-on:click="openSidebar = !openSidebar" type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Separator -->
                    <div class="h-6 w-px bg-green-900/10 lg:hidden" aria-hidden="true"></div>

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end">
                        <div class="flex items-center gap-x-4 lg:gap-x-6"  >
                            <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </button>

                            <!-- Separator -->
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-green-900/10" aria-hidden="true"></div>

                            <!-- Profile dropdown -->
                            <div class="relative" x-data="{open: false}">
                                <button x-on:click='open = !open'  @click.outside='open= false' type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    @if(isset(Auth::user()->photo))
                                        <img class="h-8 w-8 rounded-full bg-gray-50" src="data:image/png;base64,{{ Auth::user()->photo }}" alt="">
                                    @else
                                        <span class="inline-block h-8 w-8 overflow-hidden rounded-full bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </span>
                                    @endif
                                    <span class="hidden lg:flex lg:items-center">
                                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ Auth::user()->prenom }} {{ Auth::user()->name }}</span>
                                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </span>

                                </button>



                                <!--
                                    Dropdown menu, show/hide based on menu state.

                                    Entering: "transition ease-out duration-100"
                                    From: "transform opacity-0 scale-95"
                                    To: "transform opacity-100 scale-100"
                                    Leaving: "transition ease-in duration-75"
                                    From: "transform opacity-100 scale-100"
                                    To: "transform opacity-0 scale-95"
                                -->
                                <div x-cloak x-show="open" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <!-- Active: "bg-gray-50", Not Active: "" -->
                                    <a href="{{ route('dashboard') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>
                                    <a href="{{ route('logout') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-1">Déconnexion</a>
                                </div>


                            </div>
                            <!-- Panier -->
                            <div x-data="{ cartCount: 1 }">
                                <a href="{{ route('dashboard.cart') }}">
                                    <div class="relative">
                                        <!-- Icône de panier SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg>

                                        <!-- Nombre dans une bulle verte -->
                                        <span x-cloak x-show="cartCount > 0" class="absolute -top-2 -right-2 -mt-1 -mr-1 w-4 h-4  text-white rounded-full p-1 text-xs">
                                            <p x-text="cartCount" class="text-sm text-green-500"></p>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="py-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        @yield('body')
                    </div>
                </main>
            </div>
        </div>

        <style>
            [x-cloak] { display: none !important; }
        </style>

        @if(session('success'))
            <x-success-notification :message="session('success')" />
        @endif

        @if(session('error'))
            <x-error-notification :message="session('error')" />
        @endif

        @livewireScripts
    </body>


</html>
