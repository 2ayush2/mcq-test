<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionListRequest;
use App\Http\Requests\UpdateQuestionListRequest;
use App\Http\Resources\QuestionListResource;
use App\Models\QuestionList;
use App\Models\Student;

class Questionnaire extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionListResource::collection(
            QuestionList::query()->where("expire_date>now()")->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionListRequest $request)
    {
        $data = $request->validate();
        $newQuestion = QuestionList::create($data);
        return response(new QuestionListResource($newQuestion));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionList $questionList)
    {
        return new QuestionListResource($questionList);
    }

    /**
     * Send email to the student.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function email(QuestionList $questionList)
    {
        $studentList = Student::findAll();
        return new QuestionListResource($questionList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionListRequest  $request
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionListRequest $request, QuestionList $questionList)
    {
        $data = $request->validate();
        $questionList->update($data);
        return new QuestionListResource($questionList);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionList $questionList)
    {
        $questionList->delete();
        return response("", 204);
    }
}
