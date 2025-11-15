<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\StoreStockRequest;
use App\Http\Requests\Stock\UpdateStockRequest;
use App\Models\Stock;
use domain\facades\StockFacade\StockFacade;
use Illuminate\Http\Request;

class StockController extends ParentController
{
    public function index()
    {
        $response['output_items'] = StockFacade::getOutputItems();
        return view('pages.stock.index', $response);
    }

    public function loadStocks(Request $request)
    {
        $query = Stock::query()->with('outputItem');

        if (isset($request['search'])) {
            $query = $query->where('balance', 'like', '%' . $request['search'] . '%')
                ->orWhereHas('outputItem', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request['search'] . '%');
                })
                ->orWhere('unit_price', 'like', '%' . $request['search'] . '%');
        }

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

    public function get($stock_id)
    {
        $stock = StockFacade::get($stock_id);
        return response()->json($stock);
    }

    public function update(UpdateStockRequest $request, $stock_id)
    {
        return StockFacade::update($request->all(), $stock_id);
    }

    public function delete($stock_id)
    {
        return StockFacade::delete($stock_id);
    }
}
