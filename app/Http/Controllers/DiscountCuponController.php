<?php

namespace App\Http\Controllers;

use App\Models\DiscountCupon;
use App\useCases\admin\CreateDiscountCuponAdmin;
use App\useCases\admin\UpdateDiscountCuponAdmin;
use Illuminate\Http\Request;

class DiscountCuponController extends Controller
{
    private CreateDiscountCuponAdmin $createDiscountCuponAdmin;
    private UpdateDiscountCuponAdmin $updateDiscountCuponAdmin;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->createDiscountCuponAdmin = new CreateDiscountCuponAdmin();
        $this->updateDiscountCuponAdmin = new UpdateDiscountCuponAdmin();
    }

    public function index()
    {
        $discountCupons = DiscountCupon::orderBy('active', 'desc')->paginate(10);
        return view('user.admin.discountCupon.discountCupons', compact('discountCupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.discountCupon.newDiscountCupon');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = $request->validate(['password'=>'required|string']);
        if(!auth()->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha inválida');
        }
        $credentials = $request->validate([
            'slug'=>'required|string|min:5|max:10',
            'amount'=> 'required|numeric|max:50',
            'minimum_amount'=>'required|numeric',

        ]);
        if (!$this->createDiscountCuponAdmin->execute($credentials)){
            return redirect()->back()->with('info', 'Erro ao salvar cupom');
        }
        return redirect()->route('admin.discountCupons');

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
    public function edit(string $id)
    {
        $discountCupon = DiscountCupon::findOrFail($id);
        return view('user.admin.discountCupon.updateDiscountCupon', compact('discountCupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $password = $request->validate(['password'=>'required|string']);

        if(!auth()->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha inválida');
        }
        $credentials = $request->validate([
            'slug'=>'required|string|min:5|max:10',
            'amount'=> 'required|numeric|max:50',
            'minimum_amount'=>'required|numeric',
            'active'=>'nullable',

        ]);
        if (!$this->updateDiscountCuponAdmin->execute($id, $credentials)){
            return redirect()->back()->with('info', 'Erro ao editar cupom');
        }
        return redirect()->route('admin.discountCupons');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
