<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $members = DB::table('members')
            ->join('users', 'users.id', '=', 'members.user_id')
            ->select('members.*', 'users.username')
            ->paginate(20);
        return view('payments.payments', compact(
            'members'
        ));
    }
    public function singleMemberPayments($member_id)
    {
        $member = Member::find($member_id);
        if ($member) {
 
            $user = User::find($member->user_id);

            $payments = Payments::where('member_id',$member->id)->get();

            return view('payments.single', compact(
                'payments',
                'member',
                'user'
            ));
        }

        return redirect('/payment');
    }
    public function updateMemberExpirationDate($member_id,Request $request)
    {

        $member = Member::find($member_id);
        if ($member) { 
            $user = User::find($member->user_id);

             $member->expiration_date = $request->date;
            $member->save();

            return redirect('payment/view/'.$member->id);
        }

        return redirect('/payment');
    }
    public function addMemberPaymentTransaction($member_id,Request $request)
    {

        $member = Member::find($member_id);
        if ($member) { 
            $user = User::find($member->user_id);
            
            Payments::create([
                'member_id'=>$member->id,
                'amount' => $request->amount,   
                'note' => $request->note, 
            ]);

            return redirect('payment/view/'.$member->id);
        }

        return redirect('/payment');
    }
}
