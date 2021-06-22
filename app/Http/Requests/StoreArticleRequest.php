<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Providers\CourseArticleAction;

class StoreArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'title' => 'required|max:120|unique:articles,title,' . $request->get('id'),
            'status' => 'required',
            'description' => 'required',
            'categories' => 'required'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Subcategory
        $courseArticle = new CourseArticleAction();

        $this->merge([
            'subcategories' => $courseArticle->subSet($this->input('subcategories'))
        ]);
    }
}
