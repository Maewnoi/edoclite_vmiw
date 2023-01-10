@php
use App\Http\Controllers\functionController;
@endphp
<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('ข้อมูลโปรไฟล์') }}
    </x-slot>
    <x-slot name="description">
        {{ __('อัปเดตข้อมูลโปรไฟล์และที่อยู่อีเมลหรือชื่อผู้ใช้บัญชีของคุณ.') }}
    </x-slot>
    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
            <x-jet-label for="photo" value="{{ __('รูปโปรไฟล์') }}" />
            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="object-cover w-20 h-20 rounded-full">
            </div>
            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block w-20 h-20 rounded-full"
                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>
            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('อัพโหลดรูปใหม่') }}
            </x-jet-secondary-button>
            @if ($this->user->profile_photo_path)
            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('ลบรูป') }}
            </x-jet-secondary-button>
            @endif
            <x-jet-input-error for="photo" class="mt-2" />
        </div>
        @endif
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('ชื่อ-นามสกุล') }}" />
            <x-jet-input id="name" type="text" class="block w-full mt-1" wire:model.defer="state.name"
                autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('ชื่อผู้ใช้หรืออีเมล') }}" />
            <x-jet-input id="email" type="text" class="block w-full mt-1" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        <!-- pos -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="pos" value="{{ __('ตำแหน่ง') }}" />
            <x-jet-input id="pos" type="text" class="block w-full mt-1" wire:model.defer="state.pos" />
            <x-jet-input-error for="pos" class="mt-2" />
        </div>
        <!-- tel -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="tel" value="{{ __('เบอร์โทรศัพท์') }}" />
            <x-jet-input id="tel" type="text" class="block w-full mt-1" wire:model.defer="state.tel" />
            <x-jet-input-error for="tel" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="group" value="{{ __('กองงาน') }}" />
            <x-jet-label for="group" class="text-primary"
                value="{{ functionController::funtion_groupmem_name(Auth::user()->group) }}" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cottons" value="{{ __('ฝ่าย') }}" />
            <x-jet-label for="cottons" class="text-primary"
                value="{{ functionController::funtion_cottons(Auth::user()->cotton) }}" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="level" value="{{ __('สิทธิ์การใช้งาน') }}" />
            <x-jet-label for="level" class="text-primary"
                value="{{ functionController::funtion_user_level(Auth::user()->level) }}" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="level" value="{{ __('ขนาดการใช้งาน') }}" />
            
            <x-jet-label for="level" class="text-primary"
                value='{!! functionController::format_Size(functionController::folder_Size("image/".functionController::funtion_sites_site_path_folder(Auth::user()->site_id)))!!} ({!!substr(functionController::funtion_sites_site_path_folder(Auth::user()->site_id), 0, -25)!!})' />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="level" value="{{ __('ระบบเข้ารหัสเอกสารด้วย CA') }}" />
            <x-jet-label for="level" class="text-primary"
                value='{{ functionController::funtion_check_site_ca(Auth::user()->site_id) }}' />
       
        </div>
        <div class="col-span-6 sm:col-span-4">
            @csrf
            <x-jet-label for="sign" value="{{ __('รูปลายเซ็น') }}" />
            @if(Auth::user()->sign != '')
            <div class="mt-2">
                <img src="{{ asset(Auth::user()->sign) }}" alt="" class="object-cover w-20 h-20 rounded-full">
            </div>
            @else
            <x-jet-label for="group" class="text-danger" value="{{ __('--ไม่พบรูป--') }}" />
            @endif
            <x-jet-secondary-button type="button" data-toggle="modal" data-target="#modal-addSign" class="mt-2 mr-2">
                {{ __('อัพโหลดรูปลายเซ็น') }}</x-jet-secondary-button>
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('บันทึกแล้ว.') }}
        </x-jet-action-message>
        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

<div class="modal fade" id="modal-addSign">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">อัพโหลดรูปลายเซ็นของคุณ ?
                </h4>
            </div>
            <div class="modal-body">
                <form action="{{route('addSign')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(Auth::user()->sign != '')
                    <x-jet-input type="hidden" value="{{Auth::user()->sign}}" name="old_sign"
                        class="block w-full mt-1 form-control" accept="image/*" />
                    @endif
                    <div class="row">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-input type="file" name="sign" class="block w-full mt-1 form-control" required
                                accept="image/*" />
                        </div>
                    </div>
                    <x-jet-input type="hidden" value="{{Auth::user()->id}}" name="id"
                        class="block w-full mt-1 form-control"  />
                    <br>
                    <x-jet-button onclick="submitForm(this);">
                        {{ __('save') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</div>
