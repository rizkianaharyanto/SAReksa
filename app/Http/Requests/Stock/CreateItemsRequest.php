<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemsRequest extends FormRequest
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
            'kode_barang' => 'required|alpha_dash|',
            'kategori_barang' => 'required|numeric',
            'nama_barang' => 'required|',
            'satuan_unit' => 'required|numeric|',
            'harga_retail' => 'required|numeric',
            'harga_grosir' => 'required|numeric',
            'harga_jual'   => 'required|numeric',
       
            'item_image' => 'nullable|file',
            'pajak_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            

            //
        ];
    }
}
