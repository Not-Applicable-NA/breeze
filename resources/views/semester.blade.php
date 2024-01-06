<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Semester Info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border mb-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            学期情報編集
                        </h2>
                        <form method="POST" action="{{ route('semester.store') }}" class="mt-4">
                            @csrf
                            @method('patch')

                            <div class="mt-4 flex flex-wrap w-full">
                                <div class="mr-2">
                                    <x-input-label for="first_start" :value="__('First Start')" />
                                    <x-text-input id="first_start" class="block mt-1 w-full" type="date" name="first_start" value="{{ $semester->first_start }}" required autofocus />
                                    <x-input-error :messages="$errors->get('first_start')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="first_first_half_end" :value="__('First First Half End')" />
                                    <x-text-input id="first_first_half_end" class="block mt-1 w-full" type="date" name="first_first_half_end" value="{{ $semester->first_first_half_end }}" required autofocus />
                                    <x-input-error :messages="$errors->get('first_first_half_end')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="first_second_half_start" :value="__('First Second Half Start')" />
                                    <x-text-input id="first_second_half_start" class="block mt-1 w-full" type="date" name="first_second_half_start" value="{{ $semester->first_second_half_start }}" required autofocus />
                                    <x-input-error :messages="$errors->get('first_second_half_start')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="first_end" :value="__('First End')" />
                                    <x-text-input id="first_end" class="block mt-1 w-full" type="date" name="first_end" value="{{ $semester->first_end }}" required autofocus />
                                    <x-input-error :messages="$errors->get('first_end')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap w-full">
                                <div class="mr-2">
                                    <x-input-label for="second_start" :value="__('Second Start')" />
                                    <x-text-input id="second_start" class="block mt-1 w-full" type="date" name="second_start" value="{{ $semester->second_start }}" required autofocus />
                                    <x-input-error :messages="$errors->get('second_start')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="second_first_half_end" :value="__('Second First Half End')" />
                                    <x-text-input id="second_first_half_end" class="block mt-1 w-full" type="date" name="second_first_half_end" value="{{ $semester->second_first_half_end }}" required autofocus />
                                    <x-input-error :messages="$errors->get('second_first_half_end')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="second_second_half_start" :value="__('Second Second Half Start')" />
                                    <x-text-input id="second_second_half_start" class="block mt-1 w-full" type="date" name="second_second_half_start" value="{{ $semester->second_second_half_start }}" required autofocus />
                                    <x-input-error :messages="$errors->get('second_second_half_start')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="second_end" :value="__('Second End')" />
                                    <x-text-input id="second_end" class="block mt-1 w-full" type="date" name="second_end" value="{{ $semester->second_end }}" required autofocus />
                                    <x-input-error :messages="$errors->get('second_end')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    保存
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <table class="mt-4 w-full border-collapse text-center">
                        <thead>
                            <tr>
                                <th class="p-2">前期開始日</th>
                                <th class="p-2">前期前半終了日</th>
                                <th class="p-2">前期後半開始日</th>
                                <th class="p-2">前期終了日</th>
                                <th class="p-2">後期開始日</th>
                                <th class="p-2">後期前半終了日</th>
                                <th class="p-2">後期後半開始日</th>
                                <th class="p-2">後期終了日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="border-t p-2">{{ $semester->first_start }}</td>
                            <td class="border-t p-2">{{ $semester->first_first_half_end }}</td>
                            <td class="border-t p-2">{{ $semester->first_second_half_start }}</td>
                            <td class="border-t p-2">{{ $semester->first_end }}</td>
                            <td class="border-t p-2">{{ $semester->second_start }}</td>
                            <td class="border-t p-2">{{ $semester->second_first_half_end }}</td>
                            <td class="border-t p-2">{{ $semester->second_second_half_start }}</td>
                            <td class="border-t p-2">{{ $semester->second_end }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
