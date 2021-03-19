@extends('layout.base')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    {{-- counter cards --}}
    <div class="row justify-content-center my-3">
        <div class="col-md-3 mt-2">
            <div class="card card-body text-center" style="background-color:#fec107;color:white;">
                <div class="title font-weight-bold h3">
                    <i class="material-icons mr-3">group</i>
                    Total Members
                </div>
                <div class="navdrawer-divider"></div>
                <div class="counter h4">
                    {{ $member_count }}
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-2">
            <div class="card card-body text-center" style="background-color:#3e99e0;color:white;">
                <div class="title font-weight-bold h3">
                    <i class="material-icons mr-3">group</i>
                    New Members
                </div>
                <div class="navdrawer-divider"></div>
                <div class="counter h4">
                    {{ $new_member_count }}
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-2">
            <div class="card card-body text-center" style="background-color:#8bc24a;color:white;">
                <div class="title font-weight-bold h3">
                    <i class="material-icons mr-3">group</i>
                    Total Trainers
                </div>
                <div class="navdrawer-divider"></div>
                <div class="counter h4">
                    {{ $trainer_count }}
                </div>
            </div>
        </div>
    </div>
    {{-- !ENDS counter cards --}}



    <div class="row pt-3">
        <div class="col-md-6 col-12">
            <div class="card card-body">
                <div class="text-center title font-weight-bold h3">
                    Member Attendance
                </div>
                <canvas id="memberAttChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card card-body">
                <div class="text-center title font-weight-bold h3">
                    Trainer Attendance
                </div>
                <canvas id="traineeAttChart" height="200"></canvas>
            </div>
        </div>
    </div>



    <div class="absent-trainer">
        {{-- list --}}
        <div class="card card-body mt-4 table-responsive">
            <div class="h3 title font-weight-bold">
                Absent Trainer Lists
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
                    @if (!empty($absent_trainers))
                        @foreach ($absent_trainers as $item)
                            <tr>

                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td>
                                    {{ $item->address }}
                                </td>
                                <td>
                                    {{ $item->username }}
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
                                        <a href="/trainers/view/{{ $item->id }}" class="btn btn-sm btn-success mr-2"
                                            data-toggle="tooltip" title="View Trainer">
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
        {{-- !ENDS list --}}
    </div>


    <div class="absent-members">
        {{-- list --}}
        <div class="card card-body mt-4 table-responsive">
            <div class="h3 title font-weight-bold">
              Absent  Member Lists
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($absent_members))
                        @foreach ($absent_members as $item)
                            <tr>

                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    @if ($item->image != 'no')
                                        <img src="{{ asset('/images/pics/' . $item->image) }}" class="img-fluid"
                                            style="height: 125px">
                                    @else
                                        no
                                    @endif
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td>
                                    {{ $item->address }}
                                </td>
                                <td>
                                    {{ $item->user->username }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/members/view/{{ $item->id }}" class="btn btn-sm btn-success mr-2"
                                            data-toggle="tooltip" title="View Member">
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
        {{-- !ENDS list --}}
    </div>




    <div>


    </div>


@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>


    <script>
        var myChart = new Chart(document.getElementById('memberAttChart'), {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent', ],
                datasets: [{
                    label: 'Attendance',
                    data: [{{ $member_present_count }}, {{ $member_absent_count }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
        var myChart2 = new Chart(document.getElementById('traineeAttChart'), {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent', ],
                datasets: [{
                    label: 'Attendance',
                    data: [{{ $trainee_present_count }}, {{ $trainee_absent_count }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
        integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
        crossorigin="anonymous" />
@endsection
