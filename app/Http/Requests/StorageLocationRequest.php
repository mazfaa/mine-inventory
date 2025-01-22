<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorageLocationRequest extends FormRequest
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
    $storage_location_id = $this->route('storage-location');

    return [
      'name' => [
        'required',
        Rule::unique('storage_locations', 'name')->ignore($storage_location_id),
      ],
      'description' => ['nullable'],
    ];
  }
}
