@extends('layout.base')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Notificaitons</li>
    </ol>
</nav>


{{-- notificaitons  --}}
<div class="card card-body mt-4 table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Status</th> --}}
                <th>Full Name</th>
                <th>Type</th>
                <th>Notice</th>
                <th>Sent at</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($notifications))
            @foreach ($notifications as $item)
            @php
            $fullname = '';
            //get user
            $user = \App\Models\User::find($item->user_id);
            if ($user->type == 'member') {
            $member = \App\Models\Member::where('user_id',$item->user_id)->first();
            $fullname = $member->fullname;
            }
            if ($user->type == 'trainer') {
            $trainer = \App\Models\Trainers::where('user_id',$item->user_id)->first();
            $fullname = $trainer->fullname;
            }
            @endphp
            <tr>

                <td>
                    {{$item->id}}
                </td>
                {{-- <td>
                    @if ($item->seen)
                    Seen
                    @else
                    Unseen
                    @endif
                </td> --}}
                <td>
                    {{$fullname}}
                </td>
                <td>
                    {{$user->type}}
                </td>
                <td>
                    {{$item->notice}}
                </td>
                <td>
                    {{$item->created_at->format('Y-m-d')}}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


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

    @if (!empty($notifications))
    {!! $notifications->links() !!}
    @endif

</div>
{{--ENDS paginations  --}}

@endsection