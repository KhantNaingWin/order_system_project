@extends('Admin.layouts.master')

@section('title','Admin List Page')
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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                </div>
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondery">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                <div class="col-3 offset-6">
                    <form action="{{ route('admin#list') }}" class="d-flex" method="GET">
                        @csrf
                        <input type="search" name="key" class="form-control" placeholder="Search . . ." value="{{ request('key') }}">
                        <button class="btn btn-dark" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                </div>

                <div class="row my-2 btn bg-white">
                    <div class="col-5"><i class="fa-solid fa-database"><span class="ml-2">{{ $admin->total() }}</span></i></div>
                </div>


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a )
                            <tr class="tr-shadow">
                                <td class="col-1">
                                    @if ($a->image != null)
                                    <img src="{{ asset('storage/'.$a->image) }}" class="simg-thumbnail shadow-sm">
                                    @else

                                    @if ($a->gender == 'male')
                                    <img src="{{ asset('image/user_image.webp') }}" class="simg-thumbnail shadow-sm">
                                    @else
                                    <img src="{{ asset('image/images.png') }}" class="simg-thumbnail shadow-sm">
                                    @endif

                                    @endif
                                </td>
                                <td>{{ $a->name }}</td>
                                <td>{{ $a->email }}</td>
                                <td>{{ $a->gender }}</td>
                                <td>{{ $a->phone }}</td>
                                <td>{{ $a->address }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if (Auth::user()->id != $a->id)
                                        <a href="{{ route('admin#changerole',$a->id) }}" class="mr-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Change Admin Role" type="submit">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a>
                                       <form action="{{ route('admin#delete') }}" method="get">
                                        @csrf
                                        <input type="hidden" name="adminId" value="{{ $a->id }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" type="submit">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                       </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admin->links() }}
                    </div>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
