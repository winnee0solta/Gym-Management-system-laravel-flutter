@extends('layout.base')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Payments</li>
    </ol>
</nav>


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
                    <div class="d-flex">
                        <a href="/payment/view/{{$item->id}}" class="btn btn-float btn-sm btn-success mr-2">
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
    {!! $members->links() !!}
    @endif

</div>
{{--ENDS paginations  --}}


@endsection