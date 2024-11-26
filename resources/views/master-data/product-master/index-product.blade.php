<x-app-layout>
  <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="container p-4 mx-auto">
      <div class="overflow-x-auto">
          @if (session('success'))
              <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
                  {{ session('success') }}
              </div>
          @elseif (session('error'))
              <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
                  {{ session('error') }}
              </div>
          @endif

          <form method="GET" action="{{ route('product-index') }}" class="mb-4 flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            <button type="submit" class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Cari</button>
            </form>     

            <a href="{{ route('products-create') }}" class="inline-block mb-4">
                <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg transition-transform duration-200 transform hover:scale-105 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Tambah Data Produk
                </button>
            </a>
            
            <button id="exportButton" class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg transition-transform duration-200 transform hover:scale-105 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                Unduh Data Produk
            </button>
            
            <div id="dropdownMenu" class="absolute left-0 hidden mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg transform transition-transform scale-95 duration-300 ease-in-out">
                <a href="{{ route('product-export-excel') }}" class="block px-4 py-2 text-gray-800 hover:bg-green-100 transition-colors duration-200 ease-in-out">
                    Export Ke Excel
                </a>
                <a href="{{ route('products.export-pdf') }}" class="block px-4 py-2 text-gray-800 hover:bg-green-100 transition-colors duration-200 ease-in-out">
                    Export ke PDF
                </a>
            </div>
            
            <script>
                document.getElementById('exportButton').addEventListener('click', function() {
                    var dropdown = document.getElementById('dropdownMenu');
                    dropdown.classList.toggle('hidden');
                    dropdown.classList.toggle('scale-100');
                });
            
                // Menutup dropdown jika klik di luar
                window.addEventListener('click', function(event) {
                    if (!event.target.matches('#exportButton') && !event.target.closest('#dropdownMenu')) {
                        var dropdown = document.getElementById('dropdownMenu');
                        if (!dropdown.classList.contains('hidden')) {
                            dropdown.classList.add('hidden');
                            dropdown.classList.remove('scale-100');
                        }
                    }
                });
            </script>
            
            

<br><br>
          <table class="min-w-full border border-collapse border-gray-200">
              <thead>
                  <tr class="bg-gray-100">
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama Produk</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Satuan</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Jenis</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Informasi</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Jumlah</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Produsen</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Suplier Name</th>
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($products as $product)
                      <tr class="bg-white">
                          <td class="px-4 py-2 border border-gray-200">{{ $product->id }}</td>
                          <td class="px-4 py-2 border border-gray-200 hover:text-blue-500 hover:underline">
                            <a href="{{ route('product-detail',$product->id) }}">
                                {{ $product->product_name }}
                            </a>
                          </td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->unit }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->type }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->information }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->qty }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->producer }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $product->supplier->supplier_name ?? 'no supplier' }}</td>
                          <td class="px-4 py-2 border border-gray-200">
                              <a href="{{ route('product-edit', $product->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                              <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('product-deleted', $product->id) }}')">Hapus</button>
                          </td>
                      </tr>
                  @empty
                    <p class="mb-4 text-center text-2xl font-bold text-red-600">No Product Found</p>
                  @endforelse
              </tbody>
          </table>
          <div class="mt-4">
            {{ $products->appends(['search' => request('search')])->links() }}
          </div>
      </div>
  </div>

  <script>
      function confirmDelete(deleteUrl) {
          if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
              let form = document.createElement('form');
              form.method = 'POST';
              form.action = deleteUrl;

              let csrfInput = document.createElement('input');
              csrfInput.type = 'hidden';
              csrfInput.name = '_token';
              csrfInput.value = '{{ csrf_token() }}';
              form.appendChild(csrfInput);

              let methodInput = document.createElement('input');
              methodInput.type = 'hidden';
              methodInput.name = '_method';
              methodInput.value = 'DELETE';
              form.appendChild(methodInput);

              document.body.appendChild(form);
              form.submit();
          }
      }
  </script>
</x-app-layout>
