@extends('layout.base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/schedule">Schedule</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$trainer->fullname}}</li>
    </ol>
</nav>

{{-- assign member model --}}
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal--fir">
    Assign member
</button>

{{-- list  --}}
<div class="card card-body mt-4 table-responsive">
    <div class="title font-weight-bold">
        Member Lists
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($assigned_members))
            @foreach ($assigned_members as $item)
            <tr>

                <td>
                    {{$item['member_id']}}
                </td>
                <td>
                    @if ($item['image'] != 'no')
                    <img src="{{asset('/images/pics/'.$item['image'])}}" class="img-fluid" style="height: 95px">
                    @else
                    no
                    @endif
                </td>
                <td>
                    {{$item['fullname']}}
                </td>
                <td>
                    {{$item['phone']}}
                </td>
                <td>
                    {{$item['address']}}
                </td>
                <td>
                    {{$item['username']}}
                </td>
                <td>
                    <div class="d-flex">
                        <a href="/members/view/{{$item['member_id']}}" class="btn btn-sm btn-success btn-float mr-2">
                            <i class="material-icons">visibility</i>
                        </a>
                        <a href="/schedule/trainer/{{$trainer->id}}/remove-member/{{$item['member_id']}}" class="btn btn-sm btn-danger btn-float mr-2">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
{{--!ENDS list  --}}

@endsection

@section('modal')
<div class="modal fade" id="modal--fir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- list  --}}
                <div class="card card-body mt-4 table-responsive">
                    <div class="title font-weight-bold">
                        Member Lists
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($members))
                            @foreach ($members as $item)
                            <tr>

                                <td>
                                    {{$item->id}}
                                </td>
                                <td>
                                    {{$item->username}}
                                </td>
                                <td>
                                    {{$item->fullname}}
                                </td>
                                <td>
                                    {{$item->phone}}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/schedule/trainer/{{$trainer->id}}/assign-member/{{$item->id}}"
                                            class="btn btn-float btn-sm btn-success mr-2">
                                            <i class="material-icons">check</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{--!ENDS list  --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection