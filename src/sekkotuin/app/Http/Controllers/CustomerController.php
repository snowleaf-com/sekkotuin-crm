<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
  {
    $customers = Customer::select(
        'id',
        DB::raw("CONCAT(last_name, ' ', first_name) AS full_name"),
        DB::raw("CONCAT(last_name_kana, ' ', first_name_kana) AS full_name_kana"),
        'created_at'
    )->paginate(10);
    // $customers2 = Customer::select(
    //     'id',
    //     DB::raw("CONCAT(last_name, ' ', first_name) AS full_name"),
    //     DB::raw("CONCAT(last_name_kana, ' ', first_name_kana) AS full_name_kana"),
    //     'created_at'
    // )->get();
      /* TODO: historiesテーブルとリレーションし、最終来院日を渡す */
    
    // dd($customers, $customers2);
    return Inertia::render('Customers/Index', [
      'customers' => $customers,
    ]);
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
