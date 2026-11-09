@props(['status'])

@if ($status == 'layak')
    <span class="text-emerald-500">Layak saji</span>
@elseif ($status == 'dicicip')
    <span class="text-amber-400">Dicicip ulang</span>
@else
    <span class="text-black">Ditarik dari kelas</span>
@endif
