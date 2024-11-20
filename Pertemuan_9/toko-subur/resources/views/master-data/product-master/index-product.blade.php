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

          <a href="{{ route('products-create') }}" class="inline-block mb-4">
              <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                  Tambah Data Produk
              </button>
          </a>
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
                      <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($data as $item)
                      <tr class="bg-white">
                          <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->product_name }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->unit }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->type }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->information }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->qty }}</td>
                          <td class="px-4 py-2 border border-gray-200">{{ $item->producer }}</td>
                          <td class="px-4 py-2 border border-gray-200">
                              <a href="{{ route('product-edit', $item->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                              <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('product-deleted', $item->id) }}')">Hapus</button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
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
