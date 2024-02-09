<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            教員編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border mb-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <form method="POST" action="{{ route('teachers.edit.store', ['id' => $teacher->id]) }}">
                            @csrf
                            @method('patch')

                            <input type="hidden" name="teacherId" value="{{ $teacher->id }}" />

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Teacher Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $teacher->name }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Teacher Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $teacher->email }}" autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <!-- Laboratory No -->
                            <div class="mt-4">
                                <x-input-label for="labno" :value="__('Laboratory No')" />
                                <x-text-input id="labno" class="block mt-1 w-1/3" type="number" name="labno" value="{{ $teacher->laboratory_no }}" autofocus />
                                <x-input-error :messages="$errors->get('labno')" class="mt-2" />
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    保存
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
