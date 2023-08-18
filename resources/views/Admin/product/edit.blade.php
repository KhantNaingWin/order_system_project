@extends('Admin.layouts.master')

@section('title', 'Product Edit Page')
@section('content')
    {{--  <!-- MAIN CONTENT-->  --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left text-dark"onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h1 class="text-center">Account Details</h1>
                            </div>
                            <div class="row">
                                <div class="col-2 offset-1 mt-4">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" />
                                </div>
                                <div class="col-9">
                                    <span class="my-4 btn btn-dark text-white"> <i
                                            class="fa-solid fa-file-signature mr-2"></i>{{ $pizza->name }}</span>
                                    <span class="my-4 btn btn-dark text-white"><i
                                            class="fa-solid fa-hand-holding-dollar mr-2"></i>{{ $pizza->price }}
                                        kyats</span>
                                    <span class="my-4 btn btn-dark text-white"><i
                                            class="fa-solid fa-hourglass-start mr-2"></i>{{ $pizza->waiting_time }}
                                        mins</span>
                                    <span class="my-4 btn btn-dark text-white"><i
                                            class="fa-solid fa-eye mr-2"></i>{{ $pizza->view_count }}</span>
                                    <span class="my-4 btn btn-dark text-white"><i
                                            class="fa-solid fa-id-badge mr-2"></i>{{ $pizza->category_name }}</span>
                                    <span class="my-4 btn btn-dark text-white"><i
                                            class="fa-solid fa-user-clock mr-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <div class="my-4"><i class="fa-regular fa-clipboard mr-2"></i>Details</div>
                                    <div class="">{{ $pizza->description }}</div>
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
