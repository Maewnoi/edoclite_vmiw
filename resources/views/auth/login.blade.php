<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="@if($routes_sites_name_check->site_img != null) {{ asset($routes_sites_name_check->site_img) }}  @else  {{ asset('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png') }} @endif " class="brand-image img-circle elevation-3" width="100"
                height="100">
        </x-slot>
        <x-jet-label class="text-lg text-center" id="txt-login" value="{{ __('ระบบสารบรรณอิเล็กทรอนิกส์') }} {{$routes_sites_name_check->site_name}}" />
        <!-- <x-jet-validation-errors class="mb-4" /> -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Username') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="text" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif -->

                <x-jet-button class="ml-4" onclick="submitForm(this);">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
        <div class="flex items-center justify-end mt-4">
            <button class="text-sm text-gray-600 hover:text-red-300" data-toggle="modal"
                data-target="#modal-Test-Account">Test Account</button>
            </dvi>
    </x-jet-authentication-card>
    <!-- Modal Test Account -->
    <div class="modal fade" id="modal-Test-Account">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="bg-red-300 modal-header">
                    <label class="modal-title">Test Account
                    </label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="todo-list ui-sortable" data-widget="todo-list">
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">นายก(1) Username : lei011 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">รองนายก(1) Username : lei012 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">ปลัด(2) Username : lei021 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">รองปลัด(2) Username : lei022 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">สรรบรรณกลาง(3) Username : lei03 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">หัวหน้ากอง(4) Username : lei04 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">หัวหน้าฝ่าย(5) Username : lei05 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">สรรบรรณกอง(6) Username : lei06 Password : 1234</span>
                        </li>
                        <li>
                            <span class="handle ui-sortable-handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <span class="text">งาน(7) Username : lei07 Password : 1234</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end model -->
</x-guest-layout>