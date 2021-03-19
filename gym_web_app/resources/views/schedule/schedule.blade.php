@extends('layout.base')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Schedule</li>
    </ol>
</nav>


{{-- tabs  --}}
<div class="card card-body">
    <ul class="nav nav-justified nav-tabs" id="justifiedTab" role="tablist">
        <li class="nav-item">
            <a aria-controls="home" aria-selected="true" class="nav-link active" data-toggle="tab" href="#home"
                id="home-tab" role="tab">Trainers</a>
        </li>
        <li class="nav-item">
            <a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab" href="#profile"
                id="profile-tab" role="tab">Members</a>
        </li>
    </ul>
    <div class="tab-content" id="justifiedTabContent">
        <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home" role="tabpanel">
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
                                    <a href="/schedule/trainer/{{$item->id}}" class="btn btn-float btn-sm btn-success mr-2">
                                        <i class="material-icons">visibility</i>
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
        <div aria-labelledby="profile-tab" class="tab-pane fade" id="profile" role="tabpanel">
            {{-- list  --}}
            <div class="card card-body mt-4 table-responsive">
                <div class="title font-weight-bold">
                    Member Lists
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
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
                        @if (!empty($members))
                        @foreach ($members as $item)
                        <tr>
            
                            <td>
                                {{$item->id}}
                            </td>
                            <td>
                                @if ($item->image != 'no')
                                <img src="{{asset('/images/pics/'.$item->image)}}" class="img-fluid" style="height: 125px">
                                @else
                                no
                                @endif
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
                                    <a href="/schedule/member/{{$item->id}}" class="btn btn-float btn-sm btn-success mr-2">
                                        <i class="material-icons">visibility</i>
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
    </div>
</div>
{{--!ENDS tabs  --}}

@endsection