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
                    <div class="border mb-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <form method="POST" action="{{ route('subjects.add') }}">
                            @csrf
    
                            <div>
                                <x-input-label for="name" :value="__('Subject name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <div class="mt-4 flex flex-wrap w-full">
                                <div class="mr-2">
                                    <x-input-label for="credits" :value="__('Credits')" />
                                    <select name="credits" id="credits" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($credits as $credit)
                                            <option value="{{ $credit }}">{{ $credit }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('credits')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="grade" :value="__('Dividend grade')" />
                                    <select name="grade" id="grade" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade }}">{{ $grade }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="semester" :value="__('Semester')" />
                                    <select name="semester" id="semester" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="">---選択してください---</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester }}">{{ $semester }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                                </div>
    
                                <div class="mr-2">
                                    <x-input-label for="room" :value="__('Main lecture room')" />
                                    <x-text-input id="room" class="block mt-1 w-full" type="text" name="room" required autofocus />
                                    <x-input-error :messages="$errors->get('room')" class="mt-2" />
                                </div>
                            </div>
    
                            <div class="mt-4 flex">
                                <x-input-label for="obligatory" :value="__('Obligatory subject')" />
                                <input id="obligatory" type="checkbox" name="obligatory" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <x-input-error :messages="$errors->get('obligatory')" class="ml-2" />
                            </div>
    
                            <div class="mt-4">
                                <div class="mt-4">{{ __('Teachers in charge') }}</div>
                                <div class="flex flex-wrap">
                                    @foreach ($teachers as $teacher)
                                        <div class="mr-3 w-40">
                                            <input id="teacher_{{ $teacher->id }}" type="checkbox" name="teacher[]" value="{{ $teacher->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
                                            <input id="class_{{ $class->id }}" type="checkbox" name="class[]" value="{{ $class->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
                                                <option value="{{ $i }}">{{ $dayOfWeek }}</option>
                                            @endforeach
                                            <x-input-error :messages="$errors->get('dayofweek')" class="mt-2" />
                                        </select>
                                    </div>
                                    
                                    <div class="mr-2">
                                        <x-input-label for="period" :value="__('Period')" />
                                        <select name="period" id="period" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                            <option value="">---選択してください---</option>
                                            @foreach ($periods as $period)
                                                <option value="{{ $period }}">{{ $period }}</option>
                                            @endforeach
                                            <x-input-error :messages="$errors->get('period')" class="mt-2" />
                                        </select>
                                    </div>
                                </div>
        
                                <div class="mt-4 flex">
                                    <x-input-label for="inarow" :value="__('In a row')" />
                                    <input id="inarow" type="checkbox" name="inarow" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
                                                    <option value="{{ $i }}">{{ $dayOfWeek }}</option>
                                                @endforeach
                                                <x-input-error :messages="$errors->get('dayofweek2')" class="mt-2" />
                                            </select>
                                        </div>
                                        
                                        <div class="mr-2">
                                            <x-input-label for="period2" :value="__('Period')" />
                                            <select name="period2" id="period2" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus>
                                                <option value="">---選択してください---</option>
                                                @foreach ($periods as $period)
                                                    <option value="{{ $period }}">{{ $period }}</option>
                                                @endforeach
                                                <x-input-error :messages="$errors->get('period2')" class="mt-2" />
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="mt-4 flex">
                                        <x-input-label for="inarow2" :value="__('In a row')" />
                                        <input id="inarow2" type="checkbox" name="inarow2" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <x-input-error :messages="$errors->get('inarow2')" class="ml-2" />
                                    </div>
                                </div>
                            </div>
    
                            <div class="mt-4">
                                <x-input-label for="syllabus" :value="__('Syllabus')" />
                                <x-text-input id="syllabus" class="block mt-1 w-full" type="text" name="syllabus" required autofocus />
                                <x-input-error :messages="$errors->get('syllabus')" class="mt-2" />
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Add subject') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <div class="border-t-2 pt-4">
                        <h2 class="text-xl">履修科目を選択し、登録ボタンをクリックしてください。</h2>
                        
                        <form method="POST" action="{{ route('subjects.taken.add') }}">
                            @csrf
                            
                            <div class="flex items-center justify-end">
                                <x-primary-button class="ml-3">
                                    登録
                                </x-primary-button>
                            </div>
                            <div class="mt-4 overflow-auto h-[720px]">
                                <table class="w-full border-collapse text-center whitespace-nowrap">
                                    <thead class="sticky top-0 dark:bg-slate-900">
                                        <tr>
                                            <th class="p-2">科目名</th>
                                            <th class="p-2">単位数</th>
                                            <th class="p-2">配当年次</th>
                                            <th class="p-2">必修科目</th>
                                            <th class="p-2">開講学期</th>
                                            <th class="p-2">開講日時</th>
                                            <th class="p-2">主教室</th>
                                            <th class="p-2">担当教員</th>
                                            <th class="p-2">対象クラス</th>
                                            <th class="p-2">シラバス</th>
                                            <th class="p-2"></th>
                                            <th class="p-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $subjects as $subject )
                                            <tr>
                                                <td class="border-t p-2">
                                                    <input id="subject_{{ $subject->id }}" type="checkbox" name="subject[]" value="{{ $subject->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                    <label for="subject_{{ $subject->id }}" class="ml-1">{{ $subject->name }}</label>
                                                </td>
                                                <td class="border-t p-2">{{ $subject->credits }}単位</td>
                                                <td class="border-t p-2">{{ $subject->dividend_grade }}年</td>
                                                <td class="border-t p-2">
                                                    @if ($subject->is_obligatory)
                                                        ○
                                                    @endif
                                                </td>
                                                <td class="border-t p-2">{{ $subject->semester }}</td>
                                                <td class="border-t p-2">
                                                    {{ $dayOfWeeks[$subject->day_of_week_1] }}{{ $subject->period_1 }}@if ($subject->is_in_a_row_1), {{ $subject->period_1+1 }}@endif
                                                    @if ( $subject->day_of_week_2 )
                                                        <br> {{ $dayOfWeeks[$subject->day_of_week_2] }}{{ $subject->period_2 }}@if ($subject->is_in_a_row_2), {{ $subject->period_2+1 }}@endif
                                                    @endif
                                                </td>
                                                <td class="border-t p-2">{{ $subject->main_lecture_room }}</td>
                                                <td class="border-t p-2">
                                                    @foreach ( $subject->teachers as $teacherInCharge )
                                                        {{ $teacherInCharge->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td class="border-t p-2">
                                                    @if ($subject->classes->isNotEmpty())
                                                        @foreach ( $subject->classes as $targetCasses )
                                                            {{ $targetCasses->name }},
                                                        @endforeach
                                                    @else
                                                        @foreach ( $classes as $class )
                                                            {{ $class->name }}, 
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="border-t p-2 whitespace-normal">{{ $subject->syllabus }}</td>
                                                <td class="border-t p-2">
                                                    <div class="flex justify-center items-center">
                                                        <a href="{{ route('subjects.edit', ['id' => $subject->id]) }}" class="'inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                            編集
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="border-t p-2">
                                                    <div class="flex justify-center items-center">
                                                        <a href="{{ route('subjects.delete', ['id' => $subject->id]) }}" class="'inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                            削除
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
