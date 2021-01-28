<?php

namespace App\Http\Controllers;

use App\Model\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Illuminate\Routing\Controller;
use App\Http\Resources\Sale\SaleResource;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\SaleNotBelongToUser;
use Auth;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SaleResource::collection(Sale::paginate(20));
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
    public function store(SaleRequest $request)
    {
        $sale = new Sale;
        $sale->user_id = $request->user_id;
        $sale->client_id = $request->client_id;
        $sale->total_amount = $request->total_amount;
        $sale->save();
        return response([
            'data' => new SaleResource($sale)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return new SaleResource($sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->SaleUserCheck($sale);
        $sale->update($request->all());
        return response([
            'data' => new SaleResource($sale)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $this->SaleUserCheck($sale);
        $sale->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function SaleUserCheck($sale)
    {
        if (Auth::id() !== $sale->user_id) {
            throw new SaleNotBelongToUser;            
        }
    }
}
