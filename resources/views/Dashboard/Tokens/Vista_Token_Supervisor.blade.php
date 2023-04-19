<x-guest-layout>
    @csrf
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Token de verificacion permisos cliente') }}</span>
        </label>
        <br><br>
        <p class="font-semibold text-x2 text-gray-800 dark:text-gray-200 leading-tight">Token con los permisos para el cliente</p>
        <br>
    </div>

    <div class="block mt-5" style="display: flex; justify-content: center;">
        <label for="remember_me" class="inline-flex items-center">
            <span class="font-semibold  text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 30px;">{{ $token }}</span>
        </label>
        <br><br>
        <br><br>
    </div>


</x-guest-layout>