@extends('Admin.layouts.master')

@section('title','Details Page')
@section('content')
{{--  <!-- MAIN CONTENT-->  --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center">Account Info</h1>
                        </div>
                       <div class="row">
                        <div class="col-3 offset-1">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('image/user_image.webp') }}" class="shadow-sm">
                            @else
                                <img src="{{ asset('storage/'.Auth::user()->image) }}">
                            @endif
                        </div>
                        <div class="col-5 offset-2">
                            <h3 class="my-4"> <i class="fa-regular fa-circle-user mr-2"></i>{{ Auth::user()->name }}</h3>
                            <h3 class="my-4"><i class="fa-regular fa-envelope mr-2"></i>{{ Auth::user()->email }}</h3>
                            <h3 class="my-4"><i class="fa-solid fa-phone mr-2"></i>{{ Auth::user()->phone }}</h3>
                            <h3 class="my-4"><i class="fa-regular fa-address-card mr-2"></i>{{ Auth::user()->address }}</h3>
                            <h3 class="my-4">@if(Auth::user()->gender == 'male')
                                <i class="fa-solid fa-mars mr-2"></i>{{ Auth::user()->gender }}
                                @else
                                <i class="fa-solid fa-venus mr-2"></i>{{ Auth::user()->gender }}
                               @endif</h3>
                            <h3 class="my-4"><i class="fa-solid fa-user-clock mr-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h3>
                        </div>
                       </div>
                       <div class="row">
                        <div class="col-4 offset-1 mt-3">
                            <a href="{{ route('admin#edit') }}">
                                <button class="btn bg-dark text-white" type="submit"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</button>
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  <!-- END MAIN CONTENT-->  --}}
@endsection
