<?php

namespace App\Http\Requests;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
        $statuses = array_keys(Order::STATUS);

        return [
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required|in:'.implode(',', $statuses),
        ];
    }
}
