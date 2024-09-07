<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\DataPaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::latest()->get();
        $session = session()->get('locale');
        $lang = Language::where('abbreviations', $session)->first();
        return view('admin.dashboard.payment_methods.index', compact('payment_methods', 'session', 'lang'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session = session()->get('locale');
        $lang = Language::where('abbreviations',$session)->first();
        $categories = Translation::where('language_id', $lang->id)->where('model_type', 'Category')->where('attribute','name')->get();
        return view('admin.dashboard.payment_methods.create',compact('categories','session','lang'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status'=> 'required|string',
            'name'=> 'required|string',
        ]);


        $allDataExceptimage = $request->except('image');
        $paymentmethod = PaymentMethod::create($allDataExceptimage);
        $image= $request->file('image');
        if(isset($image))
        {
            $uploadedimage = $paymentmethod->addMediaFromRequest('image')->toMediaCollection('image');
            $paymentmethod->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }

        $attributes=$request->attribute;
        $translates=$request->translate;

        for($i=0;$i<sizeof($attributes);$i++)
        {
            $trans= DataPaymentMethod::where('model_id',$paymentmethod->id)->where('model_type',"PaymentMethod")
           ->where('attribute',$attributes[$i])
            ->where('translate',$translates[$i])->first();
            if($trans==null){
                DataPaymentMethod::create([
                    'model_id'=>$paymentmethod->id,
                    'model_type'=>"PaymentMethod",
                    'attribute'=>$attributes[$i],
                    'translate'=>$translates[$i]
                ]);

            }else
            {
                continue;
            }
    }
    return redirect()->route('payment-methods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        $translations = Translation::where('model_type','PaymentMethod')->where('model_id',$paymentMethod->id)->get();
        $language = Language::all();
        $session = session()->get('locale');
        $lang = Language::where('abbreviations',$session)->first();
        $categories = Translation::where('language_id', $lang->id)->where('model_type', 'Category')->where('attribute','name')->get();


        return view('admin.dashboard.payment_methods.edit',compact('paymentMethod','translations'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'status'=> 'required|string',
            'name'=> 'required|string',
        ]);

        $paymentmethod = PaymentMethod::findOrFail($id);

        // Update post except for flag
        $paymentmethod->update($request->except('image'));

        $image = $request->file('image');
        if (isset($image)) {
            // If there's a new image, update it
            $oldimage = $paymentmethod->media;
            $oldimage[0]->delete();
            $uploadedimage = $paymentmethod->addMediaFromRequest('image')->toMediaCollection('image');
            $paymentmethod->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }

        $attributes = $request->attribute;
        $translates = $request->translate;

            $trans = DataPaymentMethod::where('model_id', $paymentmethod->id)
                ->where('model_type', "PaymentMethod")
                ->where('attribute', $attributes)
                ->first();

            if ($trans) {
                // If the DataPaymentMethod exists, update it
                $trans->update([
                    'attribute' => $attributes,
                    'translate' => $translates,
                ]);
            }else
            {
                DataPaymentMethod::create([
                    'model_id'=>$paymentmethod->id,
                    'model_type'=>"PaymentMethod",
                    'attribute'=>$attributes,
                    'translate'=>$translates
                ]);
            }



        return redirect()->route('payment-methods.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $paymentmethod =  PaymentMethod::find($id);
        $paymentmethod->clearMediaCollection('image');
        DataPaymentMethod::where('model_id', $paymentmethod->id)->where('model_type', "PaymentMethod")->delete();
        $paymentmethod->delete();
        return redirect()->route('payment-methods.index');

    }
}