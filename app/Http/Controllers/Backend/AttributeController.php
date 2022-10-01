<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Image;
use Session;
use App\Helpers\Classes\Combinations;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::latest()->get();
        return view('backend.attribute.index', compact('attributes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function combination(){
        $options = array (
            array("S","M", "L"),
            array("Black","White"),
            array("A","B"),
          );

        $combinations = Combinations::makeCombinations($options);

        $data = [];
        foreach ($combinations as $combination) {
            $data[implode(', ', $combination)] = rand(10, 100);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.attribute.create');
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
            'name' => 'required',
        ]);

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->created_at = Carbon::now();

        $attribute->save();

        Session::flash('success','Attribute Inserted Successfully');
        return redirect()->route('attribute.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        $values = AttributeValue::where('attribute_id', $id)->get();
        return view('backend.attribute.show',compact('attribute', 'values'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('backend.attribute.edit',compact('attribute'));
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
        $attribute = Attribute::find($id);

        // Attribute table update
        $attribute->name = $request->name;
        $attribute->save();

        $notification = array(
            'message' => 'Attribute Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('attribute.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        $notification = array(
            'message' => 'Attribute Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function attribute_detail($id)
    {
        
    }


    // Color All
    // public function color_index()
    // {   
    //     $colors = Color::latest()->get();
    //     return view('backend.color.index',compact('colors'));
    // }

    // // Color create
    // public function color_create()
    // {   
    //     return view('backend.color.create');
    // }

    // Value Store
    public function value_store(Request $request)
    {
        $this->validate($request,[
            'value' => 'required',
        ]);

        $value = new AttributeValue();
        $value->attribute_id = $request->attribute_id;
        $value->value = $request->value;
        $value->created_at = Carbon::now();

        $value->save();

        Session::flash('success','Value Inserted Successfully');
        return redirect()->back();
    }

    // // Color Edit
    // public function color_edit($id)
    // {
    //     $color = Color::findOrFail($id);
    //     return view('backend.color.edit',compact('color'));
    // }

    // // Color UpadateColor
    // public function color_update(Request $request, $id)
    // {
    //     $color = Color::find($id);

    //     // Attribute table update
    //     $color->name = $request->name;
    //     $color->color_code = $request->color_code;
    //     $color->save();

    //     $notification = array(
    //         'message' => 'Color Updated Successfully.',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('color.index')->with($notification);
    // }

    // Attribute Value Delete
    public function value_destroy($id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->delete();

        $notification = array(
            'message' => 'Attribute Value Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function value_active($id){
        $attribute_value = AttributeValue::find($id);
        $attribute_value->status = 1;
        $attribute_value->save();

        Session::flash('success','Attribute Value Active Successfully.');
        return redirect()->back();
    }

    public function value_inactive($id){
        $attribute_value = AttributeValue::find($id);
        $attribute_value->status = 0;
        $attribute_value->save();

        Session::flash('warning','Attribute Value Inactive Successfully.');
        return redirect()->back();
    }
}
