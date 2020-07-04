<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameRequest extends FormRequest
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
            'kode_ref'          => 'required|string',
            'gudang_id'         => 'required|integer',
            'deskripsi'         => 'string',
            'departemen'        => 'string',
            'akun_penyesuaian'  => 'required|integer',
            'item_id'           => 'array|required|required_with:on_hand',
            'on_hand'           => 'array|required|required_with:item_id'
            //
        ];
    }
}
