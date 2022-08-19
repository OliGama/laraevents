<?php

namespace App\Http\Requests\Organization\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required', 
            'speaker_name' => 'required', 
            'start_date' => [
                'required',
                'date_format:d/m/Y H:i'
            ], 
            'end_date' => [
                'required',
                'date_format:d/m/Y H:i',
                'after:' .$this->start_date ?? null
            ], 
            'target_audience' => ['required', 'max:150'], 
            'participants_limit' => ['numeric', 'integer', 'min:1']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'speaker_name' => 'palestrante', 
            'start_date' => 'data de início', 
            'end_date' => 'data de fim', 
            'target_audience' => 'público-alvo', 
            'participants_limit' => 'limite de participantes'
        ];
    }

    public function messages()
    {
        return [
            'date_format' => 'O campo :attribute não corresponde ao formato 00/00/0000',
            'end_date.after' => 'A data final deve ser posterior a data inicial.'
        ];
    }
}
