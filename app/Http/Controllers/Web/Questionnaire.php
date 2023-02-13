<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionListRequest;
use App\Models\QuestionList;
use App\Repositories\QuestionRepository;
use App\Traits\ResponseTrait;
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
    public function index(Request $request)
    {
        $perPage = isset($request->perPage) ? intval($request->perPage) : 10;
        $questions = $this->questionRepository->getPaginatedData($perPage);
        return view("questions.index", compact("questions"));
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionListRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreQuestionListRequest $request)
    {
        $result = false;
        try {
            $data =  $request->only(['title', 'expiry_date']);
            $result = $this->questionRepository->create($data);
        } catch (\Exception $e) {
            // error handeling
        }
        if ($result) {
            return redirect()->route('questions.list')->with(['success' => 'Data created!']);
        } else {
            return redirect()->route('questions.list')->with(['error' => 'Data not created!']);
        }
    }

    /**
     * Send email to the student.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\JsonResponse
     */
    public function email(QuestionList $questionList)
    {
        if ($this->questionRepository->sendMail($questionList)) {
            return redirect()->route('questions.list')->with(['success' => 'Mail send success!']);
        } else {
            return redirect()->route('questions.list')->with(['error' => 'Mail send failed!']);
        }
    }
}
