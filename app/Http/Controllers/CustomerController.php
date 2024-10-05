<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    const PATH_VIEW = 'customer.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::query()->latest('id')->paginate(5);
//        dd($data);

        return view(self::PATH_VIEW . __FUNCTION__, compact([
            'data',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => [
                'required',
                'max:20',
                Rule::unique('customers')
            ],
            'address' => 'required|min:3|max:255',
            'email' => 'required|email|max:100',
            'is_active' => [
                'nullable',
                Rule::in([0, 1])
            ],
        ]);

        try {

            Customer::query()->create($data);

            return redirect()->route('customers.index')->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact([
            'customer',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact([
            'customer',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => [
                'required',
                'max:20',
                Rule::unique('customers')->ignore($customer)
            ],
            'address' => 'required|min:3|max:255',
            'email' => 'required|email|max:100',
            'is_active' => [
                'nullable',
                Rule::in([0, 1])
            ],
        ]);

        try {
            $data['is_active'] ??= 0;
            $customer->update($data);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            return redirect()->route('customers.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', $th->getMessage());
        }
    }

    public function forceDestroy(Customer $customer)
    {
        try {
            $customer->forceDelete();

            return redirect()->route('customers.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', $th->getMessage());
        }
    }
}
