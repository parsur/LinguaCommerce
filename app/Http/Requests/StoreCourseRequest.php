<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Providers\EnglishConvertion;
use App\Providers\CourseArticleAction;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required|max:120|unique:courses,name,' . $request->get('id'),
            'price' => 'nullable|numeric',
            'description' => 'required',
            'status' => 'required',
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
        // English convertion
        $englishConvertion = new EnglishConvertion();
        // Category and subcategory
        $courseArticle = new CourseArticleAction();

        $this->merge([
            'price' => $englishConvertion->convert($this->input('price')),
            'subcategories' => $courseArticle->subSet($this->input('subcategories'))
        ]);
    }
}
