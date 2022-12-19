@php
use App\Http\Controllers\functionController;
@endphp
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset(functionController::get_site_img()) }}" class="brand-image img-circle elevation-3" width="100"
                height="100">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('นี่คือพื้นที่ปลอดภัยของแอปพลิเคชัน โปรดยืนยันรหัสผ่านของคุณก่อนดำเนินการต่อครับ') }}
        </div>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-jet-button class="ml-4" onclick="submitForm(this);">
                    {{ __('ยืนยัน') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
