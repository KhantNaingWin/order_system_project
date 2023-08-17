@extends('User.layouts.master')
@section('title','Account Password Change Page')
@section('content')
<div class="row">

    <div class="col-6 offset-3">
        <a href="{{ route('user#home') }}" class="ml-4"><i class="fa-solid fa-reply-all text-dark"></i></a>
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password </h3>
                                </div>
                                <hr class="bg-dark">
                                <form action="{{ route('user#changepassword') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Old Password</label>
                                        <input  name="oldPassword" type="password" @if(session('noMatch')) class="is-invalid" @endif class="form-control  @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="enter old password">
                                        @error('oldPassword')
                                        <div class="invalid-feedback">
                                         {{ $message }}
                                        </div>
                                        @enderror
                                        @if(session('noMatch'))
                                        <div class="invalid-feedback">
                                            {{ session('noMatch') }}
                                           </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">New Password</label>
                                        <input  name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="enter new password">
                                        @error('newPassword')
                                        <div class="invalid-feedback">
                                         {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1"> Confirm Password </label>
                                        <input  name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="enter confirm password">
                                        @error('confirmPassword')
                                        <div class="invalid-feedback">
                                         {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-white btn-block">
                                            <span id="payment-button-amount"><i class="fa-solid fa-key mr-2"></i>change password</span>

                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6 offset-3">
        @if (session('changesuccess'))
    <div class="alert alert-success">
        {{ session('changesuccess') }}<i class="fa-solid fa-thumbs-up ml-1"></i>
    </div>
@endif
    </div>
</div>

@endsection
