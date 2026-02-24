<div id="tambah-Sosmed" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
           justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Sosial Media
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                       rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 
                       dark:hover:text-white" data-modal-hide="tambah-Sosmed">
                    ✕
                </button>
            </div>
            <form action="{{ route('admin.sosmed.store') }}" method="POST" class="p-4">
                @csrf
                <div class="grid gap-4 mb-4">
                    <input type="url" name="instagram" placeholder="Instagram URL" class="input-form">
                    <input type="url" name="facebook" placeholder="Facebook URL" class="input-form">
                    <input type="url" name="youtube" placeholder="Youtube URL" class="input-form">
                    <input type="url" name="website" placeholder="Website URL" class="input-form">
                    <input type="url" name="twitter" placeholder="Twitter URL" class="input-form">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm 
                               px-5 py-2.5 text-center">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
