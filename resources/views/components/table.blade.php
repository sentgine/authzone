<div class="overflow-auto min-w-[300px] rounded-lg bg-gray-50 dark:bg-gray-900">
    <div class="grid grid-cols-1 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 sm:flex justify-end gap-3 py-4 px-5">
            @isset($top)
            {{ $top }}
            @endisset
        </div>
        <table class="min-w-[400px]">
            <thead class="bg-gray-800 dark:bg-gray-950 text-white">
                <tr class="text-left">
                    @isset($heading)
                    {{
                        $heading
                    }}
                    @endisset
                </tr>
            </thead>
            <tbody>
                @isset($body)
                {{
                    $body
                }}
                @endisset
            </tbody>
            <tfoot class="w-full">
                <tr>
                    <td colspan="3" class="py-4"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="mt-5 px-10 py-2 dark:bg-gray-200">
        @isset($bottom)
        {{ $bottom }}
        @endisset
    </div>
</div>
