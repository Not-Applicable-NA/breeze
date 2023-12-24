<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subject delete confirm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <h2 class="text-xl">
                            この科目を削除しますか？<br>
                            削除する場合は、もう一度削除ボタンを押してください。
                        </h2>
                    </div>
                    <div class="border mt-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <form method="POST" action="{{ route('subjects.delete.confirm') }}">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="subjectId" value="{{ $subject->id }}" />

                            <table class="mt-4 w-full border-collapse text-center">
                                <thead>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-t p-2">{{ $subject->name }}</td>
                                        <td class="border-t p-2">{{ $subject->credits }}単位</td>
                                        <td class="border-t p-2">{{ $subject->dividend_grade }}年</td>
                                        <td class="border-t p-2">
                                            @if ($subject->is_obligatory)
                                                ○
                                            @endif
                                        </td>
                                        <td class="border-t p-2">{{ $subject->semester }}</td>
                                        <td class="border-t p-2">
                                            {{ $subject->day_of_week_1 }}{{ $subject->period_1 }}@if ($subject->is_in_a_row_1), {{ $subject->period_1+1 }}@endif
                                            @if ( $subject->day_of_week_2)
                                                <br> {{ $subject->day_of_week_2 }}{{ $subject->period_2 }}@if ($subject->is_in_a_row_2), {{ $subject->period_2+1 }}@endif
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
                                                    {{ $targetCasses->name }}<br>
                                                @endforeach
                                            @else
                                                @foreach ( $classes as $class )
                                                    {{ $class->name }}<br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="border-t p-2">{{ $subject->syllabus }}</td>
                                        <td class="border-t p-2">
                                            <div class="flex items-center">
                                                <button type="submit" class="'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                    {{ __('Delete subject') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
