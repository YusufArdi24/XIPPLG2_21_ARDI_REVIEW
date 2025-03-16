<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index()
    {
        $loan = Loan::all();

        return response()->json([
            'status'=> 200,
            'message'=> 'Loans retrieved successfully.',
            'data'=> $loans
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'user_id' => 'required|integer|exists:users,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|string|max:255'
        ]);

        $loan = Loan::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Loan created successfully.',
            'data' => $loan
        ], 200);
    
    }
    
}
