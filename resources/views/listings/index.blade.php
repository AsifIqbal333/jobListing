@extends('layout')

@section('content')
@include('partials._hero')
@include('partials._search')
    {{-- {{ dd($listings); }} --}}
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @if (count($listings)==0)
            <h1>No listings</h1>
        @endif

        @foreach ($listings as $listing)
            @php
                $tags = explode(',',$listing->tags);
            @endphp
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{ $listing->logo ?  asset('storage/'.$listing->logo) : asset('images/acme.png') }}"
                        alt=""
                    />
                    <div>
                        <h3 class="text-2xl">
                            <a href="listings/{{ $listing->id }}">{{ $listing->title }}</a>  
                        </h3>
                        <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                        <ul class="flex">
                            @foreach ($tags as $tag)
                                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                    <a href="/?tag={{ $tag }}">{{ $tag }}</a>
                                </li>    
                            @endforeach
                        </ul>
                        <div class="text-lg mt-4">
                            <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                        </div>
                    </div>
                </div>
            </div>    
        @endforeach
    </div>    
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endsection