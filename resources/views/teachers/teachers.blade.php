<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('teachers.add') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Teacher Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Teacher Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <!-- Laboratory No -->
                        <div class="mt-4">
                            <x-input-label for="labno" :value="__('Laboratory No')" />
                            <x-text-input id="labno" class="block mt-1 w-1/3" type="number" name="labno" required autofocus />
                            <x-input-error :messages="$errors->get('labno')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Add Teacher') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <table class="mt-4 w-full border-collapse text-center">
                        <thead>
                            <tr>
                                <th class="p-2">教員氏名</th>
                                <th class="p-2">メールアドレス</th>
                                <th class="p-2">研究室番号</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $teachers as $teacher )
                                <tr>
                                    <td class="border-t p-2">{{ $teacher->name }}</td>
                                    <td class="border-t p-2">{{ $teacher->email }}</td>
                                    <td class="border-t p-2">{{ $teacher->laboratory_no }}</td>
                                    <td class="border-t p-2">
                                        <div class="flex items-center">
                                            <a href="{{ route('teachers.edit', ['id' => $teacher->id]) }}" class="'inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                編集
                                            </a>
                                        </div>
                                    </td>
                                    <td class="border-t p-2">
                                        <div class="flex items-center">
                                            <a href="{{ route('teachers.delete', ['id' => $teacher->id]) }}" class="'inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                削除
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
