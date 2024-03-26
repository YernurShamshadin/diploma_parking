<?php

namespace App\Http\Requests\Setting;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'avatar' => ['nullable', 'string', 'max:255'],
			'name' => ['nullable', 'string', 'max:255'],
			'surname' => ['nullable', 'string', 'max:255'],
			'phone_number' => ['nullable', 'string', 'max:255'],
		];
	}

	public function getCurrentUser(): User
	{
		return $this->user();
	}
}