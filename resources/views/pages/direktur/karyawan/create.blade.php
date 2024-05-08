<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl rounded-lg mx-auto sm:px-6 lg:px-8 bg-white shadow-md mb-4">
            <div class="max-w-4xl mx-auto py-6">
                <div class="py-4">
                    <h5 class="py-2 mb-3 text-primary"><span class="text-black font-semibold">Tambah Karyawan</h5>
                </div>
                <form action="/karyawan" method="POST" enctype="multipart/form-data" id="addKaryawanForm">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Nama Karyawan" required>
                    </div>
                    <div class="mb-4">
                        <label for="NIP" class="block text-sm font-medium">NIP </label>
                        <input type="number" name="NIP" id="NIP" 
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan NIP Maksimal 18 Digit" required>
                    </div>
                    <div class="mb-4">
                        <label for="jabatan" class="block text-sm font-medium">Jabatan</label>
                        <select name="jabatan"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option selected disabled>Pilih Jabatan</option>
                            <option value="Finance">Finance</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Password" required>
                    </div>
                    <div class="flex justify-end">
                        <a href="/karyawan">
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
