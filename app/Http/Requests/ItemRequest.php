<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
    return [
      'name' => ['required', 'string'],
      'category_id' => ['required'],
      'description' => ['nullable', 'string'],
      'sku' => ['required', 'string'],
      'barcode' => ['required', 'string'],
      'barcode_type' => ['required', 'string'],
      'quantity' => ['required'],
      'min_stock' => ['required'],
      'unit_price' => ['required'],
      'image' => ['nullable', 'image'],
    ];
  }
}
