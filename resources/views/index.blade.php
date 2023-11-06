@extends('layouts.app')

@section('body')

    <div class="w-full pt-4 md:pt-8 lg:p-16 flex flex-col justify-centr items-center ">

        <img src="{{asset('images/logo.png')}}" alt="Image Jardin de cocagne">

        <div class="mt-20">
            <a href="{{ route('login') }}" class="mr-4 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Connexion
            </a>

            <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Adhérer
            </a>
        </div>

    </div>

@endsection
