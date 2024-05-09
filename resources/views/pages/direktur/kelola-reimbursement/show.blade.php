<x-app-layout>
    @section('title', 'Detail Reimbursement')
    <div class="py-12">
        <div class="max-w-5xl rounded-lg mx-auto sm:px-6 lg:px-8 bg-white shadow-md mb-4">
            <div class="max-w-4xl mx-auto py-6">
                <h5 class="py-1 mb-4 text-black font-bold text-xl text-center">Detail Pengajuan Reimbursement</h5>
                <div class="grid gap-x-4">
                    <div class="mb-4">
                        <div class="flex justify-between">
                            <div>
                                <label for="nama"
                                    class="block text-md text-black font-semibold">{{ $data->nama }}</label>
                                <label for="tanggal" class="block text-sm font-medium">Tanggal Pengajuan :
                                    {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</label>
                            </div>
                            <a href="{{ $data->file_pendukung }}" target="_blank">
                                <button
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-arrow-down"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                            <path
                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                        </svg>
                                        <p class="ml-1">File Pendukung</p>
                                    </div>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-justify text-black">{{ $data->deskripsi }}</label>
                    </div>
                    <div class="mb-4 text-end">
                    </div>
                </div>
                <div class="flex">
                    <form id="reimbursementForm" action="/kelola-reimbursement/{{ $data->id }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" id="status_pengajuan" name="status_pengajuan">
                        <input type="hidden" id="alasan_penolakan" name="alasan_penolakan">
                        
                        <button type="button" onclick="handlePengajuan('{{ $data->id }}', 'Ditolak')"
                            value="Ditolak" name="tolak_pengajuan"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Tolak
                            Pengajuan</button>
                        <button type="button" onclick="handlePengajuan('{{ $data->id }}', 'Disetujui')"
                            value="Disetujui" name="setujui_pengajuan"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Setujui Pengajuan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function handlePengajuan(id, status) {
            if (status === 'Ditolak') {
                const {
                    value: alasan
                } = await Swal.fire({
                    title: "Penolakan Pengajuan",
                    input: "select",
                    inputOptions: {
                        "Data Tidak Lengkap": "Data Tidak Lengkap",
                        "Data Tidak Sesuai": "Data Tidak Sesuai"
                    },
                    inputPlaceholder: "Pilih Alasan Penolakan Pengajuan",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value !== "") {
                                resolve();
                            } else {
                                resolve("Anda perlu memilih alasan penolakan");
                            }
                        });
                    }
                });

                if (alasan) {
                    document.getElementById("status_pengajuan").value = 'Ditolak';
                    document.getElementById("alasan_penolakan").value = alasan;
                    document.getElementById("reimbursementForm").submit();
                }
            } else {
                document.getElementById("status_pengajuan").value = 'Disetujui';
                document.getElementById("reimbursementForm").submit();
            }
        }
    </script>
</x-app-layout>
