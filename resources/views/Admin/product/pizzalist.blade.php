@extends('Admin.layouts.master')

@section('title','Products List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Products
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-xmark"></i>{{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondery">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                <div class="col-3 offset-6">
                    <form action="{{ route('product#list') }}" class="d-flex" method="GET">
                        @csrf
                        <input type="search" name="key" class="form-control" placeholder="Search . . ." value="{{ request('key') }}">
                        <button class="btn btn-dark" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                </div>
                <div class="row my-2 btn bg-white ms-2">
                    <div class="col-5"><i class="fa-solid fa-database mr-2"></i><b>{{ $pizzas->total() }}</b></div>
                </div>
                @if(count($pizzas)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pizzas as $p)
                            <tr class="tr-shadow">
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{ asset('storage/'.$p->image) }}" class="simg-thumbnail shadow-sm rounded"></td>
                                    <td class="col-3">{{ $p->name }}</td>
                                    <td class="col-2">{{ $p->price }}</td>
                                    <td class="col-2">{{ $p->category_name }}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye mr-1"></i>{{ $p->view_count }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('product#edit',$p->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View" type="submit">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                            </a>
                                        </div>

                                                <div>
                                                    <a href="{{ route('product#update_page',$p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" type="submit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('product#delete',$p->id) }}">
                                                        <button class="item " data-toggle="tooltip" data-placement="top" title="Delete" type="submit">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>

                                        </div>
                                    </td>
                                </tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $pizzas->links() }}
                    </div>
                </div>
                @else
                <h1 class="d-flex justify-content-center mt-5">There is not pizza here!</h1>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
