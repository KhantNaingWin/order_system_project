@extends('Admin.layouts.master')

@section('title','User List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
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
                    <form action="{{ route('order#list') }}" class="d-flex" method="GET">
                        @csrf
                        <input type="search" name="key" class="form-control" placeholder="Search . . ." value="{{ request('key') }}">
                        <button class="btn btn-dark" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class=" text-bold">
               <b> Total -{{ $users->total() }}</b>
            </div>
                <div class="table-responsive table-responsive-data2 mt-4">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="statusChange">
                                @foreach ($users as $user )
                                <tr>
                                    <td class="col-1">
                                        @if ($user->image == null)
                                    <img src="{{ asset('image/user_image.webp') }}" class="shadow-sm">
                                    @else
                                        <img src="{{ asset('storage/'.$user->image) }}">
                                    @endif
                                    </td>
                                    <input type="hidden"  value="{{ $user->id }}" class="userId">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <select name="" id="" class="form-control statusChange">
                                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSession')
<script>
    $(document).ready(function(){
        $('.statusChange').change(function(){
            $currentStatus=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('.userId').val();
            $data={
                'userId':$userId,
                'role'  :$currentStatus,
            }
            $.ajax({
                type:'get',
                url: 'http://localhost:8000/user/change/role',
                data: $data,
                dataType: 'json',
                success: function(response){
                }
            })
            location.reload();
        })
    })
</script>
@endsection

