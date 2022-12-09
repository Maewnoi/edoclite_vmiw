@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border shadow card border-info">
                        <div class="bg-red-700 card-header">
                            <div class="clearfix">
                            domji
                            </div>
                        </div>
                        <div class="bg-red-700 card-body">
                            <form action="{{route('domji_submit')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                <x-jet-button onclick="submitForm(this);">
                                    {{ __('submittttttttttttttt') }}
                                </x-jet-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>