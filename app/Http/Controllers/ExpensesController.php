<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreExpenseCategoryRequest;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Models\Expense;
use App\Models\ExpensesCategory;
use Carbon\Carbon;
use domain\facades\CustomerFacade\CustomerFacade;
use domain\facades\ExpenseFacade\ExpenseFacade;
use Illuminate\Http\Request;

class ExpensesController extends ParentController
{
    public function index()
    {
        return view('pages.expenses.index');
    }

    public function create()
    {
        $response['expense_date'] = Carbon::now()->format('Y-m-d');
        $response['expenses_categories'] = ExpenseFacade::getExpensesCategories();
        //$response['expense_categories'] = ExpenseFacade::getExpensesCategories();
        $response['customers'] = CustomerFacade::getCustomers();
        return view('pages.expenses.create', $response);
    }

    public function loadExpenses(Request $request)
    {
        $query = Expense::query();

        if (isset($request['search'])) {
            $query = $query->where('code', 'like', '%' . $request['search'] . '%')
                ->orWhere('description', 'like', '%' . $request['search'] . '%')
                ->orWhere('note', 'like', '%' . $request['search'] . '%')
                ->orWhere('date', 'like', '%' . $request['search'] . '%')
                ->orWhere('amount', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['count'])) {
            $response['expenses'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['expenses'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.expenses.components.table')->with($response);
    }

    public function store(StoreExpenseRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('storage/expenses'), $fileName);
            $request['file_path'] = 'storage/expenses/' . $fileName;
        }
        return ExpenseFacade::store($request->all());
    }

    public function edit($expense_id)
    {
        $expense = ExpenseFacade::get($expense_id);
        return view('pages.expenses.edit')->with(['expense' => $expense]);
    }

    public function delete($expense_id)
    {
        return ExpenseFacade::delete($expense_id);
    }

    public function goToExpensesCategory()
    {
        return view('pages.expenses.category');
    }

    public function loadExpensesCategories()
    {
        $response['expensesCategories'] = ExpenseFacade::getExpensesCategories();
        return view('pages.expenses.components.expensesCategoryTable')->with($response);
    }

    public function expenseCategorystore(StoreExpenseCategoryRequest $request)
    {
        return ExpenseFacade::expenseCategorystore($request->all());
    }

    public function loadExpensesCategory(Request $request)
    {
        $query = ExpensesCategory::query();

        if (isset($request['search'])) {
            $query = $query->where('name', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['count'])) {
            $response['expensesCategories'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['expensesCategories'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.expenses.components.expensesCategoryTable')->with($response);
    }
}
