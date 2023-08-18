@extends('User.layouts.master')
@section('title', 'Account Edit Page')
@section('content')
    {{--  <!-- MAIN CONTENT-->  --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 offset-2">
                                    @if (session('updateSuccess'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('updateSuccess') }}<i class="fa-regular fa-thumbs-up ml-1"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-title">
                                <h1 class="text-center">Account Profile</h1>
                            </div>
                            <hr class="bg-dark">
                            <form action="{{ route('user#acountchangepage', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('image/user_image.webp') }}"
                                                class=" img-thumbnail shadow-sm">
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control  @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white col-12" type="submit">update
                                                <i class="fa-solid fa-upload"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 offset-1">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin name">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', Auth::user()->email) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">phone</label>
                                                <input name="phone" type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Gender </label>
                                                <select name="gender"
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Choose Gender...</option>
                                                    <option value="male"
                                                        @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Address</label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30"
                                                    rows="10" placeholder="enter admin address">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                                <input name="role" type="text" class="form-control"
                                                    aria-required="true" value="{{ old('role', Auth::user()->role) }}"
                                                    aria-invalid="false" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  <!-- END MAIN CONTENT-->  --}}
@endsection
