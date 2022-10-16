<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use Session;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_heads = AccountHead::OrderBy('id', 'ASC')->get();
        //$account_heads = AccountHead::where('status', 1)->latest()->get();

        return view('backend.accounts.heads', compact('account_heads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function heads()
    {
        $account_heads = AccountHead::OrderBy('id', 'ASC')->get();
        //$account_heads = AccountHead::where('status', 1)->latest()->get();

        return view('backend.accounts.heads', compact('account_heads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ledgers()
    {
        $account_ledgers = AccountLedger::OrderBy('id', 'ASC')->get();
        //$account_heads = AccountHead::where('status', 1)->latest()->get();

        return view('backend.accounts.ledgers', compact('account_ledgers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accounts.create_head');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        if($request->status == Null){
            $request->status = 0;
        }

        $account_head = new AccountHead();
        $account_head->title = $request->title;
        $account_head->slug = $slug;
        $account_head->status = $request->status;
        $account_head->save();

        Session::flash('success','New Account Head created Successfully.');

        return redirect()->route('accounts.heads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function head_destroy($id)
    {
        $head = AccountHead::find($id);
        $head->delete();
        Session::flash('success','Account Head Deleted Successfully.');
        return redirect()->back();
    }

    public function ledger_destroy($id)
    {
        $head = AccountHead::find($id);
        $head->delete();
        Session::flash('success','Account Head Deleted Successfully.');
        return redirect()->back();
    }

    public function change_status($id){
        $head = AccountHead::find($id);
        if($head){
            if($head->status == 1){
                $head->status = 0;
            }else{
                $head->status = 1;
            }
            $head->save();
        }        

        Session::flash('success','Status Updated Successfully.');
        return redirect()->back();
    }
}
