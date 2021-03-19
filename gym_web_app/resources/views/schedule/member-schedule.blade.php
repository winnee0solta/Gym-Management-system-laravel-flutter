@extends('layout.base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/schedule">Schedule</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$member->fullname}}</li>
    </ol>
</nav>

 
 
<div class="list-group" id="accordionOne">
    {{-- morning schedule pannerl  --}}
    @if ($member->shift_m)
        
    <div class="expansion-panel list-group-item">
        <a aria-controls="collapseOne" aria-expanded="false" class="expansion-panel-toggler collapsed"
            data-toggle="collapse" href="#collapseOne" id="headingOne">
            Morning Schedules
            <div class="expansion-panel-icon ml-3 text-black-secondary">
                <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
            </div>
        </a>
        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapseOne">
            <div class="expansion-panel-body">
                
               <form action="/schedule/member/{{$member->id}}/morning" method="POST"> 
             
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Sunday</label>
                    <textarea name="sunday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for sunday">@if ( $morning_schedules['sunday'] != 'no'){{$morning_schedules['sunday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Monday</label>
                    <textarea name="monday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for monday">@if ( $morning_schedules['monday'] != 'no'){{$morning_schedules['monday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Tuesday</label>
                    <textarea name="tuesday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for tuesday">@if ( $morning_schedules['tuesday'] != 'no'){{$morning_schedules['tuesday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Wednesday</label>
                    <textarea name="wednesday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for wednesday">@if ( $morning_schedules['wednesday'] != 'no'){{$morning_schedules['wednesday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Thursday</label>
                    <textarea name="thursday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for thursday">@if ( $morning_schedules['thursday'] != 'no'){{$morning_schedules['thursday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Friday</label>
                    <textarea name="friday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for friday">@if ( $morning_schedules['friday'] != 'no'){{$morning_schedules['friday']}}
                                                                    @endif</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark">Saturday</label>
                    <textarea name="saturday" type="text" class="form-control" rows="6"
                        placeholder="Enter Schedules for saturday">@if ( $morning_schedules['saturday'] != 'no'){{$morning_schedules['saturday']}}
                                                                    @endif</textarea>
                </div>
                <button type="submit" class="btn btn-info text-white">Update Morning Schedules</button>
            </form>
                
            </div>
        </div>
    </div>
    @endif
    {{-- evening schedule pannerl  --}}
    @if ($member->shift_e)
        
    <div class="expansion-panel list-group-item">
        <a aria-controls="collapseTwo" aria-expanded="false" class="expansion-panel-toggler collapsed"
            data-toggle="collapse" href="#collapseTwo" id="headingTwo">
            Evening Schedules
            <div class="expansion-panel-icon ml-3 text-black-secondary">
                <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
            </div>
        </a>
        <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionOne" id="collapseTwo">
            <div class="expansion-panel-body">
                <form action="/schedule/member/{{$member->id}}/evening" method="POST">
                
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Sunday</label>
                        <textarea name="sunday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for sunday">@if ( $evening_schedules['sunday'] != 'no'){{$evening_schedules['sunday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Monday</label>
                        <textarea name="monday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for monday">@if ( $evening_schedules['monday'] != 'no'){{$evening_schedules['monday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Tuesday</label>
                        <textarea name="tuesday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for tuesday">@if ( $evening_schedules['tuesday'] != 'no'){{$evening_schedules['tuesday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Wednesday</label>
                        <textarea name="wednesday" type="text" class="form-control" rows="6"
                            placeholder="Enter Schedules for wednesday">@if ( $evening_schedules['wednesday'] != 'no'){{$evening_schedules['wednesday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Thursday</label>
                        <textarea name="thursday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for thursday">@if ( $evening_schedules['thursday'] != 'no'){{$evening_schedules['thursday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Friday</label>
                        <textarea name="friday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for friday">@if ( $evening_schedules['friday'] != 'no'){{$evening_schedules['friday']}}
                                                                                    @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Saturday</label>
                        <textarea name="saturday" type="text" class="form-control" rows="6" placeholder="Enter Schedules for saturday">@if ( $evening_schedules['saturday'] != 'no'){{$evening_schedules['saturday']}}
                                                                                    @endif</textarea>
                    </div>
                    <button type="submit" class="btn btn-info text-white">Update Evening Schedules</button>
                </form>
            </div>
        </div>
    </div> 
    @endif
</div>


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