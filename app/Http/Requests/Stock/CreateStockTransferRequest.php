<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class CreateStockTransferRequest extends FormRequest
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
            'kode_ref'      => 'required|string',
            'gudang_asal'   => 'required|numeric',
            'gudang_tujuan' => 'required|numeric',
            'barang_id'       => 'required|array',
            'qty'           => 'required|array',
            'deskripsi'     => '',
            'departemen'    => 'required|string',
            'akun_penyesuaian' => 'required|numeric'
        ];
    }
}
