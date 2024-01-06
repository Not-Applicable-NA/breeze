<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            削除確認
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <h2 class="text-xl">
                            削除する場合は、もう一度削除ボタンを押してください。
                        </h2>
                    </div>
                    <div class="border mt-4 p-4 rounded dark:border-gray-700 bg-slate-800">
                        <form method="POST" action="{{ route('teachers.delete.confirm') }}">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="teacherId" value="{{ $teacher->id }}" />

                            <table class="mt-4 w-full border-collapse text-center">
                                <thead>
                                    <tr>
                                        <th class="p-2">教員氏名</th>
                                        <th class="p-2">メールアドレス</th>
                                        <th class="p-2">研究室番号</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-t p-2">{{ $teacher->name }}</td>
                                        <td class="border-t p-2">{{ $teacher->email }}</td>
                                        <td class="border-t p-2">{{ $teacher->laboratory_no }}</td>
                                        <td class="border-t p-2">
                                            <div class="flex justify-center items-center">
                                                <button type="submit" class="'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                                                    削除
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
