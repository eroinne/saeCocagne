@extends('layouts.app-staffs')

@section('body')

<ul role="list" class="divide-y divide-gray-100">
    @foreach($adherents as $adherent)
        <li onclick="window.location='{{ route('staffs.adherent', ['id' => $adherent->id]) }}'" class="relative py-5 hover:bg-gray-50">
            <div class="mx-auto flex max-w-7xl justify-between gap-x-6 px-4 sm:px-6 lg:px-8">
                <div class="flex gap-x-4">
                    @if(isset($adherent->photo))
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="data:image/png;base64,{{$adherent->photo }}" alt="">
                    @else
                        <span id="default-svg" class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                    @endif
                    <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        <a href="#">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                        {{$adherent->name}} {{$adherent->prenom}}
                        </a>
                    </p>
                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                        <a href="mailto:leslie.alexander@example.com" class="relative truncate hover:underline">{{$adherent->email}}</a>
                    </p>
                    </div>
                </div>
                <div class="flex items-center gap-x-4">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">{{$adherent->profession}}</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">Dernière modification
                        <time datetime="2023-01-23T13:23Z">
                            {{ \Carbon\Carbon::parse($adherent->updated_at)->locale('fr')->diffForHumans() }}

                        </time>
                    </p>
                    </div>
                    <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </li>

    @endforeach

  </ul>



@endsection
