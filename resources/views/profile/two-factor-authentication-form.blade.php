<x-jet-action-section>
    <x-slot name="title">
        {{ __('การยืนยันตัวตนแบบสองขั้นตอน (two-factor authentication)') }}
    </x-slot>

    <x-slot name="description">
        {{ __('เพิ่มความปลอดภัยให้กับบัญชีของคุณโดยใช้ Authenticator.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('คุณได้เปิดใช้งาน Authenticator.') }}
            @else
                {{ __('คุณยังไม่ได้เปิดใช้งาน Authenticator.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('เมื่อเปิดใช้งานการพิสูจน์ตัวตนแบบสองปัจจัย คุณจะได้รับพร้อมท์ให้ใส่โทเค็นแบบสุ่มที่ปลอดภัยระหว่างการตรวจสอบสิทธิ์ คุณสามารถเรียกโทเค็นนี้จากแอปพลิเคชัน Google Authenticator ในโทรศัพท์ของคุณ.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('เปิดใช้งานการรับรองความถูกต้องด้วยสองปัจจัยแล้ว สแกนรหัส QR ต่อไปนี้โดยใช้แอปพลิเคชันตรวจสอบสิทธิ์ในโทรศัพท์ของคุณ.') }}
                    </p>
                </div>

                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('เก็บรหัสกู้คืนเหล่านี้ไว้ในตัวจัดการรหัสผ่านที่ปลอดภัย สามารถใช้เพื่อกู้คืนการเข้าถึงบัญชีของคุณได้หากอุปกรณ์ตรวจสอบสิทธิ์แบบสองปัจจัยของคุณสูญหาย.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('เปิดใช้งาน') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('สร้างรหัสกู้คืนใหม่') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('แสดงรหัสกู้คืน') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('ปิดการใช้งาน') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
