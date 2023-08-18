@extends('Admin.layouts.master')

@section('title', 'Category List Page')
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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondery">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('category#list') }}" class="d-flex" method="GET">
                            @csrf
                            <input type="search" name="key" class="form-control" placeholder="Search . . ."
                                value="{{ request('key') }}">
                            <button class="btn btn-dark" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row my-2 btn bg-white">
                    <div class="col-5"><i class="fa-solid fa-database"></i> {{ $categories->total() }}</div>
                </div>

                @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created_up</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td class="col-5">{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{--  <button class="item " data-toggle="tooltip" data-placement="top" title="View" type="submit">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>  --}}
                                                <a href="{{ route('category#edit', $category->id) }}" method="get">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit" type="submit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete', $category->id) }}">
                                                    <button class="item " data-toggle="tooltip" data-placement="top"
                                                        title="Delete" type="submit">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>
                    </div>
                @else
                    <h1 class="d-flex justify-content-center mt-5">There is not category here!</h1>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
