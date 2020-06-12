<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

use App\Models\Customer;
class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.pengaturan')->with([
            'user' => Auth::guard("web_customers")->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $dataInput = $request->all();
        if ($request->has('profil')) {
            Customer::where('id', $id)->update(['nama' => $request->nama, 'email' => $request->email, 'no_hp' => $request->no_hp]);
            return redirect()->back()->withSuccess("Berhasil memperbarui profil");
        }
        elseif ($request->has('ubah_password')){
            if (Hash::check($request->password_lama, Customer::find($id)->password)) {
                if ($request->password_baru != $request->password_konfirmasi) return redirect()->back()->withError("Password konfirmasi tidak sesuai");
                $user = Customer::find($id);
                $user->password = bcrypt($request->password_baru);
                $user->save();
                return redirect()->back()->withSuccess("Berhasil memperbarui password");
            }
            else {
                return redirect()->back()->withError("Password tidak sesuai");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
