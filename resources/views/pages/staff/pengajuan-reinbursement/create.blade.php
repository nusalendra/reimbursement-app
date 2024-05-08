<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl rounded-lg mx-auto sm:px-6 lg:px-8 bg-white shadow-md mb-4">
            <div class="max-w-4xl mx-auto py-6">
                <h5 class="py-1 mb-4 text-black font-semibold text-xl">Pengajuan Reimbursement</h5>
                <form action="/pengajuan-reimbursement" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium">Tanggal (bulan/tanggal/tahun) <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium">Nama Reimbursement <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Nama Reimbursement" required>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea id="message" rows="4" name="deskripsi"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="file_pendukung" class="block text-sm font-medium">File Pendukung <small>(JPEG, JPG,
                                PNG, PDF)</small> <span class="text-red-500">*</span></label>
                        <input type="file" name="file_pendukung" id="file_pendukung" accept=".jpg, .jpeg, .png, .pdf"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <a href="/pengajuan-reimbursement">
                            <button type="button"
                                class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</button>
                        </a>
                        <div class="ms-2">
                            <button type="submit"
                                class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal').value = today;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error!',
                html: @foreach ($errors->all() as $error)
                    '{{ $error }}<br>',
                @endforeach
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
</x-app-layout>
