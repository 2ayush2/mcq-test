<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentAnswerRequest;
use App\Models\StudentAnswer;
use App\Repositories\AnswerRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class StudentTest extends Controller
{

    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Answer Repository class.
     *
     * @var AnswerRepository
     */

    public $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\StudentAnswer $studentAnswer
     * @return \Illuminate\Http\JsonResponse
     */
    public function questions(StudentAnswer $studentAnswer): JsonResponse
    {
        $result = $this->answerRepository->getTest($studentAnswer);
        if ($result != null) {
            return $this->responseSuccess($result);
        }
        return $this->responseError($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentAnswerRequest $request)
    {
        $result = $this->answerRepository->saveTest($request);
        if ($result) {
            return $this->responseSuccess($result);
        }
        return $this->responseError($result);
    }
}
