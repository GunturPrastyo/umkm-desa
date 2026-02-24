<section id="umkm"
    class="bg-gradient-to-l from-gray-100 to-gray-200 
           dark:from-gray-800 dark:to-gray-900 py-16 px-4 mx-auto transition-colors duration-300"
    style="font-family: 'Poppins', sans-serif;" x-data="{
        kategori: 'semua',
        search: '',
        showDetailModal: false,
        selectedUmkm: null
    }">

    <!-- Inject data UMKM ke Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('umkms', @json($umkms->items()));
        });
    </script>


    <div
        class="max-w-7xl mx-auto">

        <!-- Kata Pembuka -->
        <div class="text-center mb-12 dark:text-white px-4">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                UMKM Desa Tirtomulyo
            </h2>
            <div class="w-24 h-1 bg-yellow-500 mx-auto rounded-full mb-4"></div>
            <p
                class="text-base text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Temukan berbagai produk unggulan dari UMKM Desa, mulai dari makanan, minuman, hingga jasa.
                Dukung ekonomi lokal dengan membeli produk asli desa.
            </p>
        </div>


        <!-- Filter + Pencarian -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10 bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Kategori -->
            <div class="flex flex-wrap gap-2">
                <template x-for="kat in ['semua','Makanan & Minuman','Pertanian','Fesyen & Tekstil','Jasa','Lainnya']"
                    :key="kat">
                    <button class="px-5 py-2.5 rounded-full border text-sm font-medium capitalize transition-all duration-300"
                        :class="kategori === kat ?
                            'bg-yellow-400 text-white border-yellow-500' :
                            'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-200 border-gray-300 dark:border-gray-600'"
                        @click="kategori = kat" x-text="kat">
                    </button>
                </template>
            </div>


            <!-- Pencarian -->
            <div class="relative w-full lg:w-1/3">
                <input type="text" placeholder="Cari produk..." x-model="search"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
               placeholder-gray-400 dark:placeholder-gray-300 
               focus:ring-2 focus:ring-yellow-400 focus:outline-none transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 absolute left-3 top-2.5 
               text-gray-400 dark:text-gray-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                </svg>
            </div>

        </div>

        <!-- Grid Card -->
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
            <template
                x-for="umkm in $store.umkms.filter(u => (kategori === 'semua' || u.kategori === kategori) 
                                                              && u.nama_produk.toLowerCase().includes(search.toLowerCase()))"
                :key="umkm.id">
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:-translate-y-1 flex flex-col overflow-hidden h-full">
                    
                    <!-- Gambar -->
                    <div class="relative h-56 overflow-hidden">
                        <img :src="umkm.primary_photo ? '/storage/' + umkm.primary_photo : 'https://via.placeholder.com/400x300?text=No+Image'"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="Foto Produk">
                        
                        <!-- Badge Kategori -->
                        <span class="absolute top-3 left-3 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm"
                              x-text="umkm.kategori"></span>
                    </div>

                    <!-- Konten -->
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 line-clamp-1 mb-1" x-text="umkm.nama_produk"></h3>
                        
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                            <i class="fas fa-store text-yellow-500 mr-2"></i>
                            <span class="truncate" x-text="umkm.nama_pemilik"></span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-4 flex-grow"
                            x-text="umkm.deskripsi">
                        </p>

                        <button class="w-full bg-gray-50 dark:bg-gray-700 hover:bg-yellow-400 dark:hover:bg-yellow-500 text-gray-800 dark:text-gray-200 hover:text-white py-2.5 rounded-xl font-medium transition-colors duration-300 flex items-center justify-center gap-2 group-hover:bg-yellow-400 group-hover:text-white"
                            @click="selectedUmkm = umkm; showDetailModal=true;">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-4">
            {{ $umkms->links() }}
        </div>

    </div>

    <!-- Modal Detail -->
    <div x-show="showDetailModal" x-transition.opacity.scale.95
        class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display: none;">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showDetailModal=false"></div>

        <div
            class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto transform transition-all"
            x-data="{ currentImg: 0 }">
            
            <!-- Tombol Close -->
            <button @click="showDetailModal=false"
                class="absolute top-4 right-4 z-10 bg-white/50 dark:bg-black/50 hover:bg-red-500 hover:text-white text-gray-800 dark:text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors backdrop-blur-md">
                <i class="fas fa-times text-lg"></i>
            </button>

            <div class="flex flex-col md:flex-row h-full">
                
                <!-- Kolom Kiri: Galeri Foto -->
                <div class="w-full md:w-1/2 bg-gray-100 dark:bg-gray-900 p-6 flex flex-col justify-center">
                    <!-- Main Image -->
                    <div class="relative aspect-[4/3] rounded-xl overflow-hidden shadow-lg mb-4 bg-white dark:bg-gray-800">
                        <template x-if="selectedUmkm && selectedUmkm.photos && selectedUmkm.photos.length > 0">
                            <img :src="'/storage/' + selectedUmkm.photos[currentImg].photo"
                                class="w-full h-full object-contain"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100">
                        </template>
                        <template x-if="selectedUmkm && (!selectedUmkm.photos || selectedUmkm.photos.length === 0)">
                             <img :src="selectedUmkm && selectedUmkm.primary_photo ? '/storage/' + selectedUmkm.primary_photo : 'https://via.placeholder.com/400x300?text=No+Image'"
                                class="w-full h-full object-cover">
                        </template>
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide justify-center" 
                         x-show="selectedUmkm && selectedUmkm.photos && selectedUmkm.photos.length > 1">
                        <template x-for="(img, index) in selectedUmkm ? selectedUmkm.photos : []" :key="index">
                            <button @click="currentImg = index"
                                class="w-16 h-16 rounded-lg overflow-hidden border-2 transition-all flex-shrink-0"
                                :class="currentImg === index ? 'border-yellow-500 ring-2 ring-yellow-500/30' : 'border-transparent opacity-60 hover:opacity-100'">
                                <img :src="'/storage/' + img.photo" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi -->
                <div class="w-full md:w-1/2 p-6 md:p-8 overflow-y-auto">
                    
                    <!-- Header Info -->
                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 text-xs font-bold uppercase tracking-wider mb-2"
                              x-text="selectedUmkm ? selectedUmkm.kategori : ''"></span>
                        
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2"
                            x-text="selectedUmkm ? selectedUmkm.nama_produk : ''"></h2>
                        
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase">Pemilik</p>
                                <p class="font-medium text-sm" x-text="selectedUmkm ? selectedUmkm.nama_pemilik : ''"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wide mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-sm text-justify"
                           x-text="selectedUmkm ? selectedUmkm.deskripsi : ''"></p>
                    </div>

                    <!-- Tombol Aksi (Marketplace) -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wide mb-3">Pesan Sekarang</h3>
                        <div class="grid grid-cols-2 gap-3">
                            
                            <!-- WhatsApp -->
                            <a x-show="selectedUmkm && selectedUmkm.link_wa" 
                               :href="'https://wa.me/' + selectedUmkm.link_wa" target="_blank"
                               class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                <i class="fab fa-whatsapp text-xl"></i>
                                <span class="font-medium">WhatsApp</span>
                            </a>

                            <!-- Shopee -->
                            <a x-show="selectedUmkm && selectedUmkm.link_shopee" 
                               :href="selectedUmkm.link_shopee" target="_blank"
                               class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                <i class="fas fa-shopping-bag text-xl"></i>
                                <span class="font-medium">Shopee</span>
                            </a>

                            <!-- Tokopedia -->
                            <a x-show="selectedUmkm && selectedUmkm.link_tokopedia" 
                               :href="selectedUmkm.link_tokopedia" target="_blank"
                               class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                <i class="fas fa-store text-xl"></i>
                                <span class="font-medium">Tokopedia</span>
                            </a>

                            <!-- TikTok -->
                            <a x-show="selectedUmkm && selectedUmkm.link_tiktok" 
                               :href="selectedUmkm.link_tiktok" target="_blank"
                               class="flex items-center justify-center gap-2 bg-black hover:bg-gray-800 text-white py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                <i class="fab fa-tiktok text-xl"></i>
                                <span class="font-medium">TikTok</span>
                            </a>
                        </div>
                        
                        <!-- Fallback jika tidak ada link -->
                        <div x-show="selectedUmkm && !selectedUmkm.link_wa && !selectedUmkm.link_shopee && !selectedUmkm.link_tokopedia && !selectedUmkm.link_tiktok"
                             class="text-center py-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-gray-500 text-sm italic">
                            Belum ada link pembelian online tersedia.
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div x-show="selectedUmkm && selectedUmkm.lokasi">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wide mb-3">Lokasi</h3>
                        <div class="rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 aspect-video w-full">
                            <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full" x-html="selectedUmkm.lokasi"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
