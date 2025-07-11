<div class="overflow-x-auto rounded-xl shadow border border-gray-200 dark:border-zinc-700">
    <table {{ $attributes->merge(['class' => 'min-w-full table-fixed divide-y divide-gray-300 dark:divide-zinc-700'])
        }}>
        <thead class="bg-zinc-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 uppercase text-xs">
            {{ $thead ?? '' }}
        </thead>
        <tbody
            class="bg-white dark:bg-zinc-900 text-gray-800 dark:text-gray-100 divide-y divide-gray-200 dark:divide-zinc-800">
            {{ $slot }}
        </tbody>
    </table>
</div>