<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'kode_supplier' => 'alpha_dash|required',
            'nama_supplier' => 'required|string',
            'alamat'        => 'required|string',
            'no_telp'       => 'required|numeric',
            'min_pembelian' => 'integer',
            'akun_pembelian'=> 'integer'
            
        ];
    }
}
