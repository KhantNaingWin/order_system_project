@extends('Admin.layouts.master')

@section('title', 'Change Role Page')
@section('content')
    {{--  <!-- MAIN CONTENT-->  --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="ml-3 mt-2">
                            <i class="fa-solid fa-arrow-left text-dark " onclick="history.back()"></i>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="text-center">Change Role</h1>
                            </div>
                            <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if ($account->image == null)
                                            <img src="{{ asset('image/user_image.webp') }}" class="shadow-sm">
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" />
                                        @endif
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white col-12" type="submit">Change
                                                <i class="fa-solid fa-upload"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 offset-1">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input name="name" disabled type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $account->name) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin name">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="admin"
                                                        @if ($account->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user"
                                                        @if ($account->role == 'user') selected @endif>User</option>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input name="email" disabled type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $account->email) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">phone</label>
                                                <input name="phone" disabled type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', $account->phone) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="enter admin phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Gender </label>
                                                <select name="gender" disabled
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Choose Gender...</option>
                                                    <option value="male"
                                                        @if ($account->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if ($account->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Address</label>
                                                <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" id=""
                                                    cols="30" rows="10" placeholder="enter admin address">{{ old('address', $account->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

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
