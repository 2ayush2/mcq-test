<?php

namespace App\Repositories;

use App\Http\Resources\QuestionBankResource;
use App\Http\Resources\QuestionListResource;
use App\Interfaces\CrudInterface;
use App\Jobs\SendMailJob;
use App\Models\QsnToBank;
use App\Models\QuestionBank;
use App\Models\QuestionList;
use App\Models\StudentAnswer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class QuestionBankRepository implements CrudInterface
{

    /**
     * Get Question By Pages 
     *
     * 
     * @return collections Array of QuestionBank Collection
     */
    public function getPaginatedData(int $perPage): AnonymousResourceCollection
    {
        return QuestionBankResource::collection(
            QuestionBank::orderBy('id', 'desc')
                ->paginate($perPage)
        );
    }
    /**
     * Create New Question.
     *
     * @param array $data
     * @return object QuestionList Object
     */
    public function create(array $data): QuestionBankResource
    {
        return new QuestionBankResource(QuestionBank::create($data));;
    }
    /**
     * Delete QuestionBank.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $question = QuestionBank::find($id);
        if (empty($question)) {
            return false;
        }
        $question->delete();
        return true;
    }

    /**
     * Get QuestionBank Detail By ID.
     *
     * @param int $id
     * @return QuestionBankResource
     */
    public function getByID(int $id): QuestionBankResource
    {
        $question = QuestionBank::find($id);
        if (empty($question)) {
            return null;
        }
        return new QuestionBankResource($question);
    }

    /**
     * Update QuestionBank By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated QuestionBankResource
     */
    public function update(int $id, array $data): QuestionBankResource
    {
        $question = QuestionBank::find($id);
        if (empty($question)) {
            return null;
        }
        $question->update($data);
        return new QuestionBankResource($question);
    }
}
