<?php

namespace domain\services\ExpenseService;

use App\Models\Expense;
use App\Models\ExpensesCategory;
use App\Models\Image;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class ExpenseService
{
    protected $expense;
    protected $expense_category;
    protected $image;

    public function __construct()
    {
        $this->expense = new Expense();
        $this->expense_category = new ExpensesCategory();
        $this->image = new Image();
    }

    public function getExpensesCategories()
    {
        return $this->expense_category->get();
    }

    public function store(array $data)
    {
        $count = $this->expense->withTrashed()->count();

        $code = 'EX' . sprintf('%05d', $count + 1);
        $check = $this->expense->withTrashed()->where('code', $code)->first();

        while ($check) {
            $count++;
            $code = 'EX' . sprintf('%05d', $count);
            $check = $this->expense->withTrashed()->where('code', $code)->first();
        }

        $data['code'] = $code;

        if (isset($data['file_path'])) {
            $file['name'] = $data['file_path'];
            $created_image = $this->image->create($file);
            $created_image->save();
            $data['image_id'] = $created_image->id;
        }

        $created_expense = $this->expense->create($data);
        $created_expense->save();
        return $created_expense->id;
    }

    public function get($id)
    {
        return $this->expense->withTrashed()->findOrFail($id);
    }

    public function update($id, $data)
    {
        $dateString = $data['date'];
        $formattedDate = Carbon::parse($dateString);

        if (isset($data['date'])) {
            $data['date'] = $formattedDate;
            $data['created_at'] = $formattedDate;
        }
        $expense = $this->expense->findOrFail($id);
        $expense->update($data);
        $expense->created_at = $expense->date;
        $expense->save();
        return $expense;
    }

    public function delete(int $expense_id)
    {
        $expense = $this->expense->find($expense_id);
        return $expense->delete();
    }

    public function restoreExpense(int $expense_id)
    {
        $deleted_expense = $this->expense->withTrashed()->find($expense_id);
        $deleted_expense->deleted_at = null;
        return $deleted_expense->save();
    }

    public function removeImage(int $id)
    {
        $details = $this->expense->find($id);
        $details->image_id = null;
        return $details->save();
    }

    public function calculateTotals($expenses)
    {
        $totals = [
            'total' => 0
        ];

        foreach ($expenses as $expense) {
            $totals['total'] += $expense['amount'];
        }

        return $totals;
    }



    public function getCategory($id)
    {
        return $this->expense_category->findOrFail($id);
    }

    public function expenseCategorystore(array $data)
    {
        $created_expense_category = $this->expense_category->create($data);
        $created_expense_category->save();
        return $created_expense_category->id;
    }

    public function editExpenseCategory($data, $id)
    {
        $category = $this->expense_category->findOrFail($id);
        return $category->update($data);
    }

    public function deleteCategory(int $product_id)
    {
        return $this->expense_category->find($product_id)->delete();
    }

    public function restoreCategory(int $category_id)
    {
        $deleted_category = $this->expense_category->withTrashed()->find($category_id);
        $deleted_category->deleted_at = null;
        return $deleted_category->save();
    }






    // getExpensesCategories
    public function categorySelectAll()
    {
        return $this->expense_category->orderBy('name', 'asc')->get();
    }

    // expenseCategorystore
    public function newCategory(array $data)
    {
        $expense_category = $this->expense_category->where('name', $data['name'])->first();
        if (!$expense_category) {
            return $this->expense_category->create($data);
        } else {
            return "This category already exists";
        }
    }
}
