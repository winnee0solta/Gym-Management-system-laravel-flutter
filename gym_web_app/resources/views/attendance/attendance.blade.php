@extends('layout.base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Attendance</li>
    </ol>
</nav>

{{--select date  --}}
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card card-body">
            <form action="/attendance" method="get">
                <div class="form-group">
                    <label>Date</label>
                    <input name="date" required type="date" class="form-control" placeholder="Enter Date"
                        value="{{$date}}">
                </div>
                <button type="submit" class="btn btn-primary">Show Attendace Sheet</button>
            </form>
        </div>
    </div>
</div>

{{-- expansion  --}}
<div class="list-group mt-3" id="accordionOne">
    <div class="expansion-panel list-group-item">
        <a aria-controls="collapseOne" aria-expanded="true" class="expansion-panel-toggler collapsed"
            data-toggle="collapse" href="#collapseOne" id="headingOne">
            Attendance For Trainers
            <div class="expansion-panel-icon ml-3 text-black-secondary">
                <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
            </div>
        </a>
        <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionOne" id="collapseOne">
            <div class="expansion-panel-body">

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Attendance Status</th>
                                        @php
                                        $show_actions = false;
                                        $today = \Carbon\Carbon::today()->toDateString();
                                        if ($today==$date) {
                                        $show_actions = true;
                                        }
                                        @endphp
                                        @if ($show_actions)
                                        <th scope="col">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($trainer_attendances))
                                    @foreach ($trainer_attendances as $item)
                                    <tr>
                                        <th scope="row">{{$item['trainer_id']}}</th>
                                        <td>{{$item['fullname']}}</td>
                                        <td>{{$item['phone']}}</td>
                                        <td>{{$item['address']}}</td>
                                        <td>
                                            @if ($item['status'] == 'PRESENT')
                                            <span class="badge badge-pill badge-success px-3 py-1">PRESENT</span>
                                            @endif
                                            @if ($item['status'] == 'ABSENT')
                                            <span class="badge badge-pill badge-danger px-3 py-1">ABSENT</span>
                                            @endif
                                            @if ($item['status'] == 'NONE')
                                            <span class="badge badge-pill badge-dark px-3 py-1">NONE</span>
                                            @endif
                                        </td>
                                        @if ($show_actions)
                                        <td>
                                            <div class="d-flex">
                                                <a href="/attendance/trainer/{{$item['trainer_id']}}/PRESENT?date={{$date}}"
                                                    data-toggle="tooltip" data-placement="bottom" title="Make Present"
                                                    class="btn btn-float btn-success btn-sm" type="button">
                                                    <i class="material-icons">check</i>
                                                </a>
                                                <a href="/attendance/trainer/{{$item['trainer_id']}}/ABSENT?date={{$date}}"
                                                    data-toggle="tooltip" data-placement="bottom" title="Make Absent"
                                                    class="btn btn-float btn-danger btn-sm ml-1" type="button">
                                                    <i class="material-icons">close</i>
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>


                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="expansion-panel list-group-item">
        <a aria-controls="collapseTwo" aria-expanded="true" class="expansion-panel-toggler collapsed"
            data-toggle="collapse" href="#collapseTwo" id="headingTwo">
            Attendance For Members
            <div class="expansion-panel-icon ml-3 text-black-secondary">
                <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
            </div>
        </a>
        <div aria-labelledby="headingTwo" class="collapse show" data-parent="#accordionOne" id="collapseTwo">
            <div class="expansion-panel-body">

                   <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Attendance Status</th>
                                        @php
                                        $show_actions = false;
                                        $today = \Carbon\Carbon::today()->toDateString();
                                        if ($today==$date) {
                                        $show_actions = true;
                                        }
                                        @endphp
                                        @if ($show_actions)
                                        <th scope="col">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($member_attendances))
                                    @foreach ($member_attendances as $item)
                                    <tr>
                                        <th scope="row">{{$item['member_id']}}</th>
                                        <td>{{$item['fullname']}}</td>
                                        <td>{{$item['phone']}}</td>
                                        <td>{{$item['address']}}</td>
                                        <td>
                                            @if ($item['status'] == 'PRESENT')
                                            <span class="badge badge-pill badge-success px-3 py-1">PRESENT</span>
                                            @endif
                                            @if ($item['status'] == 'ABSENT')
                                            <span class="badge badge-pill badge-danger px-3 py-1">ABSENT</span>
                                            @endif
                                            @if ($item['status'] == 'NONE')
                                            <span class="badge badge-pill badge-dark px-3 py-1">NONE</span>
                                            @endif
                                        </td>
                                        @if ($show_actions)
                                        <td>
                                            <div class="d-flex">
                                                <a href="/attendance/member/{{$item['member_id']}}/PRESENT?date={{$date}}"
                                                    data-toggle="tooltip" data-placement="bottom" title="Make Present"
                                                    class="btn btn-float btn-success btn-sm" type="button">
                                                    <i class="material-icons">check</i>
                                                </a>
                                                <a href="/attendance/member/{{$item['member_id']}}/ABSENT?date={{$date}}"
                                                    data-toggle="tooltip" data-placement="bottom" title="Make Absent"
                                                    class="btn btn-float btn-danger btn-sm ml-1" type="button">
                                                    <i class="material-icons">close</i>
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>


                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{--!ENDS expansion  --}}




@endsection