<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\StoreStockRequest;
use App\Models\Stock;
use domain\facades\StockFacade\StockFacade;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $response['output_items'] = StockFacade::getOutputItems();
        return view('pages.stock.index', $response);
    }

    public function loadStocks(Request $request)
    {
        $query = Stock::query();

        // if (isset($request['search'])) {
        //     $query = $query->where('invoice_number', 'like', '%' . $request['search'] . '%')
        //         ->orWhereHas('customer', function ($q) use ($request) {
        //             $q->where('name', 'like', '%' . $request['search'] . '%');
        //         })
        //         ->orWhere('date', 'like', '%' . $request['search'] . '%');
        // }

        if (isset($request['count'])) {
            $response['stocks'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['stocks'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.stock.components.table')->with($response);
    }

    public function store(StoreStockRequest $request)
    {
        $stock_id = StockFacade::store($request->all());
        return redirect()->route('stock.index');
    }
}
