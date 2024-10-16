<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Voucher;
use App\Http\Resources\VoucherResource;
use App\Http\Requests\StoreRequest\VoucherStoreRequest;
use App\Http\Requests\UpdateRequest\VoucherUpdateRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(VoucherResource::collection(Voucher::all()));
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
    public function store(VoucherStoreRequest $request)
    {
        $voucher = Voucher::create($request->validated());
		$voucher->details()->createMany($request->details);

		return response()->json(new VoucherResource($voucher), 201);
		// return response()->json(['voucher' => $request->validated()], 201);
		// // return $request;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherUpdateRequest $request, Voucher $voucher)
    {
        $voucher->update($request->validated());
		$details = $request->details;

		// foreach ($details as $detail) {
		// 	VoucherDetail::upsert()


        // }
		// $voucher->details()->update($request->details);
		return response()->json(new VoucherResource($voucher), 201);
		// return response()->json(['details'=> $request->details], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

	// api/voucher/number/{dv or cv}
	public function voucherNo($prefix = 'DV')
	{
		return response()->json(['voucher_no' => Voucher::generateVoucherNo($prefix)], 201);
	}
}
