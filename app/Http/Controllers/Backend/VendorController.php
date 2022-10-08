<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Hash;
use Image;
use Session;
use Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('backend.vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create');
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
            'shop_name' => 'required',
            'fb_url' => 'required',
            'bank_account' => 'required',
            'bank_name' => 'required',
            'holder_name' => 'required',
            'branch_name' => 'required',
            'routing_name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'shop_profile' => 'required',
        ]);

        if($request->hasfile('shop_profile')){
            $image = $request->file('shop_profile');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/vendor/'.$name_gen);
            $shop_profile = 'upload/vendor/'.$name_gen; 
        }else{
            $shop_profile = '';
        }

        if($request->hasfile('shop_cover')){
            $image = $request->file('shop_cover');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/vendor/'.$name_gen);
            $shop_cover = 'upload/vendor/'.$name_gen; 
        }else{
            $shop_cover = '';
        }

        if($request->hasfile('nid')){
            $image = $request->file('nid');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/vendor/'.$name_gen);
            $nid = 'upload/vendor/'.$name_gen; 
        }else{
            $nid = '';
        }

        if($request->hasfile('trade_license')){
            $image = $request->file('trade_license');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/vendor/'.$name_gen);
            $trade_license = 'upload/vendor/'.$name_gen; 
        }else{
            $trade_license = '';
        }

       Vendor::insert([
            'shop_name' => $request->shop_name,
            'fb_url' => $request->fb_url,
            'bank_account' => $request->bank_account,
            'bank_name' => $request->bank_name,
            'holder_name' => $request->holder_name,
            'branch_name' => $request->branch_name,
            'routing_name' => $request->routing_name,
            'address' => $request->address,
            'commission' => $request->commission,
            'description' => $request->description,
            'shop_profile' => $shop_profile,
            'shop_cover' => $shop_cover,
            'nid' => $nid,
            'trade_license' => $trade_license,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        Session::flash('success','Vendor Inserted Successfully');
        return redirect()->route('vendor.index');
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
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit',compact('vendor'));
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

        $vendor = Vendor::find($id);

        //Shop Profile Photo Update
        if($request->hasfile('shop_profile')){
            try {
                if(file_exists($vendor->shop_profile)){
                    unlink($vendor->shop_profile);
                }
            } catch (Exception $e) {
                
            }
            $shop_profile = $request->shop_profile;
            $shop_pro = time().$shop_profile->getClientOriginalName();
            $shop_profile->move('upload/vendor/',$shop_pro);
            $vendor->shop_profile = 'upload/vendor/'.$shop_pro;
        }else{
            $shop_pro = '';
        }

        //Shop Cover Photo Update
        if($request->hasfile('shop_cover')){
            try {
                if(file_exists($vendor->shop_cover)){
                    unlink($vendor->shop_cover);
                }
            } catch (Exception $e) {
                
            }
            $shop_cover = $request->shop_cover;
            $shop_cover_photo = time().$shop_cover->getClientOriginalName();
            $shop_cover->move('upload/vendor/',$shop_cover_photo);
            $vendor->shop_cover = 'upload/vendor/'.$shop_cover_photo;
        }else{
            $shop_cover_photo = '';
        }

        // Nid Card Update
        if($request->hasfile('nid')){
            try {
                if(file_exists($vendor->nid)){
                    unlink($vendor->nid);
                }
            } catch (Exception $e) {
                
            }
            $nid = $request->nid;
            $nid_photo = time().$nid->getClientOriginalName();
            $nid->move('upload/vendor/',$nid_photo);
            $vendor->nid = 'upload/vendor/'.$nid_photo;
        }else{
            $nid_photo = '';
        }

        // Trade License Update
        if($request->hasfile('trade_license')){
            try {
                if(file_exists($vendor->trade_license)){
                    unlink($vendor->trade_license);
                }
            } catch (Exception $e) {
                
            }
            $trade_license = $request->trade_license;
            $trade_photo = time().$trade_license->getClientOriginalName();
            $trade_license->move('upload/vendor/',$trade_photo);
            $vendor->trade_license = 'upload/vendor/'.$trade_photo;
        }else{
            $trade_photo = '';
        }

        
        // Vendor table update
        $vendor->shop_name = $request->shop_name;
        $vendor->fb_url = $request->fb_url;
        $vendor->bank_account = $request->bank_account;
        $vendor->bank_name = $request->bank_name;
        $vendor->holder_name = $request->holder_name;
        $vendor->routing_name = $request->routing_name;
        $vendor->address = $request->address;
        $vendor->commission = $request->commission;
        $vendor->description = $request->description;
        if($request->status == Null){
            $request->status = 0;
        }
        $vendor->status = $request->status;
        $vendor->created_by = Auth::guard('admin')->user()->id;

        $vendor->save();

        Session::flash('success','Vendor Update Successfully');
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        try {
            if(file_exists($vendor->shop_cover)){
                unlink($vendor->shop_cover);
            }
        } catch (Exception $e) {
            
        }
        try {
            if(file_exists($vendor->shop_profile)){
                unlink($vendor->shop_profile);
            }
        } catch (Exception $e) {
            
        }
        try {
            if(file_exists($vendor->nid)){
                unlink($vendor->nid);
            }
        } catch (Exception $e) {
            
        }
        try {
            if(file_exists($vendor->trade_license)){
                unlink($vendor->trade_license);
            }
        } catch (Exception $e) {
            
        }
        
        $vendor->delete();

        $notification = array(
            'message' => 'Vendor Deleted Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $vendor = Vendor::find($id);
        $vendor->status = 1;
        $vendor->save();

        Session::flash('success','Vendor Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $vendor = Vendor::find($id);
        $vendor->status = 0;
        $vendor->save();

        Session::flash('warning','Vendor Inactive Successfully.');
        return redirect()->back();
    }

}
