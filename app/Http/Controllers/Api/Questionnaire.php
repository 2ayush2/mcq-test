<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionListRequest;
use App\Http\Resources\QuestionListResource;
use App\Jobs\SendMailJob;
use App\Models\QuestionList;
use App\Models\StudentAnswer;
use App\Repositories\QuestionRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Questionnaire extends Controller
{

    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Question Repository class.
     *
     * @var questionRepository
     */

    public $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }
    /**
     * Display a listing of the questions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = isset($request->perPage) ? intval($request->perPage) : 10;
        return $this->responseSuccess($this->questionRepository->getPaginatedData($perPage));
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionListRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreQuestionListRequest $request): JsonResponse
    {
        try {
            $data =  $request->only(['title', 'expiry_date']);
            return $this->responseSuccess($this->questionRepository->create($data));
        } catch (\Exception $e) {
            return $this->responseError(
                null,
                /*$e->getMessage() ,*/
                "Unknown Error !!!",
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Send email to the student.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\JsonResponse
     */
    public function email(QuestionList $questionList): JsonResponse
    {
        if ($this->questionRepository->sendMail($questionList)) {
            return $this->responseSuccess([]);
        }
        return $this->responseError(null, "Mail not send", JsonResponse::HTTP_BAD_REQUEST);
    }
}
