@extends('layout.base')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/trainers">Trainers</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $trainer->fullname }}</li>
        </ol>
    </nav>



    {{-- member detail --}}
    <div class="member-details mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card card-body table-responsive">
                    <table class="table">
                        <tbody>
                            {{-- <tr>
                            <td>Image</td>
                            <td>
                                @if ($member->image != 'no')
                                <img src="{{asset('/images/pics/'.$member->image)}}" class="img-fluid"
                                    style="height: 125px">
                                @else
                                no
                                @endif
                            </td>
                        </tr> --}}
                            <tr>
                                <td>Username</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td>Fullname</td>
                                <td>{{ $trainer->fullname }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $trainer->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $trainer->address }}</td>
                            </tr>
                            <tr>
                                <td>Shifts</td>
                                <td>
                                    @if ($trainer->shift_m)
                                        <span class="badge badge-pill badge-dark px-3 py-1">
                                            Morning
                                        </span>
                                    @endif
                                    @if ($trainer->shift_e)
                                        <span class="badge badge-pill badge-dark px-3 py-1">
                                            Evening
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#modal--updategeneral">
                            Update General Details
                        </button>
                        {{-- Remove trainer --}}
                        <button type="button" class="btn  btn-sm btn-danger " data-toggle="modal" data-target="#modal--remove">
                            Remove Trainer Data From System
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- !ENDS member detail --}}






@endsection

@section('modal')



    {{-- model to remove --}}
    <div class="modal fade" id="modal--remove" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Trainer Data From System ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trainers/remove" method="POST">
                        @csrf

                        <input name="trainer_id" type="hidden" value="{{ $trainer->id }}">

                        <div class="mt-3">
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            <button data-dismiss="modal" class="btn btn-sm btn-dark">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- update   general information --}}
    <div class="modal fade" id="modal--updategeneral" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update General Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trainers/update" method="POST">
                        @csrf
                        <input name="user_id" type="hidden" value="{{ $user->id }}">
                        {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Image (optional)</label>
                        <input name="image" type="file" class="form-control">
                        <small class="form-text text-muted">Old Image will be replaced with new above
                            Image.</small>
                    </div> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name *</label>
                            <input name="fullname" type="text" class="form-control" required
                                value="{{ $trainer->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone *</label>
                            <input name="phone" type="text" class="form-control" required value="{{ $trainer->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address *</label>
                            <input name="address" type="text" class="form-control" required value="{{ $trainer->address }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shifts </label>
                            <div class="custom-control custom-checkbox mt-2">
                                <input name="shift_m" type="checkbox" class="custom-control-input" id="customCheck1" @if ($trainer->shift_m) checked @endif>
                                <label class="custom-control-label" for="customCheck1">Morning</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input name="shift_e" type="checkbox" class="custom-control-input" id="customCheck2" @if ($trainer->shift_e) checked @endif>
                                <label class="custom-control-label" for="customCheck2">Evening</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username *</label>
                            <input name="username" type="text" class="form-control" required value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label>Password (optional)</label>
                            <input name="password" type="text" class="form-control">
                            <small class="form-text text-muted">Old password will be replaced with new above
                                password.</small>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger error-container mt-2">
                                <div class="alert alert-danger">
                                    <ul class="errors">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
