@extends('layout.base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/members">Members</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$member->fullname}}</li>
    </ol>
</nav>



{{-- member detail  --}}
<div class="member-details mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card card-body table-responsive">
                <div class="h4 font-weight-bold">
                    General Detail
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Image</td>
                            <td>
                                @if ($member->image != 'no')
                                <img src="{{asset('/images/pics/'.$member->image)}}" class="img-fluid"
                                    style="height: 125px">
                                @else
                                no
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <td>Fullname</td>
                            <td>{{$member->fullname}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$member->phone}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$member->address}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="badge badge-pill badge-dark px-3 py-1">
                                    @if ($member->verified)
                                    Verified
                                    @else
                                    Unverified
                                    @endif
                                </span>
                                <a href="/members/change-status/{{$member->id}}" class="btn btn-sm btn-danger ml-2">
                                    Change Status
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Shifts</td>
                            <td>
                                @if ($member->shift_m)
                                <span class="badge badge-pill badge-dark px-3 py-1">
                                    Morning
                                </span>
                                @endif
                                @if ($member->shift_e)
                                <span class="badge badge-pill badge-dark px-3 py-1">
                                    Evening
                                </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="">
                    {{-- Update General Details --}}
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#modal--updategeneral">
                        Update General Details
                    </button>
                    {{-- Remove memeber --}}
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal--remove">
                        Remove Member Data From System
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--!ENDS member detail  --}}


{{-- body status  --}}
<div class="row justify-content-center mt-3">
    <div class="col-12 col-md-6">
        <div class="card card-body">
            <div class="h4 font-weight-bold">
                Body Status
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Chest</th>
                            <th>Stomach</th>
                            <th>Biceps</th>
                            <th>Thighs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@if (!empty($bodystatus)){{$bodystatus['weight']}}@endif</td>
                            <td>@if (!empty($bodystatus)){{$bodystatus['height']}}@endif</td>
                            <td>@if (!empty($bodystatus)){{$bodystatus['chest']}}@endif</td>
                            <td>@if (!empty($bodystatus)){{$bodystatus['stomach']}}@endif</td>
                            <td>@if (!empty($bodystatus)){{$bodystatus['biceps']}}@endif</td>
                            <td>@if (!empty($bodystatus)){{$bodystatus['thighs']}}@endif</td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#modal--updatebodystatus">
                        Update Body Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--!ENDS body status  --}}




{{-- plans  --}}
<div class="mt-4">
    <div class="row justify-content-center">

        {{-- nutrition plan  --}}

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">
                        Nutrition Plans
                    </h5>

                    <form action="/members/{{$member->id}}/nutrition-plan" method="POST">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Sunday</label>
                            <textarea name="sunday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for sunday">@if ( $nutrition_plans['sunday'] != 'no'){{$nutrition_plans['sunday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Monday</label>
                            <textarea name="monday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for monday">@if ( $nutrition_plans['monday'] != 'no'){{$nutrition_plans['monday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Tuesday</label>
                            <textarea name="tuesday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for tuesday">@if ( $nutrition_plans['tuesday'] != 'no'){{$nutrition_plans['tuesday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Wednesday</label>
                            <textarea name="wednesday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for wednesday">@if ( $nutrition_plans['wednesday'] != 'no'){{$nutrition_plans['wednesday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Thursday</label>
                            <textarea name="thursday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for thursday">@if ( $nutrition_plans['thursday'] != 'no'){{$nutrition_plans['thursday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Friday</label>
                            <textarea name="friday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for friday">@if ( $nutrition_plans['friday'] != 'no'){{$nutrition_plans['friday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Saturday</label>
                            <textarea name="saturday" type="text" class="form-control" rows="6"
                                placeholder="Enter nutrition plans for saturday">@if ( $nutrition_plans['saturday'] != 'no'){{$nutrition_plans['saturday']}}
                                                        @endif</textarea>
                        </div>
                        <button type="submit" class="btn btn-info text-white">Update Nutrition Plans</button>
                    </form>


                </div>
            </div>
        </div>
        {{--!ends nutrition plan  --}}

        {{-- Workout plan  --}}
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">
                        Workout Plans
                    </h5>

                    <form action="/members/{{$member->id}}/workout-plan" method="POST">


                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Sunday</label>
                            <textarea name="sunday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for sunday">@if ( $workout_plans['sunday'] != 'no'){{$workout_plans['sunday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Monday</label>
                            <textarea name="monday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for monday">@if ( $workout_plans['monday'] != 'no'){{$workout_plans['monday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Tuesday</label>
                            <textarea name="tuesday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for tuesday">@if ( $workout_plans['tuesday'] != 'no'){{$workout_plans['tuesday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Wednesday</label>
                            <textarea name="wednesday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for wednesday">@if ( $workout_plans['wednesday'] != 'no'){{$workout_plans['wednesday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Thursday</label>
                            <textarea name="thursday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for thursday">@if ( $workout_plans['thursday'] != 'no'){{$workout_plans['thursday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Friday</label>
                            <textarea name="friday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for friday">@if ( $workout_plans['friday'] != 'no'){{$workout_plans['friday']}}
                                                        @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Saturday</label>
                            <textarea name="saturday" type="text" class="form-control" rows="6"
                                placeholder="Enter workout plans for saturday">@if ( $workout_plans['saturday'] != 'no'){{$workout_plans['saturday']}}
                                                        @endif</textarea>
                        </div>
                        <button type="submit" class="btn btn-info text-white">Update Workout Plans</button>
                    </form>


                </div>
            </div>
        </div>
        {{--!ends Workout plan  --}}
    </div>
</div>
{{--!ENDS plans  --}}



@endsection

@section('modal')



{{-- model to remove member  --}}
<div class="modal fade" id="modal--remove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Member Data From System ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/members/remove" method="POST">
                    @csrf

                    <input name="member_id" type="hidden" value="{{$member->id}}">

                    <div class="mt-3">
                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        <button data-dismiss="modal" class="btn btn-sm btn-dark">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- update memebrs general information  --}}
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
                <form action="/members/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="user_id" type="hidden" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image (optional)</label>
                        <input name="image" type="file" class="form-control">
                        <small class="form-text text-muted">Old Image will be replaced with new above
                            Image.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name *</label>
                        <input name="fullname" type="text" class="form-control" required value="{{$member->fullname}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone *</label>
                        <input name="phone" type="text" class="form-control" required value="{{$member->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address *</label>
                        <input name="address" type="text" class="form-control" required value="{{$member->address}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shifts </label>
                        <div class="custom-control custom-checkbox mt-2">
                            <input name="shift_m" type="checkbox" class="custom-control-input" id="customCheck1"
                                @if($member->shift_m)
                            checked
                            @endif>
                            <label class="custom-control-label" for="customCheck1">Morning</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="shift_e" type="checkbox" class="custom-control-input" id="customCheck2"
                                @if($member->shift_e)
                            checked
                            @endif>
                            <label class="custom-control-label" for="customCheck2">Evening</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username *</label>
                        <input name="username" type="text" class="form-control" required value="{{$user->username}}">
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

{{-- update memebrs gbod  status --}}
<div class="modal fade" id="modal--updatebodystatus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Body Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/members/{{$member->id}}/update-body-status" method="POST">
                    @csrf 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Weight *</label>
                        <input name="weight" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['weight']}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Height *</label>
                        <input name="height" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['height']}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chest *</label>
                        <input name="chest" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['chest']}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stomach *</label>
                        <input name="stomach" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['stomach']}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Biceps *</label>
                        <input name="biceps" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['biceps']}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thighs *</label>
                        <input name="thighs" type="text" class="form-control" required value="@if (!empty($bodystatus)){{$bodystatus['thighs']}}@endif">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection