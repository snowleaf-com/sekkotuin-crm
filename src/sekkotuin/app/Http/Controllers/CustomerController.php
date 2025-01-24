<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
  {
    $keyword = $request->searchKeyword ?? '';
    $sort = $request->sortVal ?? '';

    $customers = Customer::searchByName($keyword)
    ->select(
        'id',
        DB::raw("CONCAT(last_name, ' ', first_name) AS full_name"),
        DB::raw("CONCAT(last_name_kana, ' ', first_name_kana) AS full_name_kana"),
        'created_at')
    ->when($sort === 'asc', function ($query) {
        $query->orderBy('created_at', 'asc')->orderBy('id', 'asc');
    }, function ($query) {
        $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    })
    ->paginate(10)
    ->withQueryString();

    // $customers->appends(['searchKeyword' => $keyword, 'sortVal' => $sort]);


    // $customers2 = Customer::select(
    //     'id',
    //     DB::raw("CONCAT(last_name, ' ', first_name) AS full_name"),
    //     DB::raw("CONCAT(last_name_kana, ' ', first_name_kana) AS full_name_kana"),
    //     'created_at'
    // )->get();
    
    /* TODO: historiesテーブルとリレーションし、最終来院日を渡す */
    
    // dd($customers);
    return Inertia::render('Customers/Index', [
      'customers' => $customers,
      'keyword' => $keyword,
      'sort' => $sort
    ]);
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        // dd($request->all());
        Customer::create([
            'last_name' => $request->last_name, 
            'first_name' => $request->first_name,
            'last_name_kana' => $request->last_name_kana, 
            'first_name_kana' => $request->first_name_kana, 
            'postcode' => $request->postcode, 
            'address' => $request->address, 
            'tel' => $request->tel, 
            'birth' => $request->birth, 
            'gender' => $request->gender, 
            'memo' => $request->memo, 
        ]);

        // return Inertia::render('Customers/Index', []);
        return to_route('customers.index')->with([
            'message' => '登録が完了しました！',
            'status' => 'success',
        ]);
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
        return Inertia::render('Customers/Edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'tel' => $request->tel,
            'birth' => $request->birth,
            'gender' => $request->gender,
            'memo' => $request->memo,
        ]);

        // return Inertia::render('Customers/Index', []);
        return to_route('customers.index')->with([
            'message' => '変更が完了しました！',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
