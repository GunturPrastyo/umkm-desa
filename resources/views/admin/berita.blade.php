@extends('layouts.admin')

@section('content')
    <div class="pl-2 pr-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div
            class="items-center justify-center max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

            {{-- Tombol Tambah Data --}}
            <button type="button" data-modal-target="tambah-Sosmed" data-modal-toggle="tambah-Sosmed"
                class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                       focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex 
                       items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Data
            </button>

            {{-- Modal Tambah --}}
            @include('components.admin.modalTambah-Sosmed')

            <table class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Instagram</th>
                        <th class="px-4 py-3">Facebook</th>
                        <th class="px-4 py-3">Youtube</th>
                        <th class="px-4 py-3">Website</th>
                        <th class="px-4 py-3">Twitter</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    @foreach ($sosmeds as $item)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">
                                @if($item->instagram)
                                    <a href="{{ $item->instagram }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $item->instagram }}
                                    </a>
                                @else - @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($item->facebook)
                                    <a href="{{ $item->facebook }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $item->facebook }}
                                    </a>
                                @else - @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($item->youtube)
                                    <a href="{{ $item->youtube }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $item->youtube }}
                                    </a>
                                @else - @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($item->website)
                                    <a href="{{ $item->website }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $item->website }}
                                    </a>
                                @else - @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($item->twitter)
                                    <a href="{{ $item->twitter }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $item->twitter }}
                                    </a>
                                @else - @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                {{-- Tombol Edit --}}
                                <button type="button" data-modal-target="edit-Sosmed-{{ $item->id }}"
                                    data-modal-toggle="edit-Sosmed-{{ $item->id }}"
                                    class="text-yellow-600 hover:underline font-medium text-sm">
                                    Edit
                                </button>

                                @include('components.admin.modalEdit-Sosmed', ['sosmed' => $item])

                                {{-- Tombol Hapus --}}
                                <button onclick="deleteForm('{{ route('admin.sosmed.destroy', $item->id) }}')"
                                    class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {{-- Modal Hapus --}}
        @include('components.admin.modal-hapus')
    </div>
@endsection
