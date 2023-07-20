<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('List Kategori Barang') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 flex justify-between">
                  {{ __("List Kategori Barang") }}
                  <button class="btn btn-sm btn-neutral" onClick="showForm()">TAMBAH KATEGORI</button>
              </div>
              <div class="overflow-x-auto px-6">
                <table class="table" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>

  <div id="showForm"></div>
</x-app-layout>