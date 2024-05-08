<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl rounded-md mx-auto text-end">
            <a href="/pengajuan-reimbursement/create">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <div class="flex items-center">
                        <p>Ajukan Reimbursement</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="ms-1 bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                        </svg>
                    </div>
                </button>
            </a>
        </div>
        <div class="max-w-7xl rounded-md mx-auto sm:px-6 lg:px-8 bg-white">
            <div class="card">
                <h5 class="font-bold py-4 text-lg">Data Pengajuan Reimbursement</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table-auto min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Tanggal Pengajuan</th>
                                    <th class="px-4 py-2 text-left">Nama Reimbursement</th>
                                    <th class="px-4 py-2 text-left">Diajukan Oleh</th>
                                    <th class="px-4 py-2 text-left">Status Pengajuan</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td class="border px-4 py-2">{{ $item->nama }}</td>
                                        <td class="border px-4 py-2">{{ $item->user->nama }}</td>
                                        <td class="border px-4 py-2">{{ $item->status_pengajuan }}</td>
                                        <td class="border px-4 py-2 flex items-center justify-center">
                                            <div class="flex py-1">
                                                <div class="flex flex-col justify-center items-center">
                                                    <a href="/pengajuan-reimbursement/{{ $item->id }}">
                                                        <button type="button"
                                                            class="focus:outline-none text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-green-900">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-pip"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                                                    <path
                                                                        d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5z" />
                                                                </svg>
                                                                <p class="ms-2">Detail</p>
                                                            </div>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            @if ($item->status_pengajuan == 'Diajukan')
                                                <div class="flex py-1">
                                                    <div class="flex flex-col justify-center items-center">
                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="/pengajuan-reimbursement/{{ $item->id }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                onclick="batalkanPengajuan({{ $item->id }})"
                                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                                <div class="flex items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                                                        <path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293z"/>
                                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                                                      </svg>
                                                                    <p class="ms-2">Batalkan</p>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function batalkanPengajuan(id) {
                    Swal.fire({
                        title: "Pembatalan Pengajuan?",
                        text: "Reimbrusement akan dibatalkan secara permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Batalkan Pengajuan"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>
        </div>
    </div>
</x-app-layout>
