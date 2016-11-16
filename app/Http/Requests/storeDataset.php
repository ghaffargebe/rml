<?php

namespace RML\Http\Requests;

use RML\Http\Requests\Request;

class storeDataset extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organisasi' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            'howto' => 'required',
            // 'file' => ['required','mimes:jpg']
        ];
    }

    public function attributes()
    {
        return [
            // 'file' => 'File Upload'
        ];
    }
}
