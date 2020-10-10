<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class CreateStockAdjustmentRequest extends FormRequest
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
            //
            'warehouse_id'          => 'required|numeric',
            'akun_penyesuaian'      => 'required|integer',
            'deskripsi'             => 'nullable',
            'item_id'               => 'required|array',
            'item_id.*'             => 'required|distinct',
            'quantity_diff'         => 'required|array',
        ];
    }
}
