@extends('layout.base')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/payment">Payments</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$member->fullname}}</li>
    </ol>
</nav>

{{-- expiration_date --}}
<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <div class="card card-body">

            <div class="h4">
                Expiration Date <span class="badge badge-pill badge-danger px-3 py-1">{{$member->expiration_date}}</span>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                    data-target="#modal--updateexpdate">
                    Update date
                </button>
            </div>

        </div>
    </div>
</div>
{{--!ENDS expiration_date --}}

<button type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#modal--addtransaction">
    Add Payment transaction
</button>

{{-- list  --}}
<div class="card card-body mt-4 table-responsive">
    <div class="title font-weight-bold">
        Payment Transactions
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>  
                <th>Date</th>  
                <th>Amount</th> 
                <th>Note</th>  
            </tr>
        </thead>
        <tbody>
            @if (!empty($payments))
            @foreach ($payments as $item)
            <tr>

                <td>
                    {{$item->id}}
                </td> 
                <td>
                    {{$item->created_at->format('Y/m/d')}}
                </td>
                <td>
                   Rs {{$item->amount}}
                </td> 
                <td>
                    {{$item->note}}
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

{{-- //update expiraiton date for member / --}}
<div class="modal fade" id="modal--updateexpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Expiration Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/payment/update-expiration-date/{{$member->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Date</label>
                        <input name="date" required type="date" class="form-control" placeholder="Enter Date" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- add payment transaction  --}}
<div class="modal fade" id="modal--addtransaction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/payment/add-transaction/{{$member->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Amount</label>
                        <input name="amount" required type="number" class="form-control" placeholder="Enter amount" >
                    </div>
                    <div class="form-group">    
                        <label>Remarks</label>
                        <textarea name="note" required  type="text" class="form-control" ></textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection