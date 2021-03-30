<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function search(Request $request)
    {
        try {
            //code...
            $suppliers = Supplier::where('company_name', 'LIKE', '%'.$request->keyword.'%')->get();
            return response(['suppliers' => $suppliers], 200);
        } catch (\Throwable $th) {
            return response(['suppliers' => null], 500);
        }
    }
    
    public function index()
    {
            $suppliers = Supplier::where('is_active', true)->get();
            return view('admin.supplier.index',compact('suppliers'));
    }

    public function create()
    {
            return view('admin.supplier.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:150',
            'company_name' => 'required',
            'email' => 'required|email|max:255',
            'tax_number' => '',
            'phone_number' => 'required',
            'address' => '',
            'city' => '',
        ]);

        $suppliers = new Supplier();
       
        $suppliers->name = $request->name;
        $suppliers->company_name = $request->company_name;
        $suppliers->email = $request->email;
        $suppliers->tax_number = $request->tax_number;
        $suppliers->phone_number = $request->phone_number;
        $suppliers->address = $request->address;
        $suppliers->city = $request->city;
        $suppliers['is_active'] = true;
        $suppliers->save();

        $notification = array(
            'messege' => 'Fournisseur ajoutée avec succès !',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id)
    {
            $suppliers = Supplier::where('id',$id)->first();
            return view('admin.supplier.edit',compact('suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:150',
            'company_name' => 'required',
            'email' => 'required|email|max:255',
            'tax_number' => '',
            'phone_number' => 'required',
            'address' => '',
            'city' => '',
        ]);

        $suppliers = Supplier::findOrFail($id);
        $suppliers->name = $request->name;
        $suppliers->company_name = $request->company_name;
        $suppliers->email = $request->email;
        $suppliers->tax_number = $request->tax_number;
        $suppliers->phone_number = $request->phone_number;
        $suppliers->address = $request->address;
        $suppliers->city = $request->city;
        $suppliers['is_active'] = true;
        $suppliers->update();

        $notification = array(
            'messege' => 'Fournisseur actualisé avec succès!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }



    public function destroy($id)
    {
        $suppliers = Supplier::findOrFail($id);
        $suppliers->is_active = false;
        $suppliers->save();

        $notification = array(
            'messege' => 'Fournisseur supprimée avec succès !',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function importSupplier(Request $request)
    {
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
        $filename =  $upload->getClientOriginalName();
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
                continue;
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
           $data= array_combine($escapedHeader, $columns);

           $supplier = Supplier::firstOrNew(['company_name'=>$data['companyname']]);
           $supplier->name = $data['name'];
           $supplier->tax_number = $data['taxnumber'];
           $supplier->email = $data['email'];
           $supplier->phone_number = $data['phonenumber'];
           $supplier->address = $data['address'];
           $supplier->city = $data['city'];
           $supplier->is_active = true;
           $supplier->save();
           $notification = array(
            'messege' => 'Fournisseur importée avec succès!',
            'alert' => 'success'
        );           
        }
        return redirect('admin.supplier')->with('notification', $notification); 
    }
}
