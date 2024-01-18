@extends('layouts.app-adherent')

@section('body')

<div class="lg:px-8 lg:py-8 xl:px-16">
    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
        <div class="rounded-tl-lg rounded-tr-lg sm:rounded-tr-none group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500">
            <div>
                <span class="inline-flex rounded-lg p-3 bg-teal-50 text-teal-700 ring-4 ring-white">
                    <svg class="h-6 w-6 shrink-0 fill-teal-400" stroke-width="1" viewBox="0 0 448 512" stroke="currentColor" aria-hidden="true">
                        <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                    </svg>
                </span>
            </div>
            <div class="mt-8">
                <h3 class="text-base font-semibold leading-6 text-gray-900">
                    <a href="{{ route('dashboard.account') }}" class="focus:outline-none">
                        <!-- Extend touch target to entire panel -->
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Mon compte
                    </a>
                </h3>
                <p class="mt-2 text-sm text-gray-500">Accédez a toutes vos informations.</p>
            </div>
            <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                </svg>
            </span>
        </div>
        <div class="sm:rounded-tr-lg group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500">
            <div>
                <span class="inline-flex rounded-lg p-3 bg-purple-50 text-purple-700 ring-4 ring-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </span>
            </div>
            <div class="mt-8">
                <h3 class="text-base font-semibold leading-6 text-gray-900">
                    <a href="{{route('dashboard.calendar')}}" class="focus:outline-none">
                        <!-- Extend touch target to entire panel -->
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Calendriers
                    </a>
                </h3>
                <p class="mt-2 text-sm text-gray-500">Accédez au calendrier de livraisons.</p>
            </div>
            <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                </svg>
            </span>
        </div>

        <div class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500">
            <div>
                <span class="inline-flex rounded-lg p-3 bg-yellow-50 text-yellow-700 ring-4 ring-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </span>
            </div>
            <div class="mt-8">
                <h3 class="text-base font-semibold leading-6 text-gray-900">
                    <a href="{{ route('dashboard.shop') }}" class="focus:outline-none">
                        <!-- Extend touch target to entire panel -->
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Boutique
                    </a>
                </h3>
                <p class="mt-2 text-sm text-gray-500">Accédez a la boutique et parcourez les différents produits, abonnements ou encore paniers disponible !</p>
            </div>
            <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                </svg>
            </span>
        </div>

    </div>
</div>

@endsection
