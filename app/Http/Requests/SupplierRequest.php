<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $supplier_id = $this->route('supplier');

    return [
      'name' => ['required', 'string'],
      'phone' => ['required', 'string', Rule::unique('suppliers', 'phone')->ignore($supplier_id)],
      'address' => ['required', 'string'],
    ];
  }
}
