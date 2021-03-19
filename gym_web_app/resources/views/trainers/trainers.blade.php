@extends('layout.base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Trainers</li>
    </ol>
</nav>

{{-- add new member modal  --}}
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal--fir">
    Add New Trainer
</button>

{{-- list  --}}
<div class="card card-body mt-4 table-responsive">
    <div class="title font-weight-bold">
        Trainer Lists
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Full Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Username</th>
                <th>Morning Shift</th>
                <th>Evening Shift</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($trainers))
            @foreach ($trainers as $item)
            <tr>

                <td>
                    {{$item->id}}
                </td> 
                <td>
                    {{$item->fullname}}
                </td>
                <td>
                    {{$item->phone}}
                </td>
                <td>
                    {{$item->address}}
                </td>
                <td>
                    {{$item->username}}
                </td>
                <td>
                    @if ($item->shift_m)
                        YES 
                        @else 
                        NO
                    @endif 
                </td>
                <td>
                    @if ($item->shift_e)
                        YES 
                        @else 
                        NO
                    @endif 
                </td>
                <td>
                    <div class="d-flex">
                        <a href="/trainers/view/{{$item->id}}" class="btn btn-sm btn-success mr-2" data-toggle="tooltip"  title="View Trainer">
                            <i class="material-icons">visibility</i>
                        </a>
                      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal--sendnotice-{{$item->id}}" data-toggle="tooltip" title="Send Notice ">
                            <i class="material-icons">chat</i>
                        </button>

                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
{{--!ENDS list  --}}
{{-- paginations  --}}
<div class="d-flex justify-content-center mt-5 mb-4">
    <style>
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            background: none !important;
            color: #ff4081;

        }

        .pagination .page-item .page-link {
            color: #ff4081;
            font-size: 15px;
        }
    </style>

    @if (!empty($members))
    {!! $trainers->links() !!}
    @endif

</div>
{{--ENDS paginations  --}}
@endsection

@section('modal')
{{-- model to add new member  --}}
<div class="modal fade" id="modal--fir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Trainer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/trainers/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Image (optional)</label>
                        <input name="image" type="file" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name *</label>
                        <input name="fullname" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone *</label>
                        <input name="phone" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address *</label>
                        <input name="address" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shifts </label>
                        <div class="custom-control custom-checkbox mt-2">
                            <input name="shift_m" type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Morning</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="shift_e" type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Evening</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username *</label>
                        <input name="username" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password *</label>
                        <input name="password" type="text" class="form-control" required>
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

                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 

{{-- send notice  --}}
@if (!empty($trainers))
@foreach ($trainers as $item)
<div class="modal fade" id="modal--sendnotice-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send notice to "{{$item->fullname}}"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/notifications/send/add" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$item->user_id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Notice</label>
                        <textarea name="notice" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif


@endsection