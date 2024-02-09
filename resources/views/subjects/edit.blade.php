<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subject edit') }} ({{ $subject->name }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border mb-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <form method="POST" action="{{ route('subjects.edit.store', ['id' => $subject->id]) }}">
                            @csrf
                            @method('patch')

                            <input type="hidden" name="subjectId" value="{{ $subject->id }}" />
    
                            <div>
                                <x-input-label for="name" :value="__('Subject name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $subject->name }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <div class="mt-4 flex flex-wrap w-full">
                                <div class="mr-2">
                                    <x-input-label for="credits" :value="__('Credits')" />
                                    <select name="credits" id="credits" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($credits as $credit)
                                            <option value="{{ $credit }}"
                                                @if ($subject->credits == $credit)
                                                    selected
                                                @endif
                                            >{{ $credit }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('credits')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="grade" :value="__('Dividend grade')" />
                                    <select name="grade" id="grade" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade }}"
                                                @if ($subject->dividend_grade == $grade)
                                                    selected
                                                @endif
                                            >{{ $grade }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="semester" :value="__('Semester')" />
                                    <select name="semester" id="semester" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester }}"
                                                @if ($subject->semester == $semester)
                                                    selected
                                                @endif
                                            >{{ $semester }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="room" :value="__('Main lecture room')" />
                                    <x-text-input id="room" class="block mt-1 w-full" type="text" name="room" value="{{ $subject->main_lecture_room }}" required autofocus />
                                    <x-input-error :messages="$errors->get('room')" class="mt-2" />
                                </div>
                            </div>
    
                            <div class="mt-4 flex">
                                <x-input-label for="obligatory" :value="__('Obligatory subject')" />
                                <input id="obligatory" type="checkbox" name="obligatory" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    @if ($subject->is_obligatory)
                                        checked
                                    @endif
                                >
                                <x-input-error :messages="$errors->get('obligatory')" class="ml-2" />
                            </div>
    
                            <div class="mt-4">
                                <div class="mt-4">{{ __('Teachers in charge') }}</div>
                                <div class="flex flex-wrap">
                                    @foreach ($teachers as $teacher)
                                        <div class="mr-3 w-48">
                                            <input id="teacher_{{ $teacher->id }}" type="checkbox" name="teacher[]" value="{{ $teacher->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                @foreach ($subject->teachers as $teacherInCharge)
                                                    @if ($teacherInCharge->name == $teacher->name)
                                                        checked
                                                    @endif
                                                @endforeach
                                            >
                                            <label for="teacher_{{ $teacher->id }}" class="ml-1">{{ $teacher->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('teacher')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <div class="mt-4">{{ __('Target classes') }}</div>
                                <div class="flex flex-wrap">
                                    @foreach ($classes as $class)
                                        <div class="mr-3 w-12">
                                            <input id="class_{{ $class->id }}" type="checkbox" name="class[]" value="{{ $class->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                @foreach ($subject->classes as $targetClass)
                                                    @if ($targetClass->name == $class->name)
                                                        checked
                                                    @endif
                                                @endforeach
                                            >
                                            <label for="class_{{ $class->id }}" class="ml-1">{{ $class->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('class')" class="mt-2" />
                            </div>

                            <h2 class="text-lg mt-4">開講日時</h2>
                            <div class="border rounded p-4 dark:border-gray-700 dark:bg-slate-900">
                                <div class="flex w-full">
                                    <div class="mr-2">
                                        <x-input-label for="dayofweek" :value="__('Day of week')" />
                                        <select name="dayofweek" id="dayofweek" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                            <option value="">---選択してください---</option>
                                            @foreach ($dayOfWeeks as $i => $dayOfWeek)
                                                <option value="{{ $i }}"
                                                    @if ($dayOfWeeks[$subject->day_of_week_1] == $dayOfWeek)
                                                        selected
                                                    @endif
                                                >{{ $dayOfWeek }}</option>
                                            @endforeach
                                            <x-input-error :messages="$errors->get('dayofweek')" class="mt-2" />
                                        </select>
                                    </div>
                                    
                                    <div class="mr-2">
                                        <x-input-label for="period" :value="__('Period')" />
                                        <select name="period" id="period" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                            <option value="">---選択してください---</option>
                                            @foreach ($periods as $period)
                                                <option value="{{ $period }}"
                                                    @if ($subject->period_1 == $period)
                                                        selected
                                                    @endif
                                                >{{ $period }}</option>
                                            @endforeach
                                            <x-input-error :messages="$errors->get('period')" class="mt-2" />
                                        </select>
                                    </div>
                                </div>
        
                                <div class="mt-4 flex">
                                    <x-input-label for="inarow" :value="__('In a row')" />
                                    <input id="inarow" type="checkbox" name="inarow" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        @if ($subject->is_in_a_row_1)
                                            checked
                                        @endif
                                    >
                                    <x-input-error :messages="$errors->get('inarow')" class="ml-2" />
                                </div>
                                <div class="mt-4 w-full border-t border-t-white">
                                    <h3 class="mt-4">週2回授業がある場合はこちらも設定</h3>
                                    
                                    <div class="mt-4 flex w-full">    
                                        <div class="mr-2">
                                            <x-input-label for="dayofweek2" :value="__('Day of week')" />
                                            <select name="dayofweek2" id="dayofweek2" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus>
                                                <option value="">---選択してください---</option>
                                                @foreach ($dayOfWeeks as $i => $dayOfWeek)
                                                    <option value="{{ $i }}"
                                                        @if ($subject->day_of_week_2 && $dayOfWeeks[$subject->day_of_week_2] == $dayOfWeek)
                                                            selected
                                                        @endif
                                                    >{{ $dayOfWeek }}</option>
                                                @endforeach
                                                <x-input-error :messages="$errors->get('dayofweek2')" class="mt-2" />
                                            </select>
                                        </div>
                                        
                                        <div class="mr-2">
                                            <x-input-label for="period2" :value="__('Period')" />
                                            <select name="period2" id="period2" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus>
                                                <option value="">---選択してください---</option>
                                                @foreach ($periods as $period)
                                                    <option value="{{ $period }}"
                                                        @if ($subject->period_2 == $period)
                                                            selected
                                                        @endif
                                                    >{{ $period }}</option>
                                                @endforeach
                                                <x-input-error :messages="$errors->get('period2')" class="mt-2" />
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="mt-4 flex">
                                        <x-input-label for="inarow2" :value="__('In a row')" />
                                        <input id="inarow2" type="checkbox" name="inarow2" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            @if ($subject->is_in_a_row_2)
                                                checked
                                            @endif
                                        >
                                        <x-input-error :messages="$errors->get('inarow2')" class="ml-2" />
                                    </div>
                                </div>
                            </div>
    
                            <div class="mt-4">
                                <x-input-label for="syllabus" :value="__('Syllabus')" />
                                <x-text-input id="syllabus" class="block mt-1 w-full" type="text" name="syllabus" value="{{ $subject->syllabus }}" required autofocus />
                                <x-input-error :messages="$errors->get('syllabus')" class="mt-2" />
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
