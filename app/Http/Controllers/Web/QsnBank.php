<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionBankResource;
use App\Repositories\QuestionBankRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class QsnBank extends Controller
{

    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Question Bank Repository class.
     *
     * @var QuestionBankRepository
     */

    public $questionBankRepository;

    public function __construct(QuestionBankRepository $questionBankRepository)
    {
        $this->questionBankRepository = $questionBankRepository;
    }

    /**
     * Display a listing of the questions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = isset($request->perPage) ? intval($request->perPage) : 10;
        $banks = $this->questionBankRepository->getPaginatedData($perPage);
        return view("bank.index", compact("banks"));
    }


    /**
     * Delete QuestionBank.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $result = $this->questionBankRepository->delete($id);
        if ($result) {
            return redirect()->route('qbank.list')->with(['success' => 'Data deleted!']);
        } else {
            return redirect()->route('qbank.list')->with(['error' => 'Data not deleted!']);
        }
    }
}
