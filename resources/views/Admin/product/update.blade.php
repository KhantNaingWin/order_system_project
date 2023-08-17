@extends('Admin.layouts.master')

@section('title','Update Product Page')
@section('content')
{{--  <!-- MAIN CONTENT-->  --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center">Update Pizza</h1>
                        </div>
                        <div class=" col-1 offset-1">
                            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                        </div>
                            <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="pizzaID" value="{{ $pizza->id }}">
                                <div class="row">
                                    <div class="col-5 offset-1 mt-5">

                                       <img src="{{ asset('storage/'.$pizza->image) }}"/>

                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage" class="form-control  @error('pizzaImage') is-invalid @enderror">
                                    </div>
                                    @error('pizzaImage')
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
                                    <div class="col-5">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="control-label my-0">Name</label>
                                                <input  name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}" aria-required="true" aria-invalid="false" placeholder="enter pizza name...">
                                                @error('pizzaName')
                                                <div class="invalid-feedback">
                                                 {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">Description</label>
                                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id="" cols="30" rows="10" placeholder="enter pizza description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                                @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                 {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">Category</label>
                                                <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                    <option value="">Choose Category</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }}" @if($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                 {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">Price</label>
                                                <input  name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" aria-required="true" aria-invalid="false" placeholder="enter pizza price...">
                                                @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                 {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">Waiting Time</label>
                                                <input  name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" aria-required="true" aria-invalid="false" placeholder="enter waiting time...">
                                                @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                 {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">View Count</label>
                                                <input  name="viewCount" type="number" class="form-control" value="{{ old('viewCount',$pizza->view_count) }}" aria-required="true" aria-invalid="false" disabled>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label my-0">Created_at</label>
                                                <input  name="created_at" type="text" class="form-control" aria-required="true" value="{{ $pizza->created_at->format('j-F-Y') }}" aria-invalid="false" disabled>
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
