@php
use App\Http\Controllers\functionController;
@endphp
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset(functionController::get_site_img_not_auth()) }}" class="brand-image img-circle elevation-3" width="100"
                height="100">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('ลืมรหัสผ่านหรือไม่? ไม่มีปัญหา. เพียงแจ้งให้เราทราบที่อยู่อีเมลของคุณ แล้วเราจะส่งลิงก์รีเซ็ตรหัสผ่านทางอีเมลให้คุณเลือกรหัสผ่านใหม่.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button onclick="submitForm(this);">
                    {{ __('รีเซ็ตรหัสผ่าน') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
