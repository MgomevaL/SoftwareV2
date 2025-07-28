@props(['item', 'fields'])

<tr {{ $attributes->merge(['class' => 'hover:bg-zinc-100 dark:hover:bg-zinc-800 transition']) }}>
    @foreach ($fields as $field)
        <td class="px-6 py-3">
            {{ data_get($item, $field) }}
        </td>
    @endforeach
</tr>

