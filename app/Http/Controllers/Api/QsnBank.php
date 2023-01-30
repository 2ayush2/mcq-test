<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentAnswerRequest;
use App\Models\QuestionBank;
use App\Models\StudentAnswer;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionBankRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
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
    public function index(Request $request): JsonResponse
    {
        $perPage = isset($request->perPage) ? intval($request->perPage) : 10;
        return $this->responseSuccess($this->questionBankRepository->getPaginatedData($perPage));
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
            return $this->responseSuccess($result);
        }
        return $this->responseError($result);
    }
}
