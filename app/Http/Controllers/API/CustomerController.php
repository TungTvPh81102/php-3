<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::query()->latest('id')->paginate(5);

        return response()->json([
            'message' => 'Danh sách khách hàng',
            'data' => $data
        ], Response::HTTP_OK);
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
            $data = Customer::query()->create($data);

            return response()->json([
                'message' => 'Thêm khách hàng thành công',
                'data' => $data
            ], Response::HTTP_CREATED);

        } catch (\Throwable $th) {

            \Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'message' => $th->getMessage(),
            ]);

            return response()->json([
                'message' => 'Lỗi server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $customer = Customer::query()->find($id);

            if ($customer) {
                return response()->json([
                    'message' => 'Chi tiết khách hàng: ' . $customer->name,
                    'data' => $customer
                ], Response::HTTP_OK);
            }

            throw new \Exception('Không tìm thấy khách hàng');
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => [
                'required',
                'max:20',
                Rule::unique('customers')->ignore($id)
            ],
            'address' => 'required|min:3|max:255',
            'email' => 'required|email|max:100',
            'is_active' => [
                'nullable',
                Rule::in([0, 1])
            ],
        ]);

        $customer = Customer::query()->find($id);

        if (!$customer) {
            throw new \Exception('Không tìm thấy khách hàng');
        }

        try {
            $data['is_active'] ??= 0;
            $customer->update($data);

            return response()->json([
                'message' => 'Cập nhật thành công',
                'data' => $data
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            \Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'message' => $th->getMessage(),
            ]);

            return response()->json([
                'message' => 'Lỗi server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Customer::destroy($id);

            return response()->json([
                'message' => 'Xoá thành công'
            ], 204);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function forceDestroy(string $id)
    {
        try {
            $customer = Customer::query()->find($id);

            if ($customer) {
                $customer->forceDelete();

                return response()->json([
                    'message' => 'Xoá thành công'
                ], 204);
            }

            throw new \Exception('Không tìm thấy khách hàng');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
