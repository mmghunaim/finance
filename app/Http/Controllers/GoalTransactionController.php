<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Http\Requests\GoalTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GoalTransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Goal $goal
     * @return Response
     */
    public function store(GoalTransactionRequest $request, Goal $goal)
    {
        return $goal->addTransaction(array_merge($request->validated(), [
            'user_id' => Auth::id(),
        ]));
    }
}
