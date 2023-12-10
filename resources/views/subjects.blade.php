<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->class->major->name }} {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('subjects.add') }}">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Subject name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="syllabus" :value="__('Syllabus')" />
                            <x-text-input id="syllabus" class="block mt-1 w-full" type="text" name="syllabus" required autofocus />
                            <x-input-error :messages="$errors->get('syllabus')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex">
                            <x-input-label for="obligatory" :value="__('Obligatory subject')" />
                                <input id="obligatory" type="checkbox" value="yes" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="obligatory">
                            </label>
                        </div>

                        <div class="mt-4 flex w-full">
                            <div>
                                <x-input-label for="credits" :value="__('Credits')" />
                                <select name="credits" id="credits" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                    <option value="">---選択してください---</option>
                                    @foreach ($credits as $credit)
                                        <option value="{{ $credit }}">{{ $credit }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="ml-2">
                                <x-input-label for="grade" :value="__('Dividend grade')" />
                                <select name="grade" id="grade" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                    <option value="">---選択してください---</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade }}">{{ $grade }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="ml-2">
                                <x-input-label for="semester" :value="__('Semester')" />
                                <select name="semester" id="semester" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                    <option value="">---選択してください---</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester }}">{{ $semester }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="ml-2">
                                <x-input-label for="room" :value="__('Main lecture room')" />
                                <x-text-input id="room" class="block mt-1 w-full" type="text" name="room" required autofocus />
                                <x-input-error :messages="$errors->get('room')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="mt-4">{{ __('Teachers in charge') }}</div>
                            @foreach ($teachers as $teacher)
                                <div>
                                    <label for="teacher_{{ $teacher->id }}">{{ $teacher->name }}</label>
                                    <input id="teacher_{{ $teacher->id }}" type="checkbox" name="teacher[]" value="{{ $teacher->name }}" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <div class="mt-4">{{ __('Target classes') }}</div>
                            <div class="flex">
                                @foreach ($classes as $class)
                                    <div>
                                        <input id="class_{{ $class->id }}" type="checkbox" name="class[]" value="{{ $class->name }}" class="ml-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <label for="class_{{ $class->id }}" class="ml-2">{{ $class->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 flex w-full">
                            <div>
                                <x-input-label for="dayofweek" :value="__('Day of week')" />
                                <select name="dayofweek" id="dayofweek" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                    <option value="">---選択してください---</option>
                                    @foreach ($dayOfWeeks as $dayOfWeek)
                                        <option value="{{ $dayOfWeek }}">{{ $dayOfWeek }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="ml-2">
                                <x-input-label for="period" :value="__('Period')" />
                                <select name="period" id="period" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                    <option value="">---選択してください---</option>
                                    @foreach ($periods as $period)
                                        <option value="{{ $period }}">{{ $period }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex">
                            <x-input-label for="inarow" :value="__('In a row')" />
                                <input id="inarow" type="checkbox" value="yes" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="inarow">
                            </label>
                        </div>

                        <div class="mt-4 w-full border-t border-t-white">
                            <h3 class="mt-4 text-xl">週2回授業がある場合はこちらも設定</h3>
                            
                            <div class="mt-4 flex w-full">    
                                <div>
                                    <x-input-label for="dayofweek2" :value="__('Day of week')" />
                                    <select name="dayofweek2" id="dayofweek2" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($dayOfWeeks as $dayOfWeek)
                                            <option value="{{ $dayOfWeek }}">{{ $dayOfWeek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="ml-2">
                                    <x-input-label for="period2" :value="__('Period')" />
                                    <select name="period2" id="period2" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($periods as $period)
                                            <option value="{{ $period }}">{{ $period }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 flex">
                                <x-input-label for="inarow2" :value="__('In a row')" />
                                    <input id="inarow2" type="checkbox" value="yes" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="inarow2">
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Add subjects') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
