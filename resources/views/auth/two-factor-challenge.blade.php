<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <img src="{{ asset('/image/logo_lei.png') }}" class="brand-image img-circle elevation-3" width="100"
                height="100">
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('โปรดยืนยันการเข้าถึงบัญชีของคุณโดยป้อนรหัสการตรวจสอบที่ได้รับจากแอปพลิเคชันตรวจสอบสิทธิ์ของคุณ.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('โปรดยืนยันการเข้าถึงบัญชีของคุณโดยป้อนหนึ่งในรหัสกู้คืนฉุกเฉินของคุณ.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label for="code" value="{{ __('Code') }}" />
                    <x-jet-input id="code" class="block w-full mt-1" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-jet-input id="recovery_code" class="block w-full mt-1" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('ใช้รหัสกู้คืน') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('ใช้รหัสยืนยันตัวตน') }}
                    </button>

                    <x-jet-button class="ml-4" onclick="submitForm(this);">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
