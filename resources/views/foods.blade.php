@extends('layouts.base')

@section('content')
    <div class="card p-5">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData">
                Tambah Quote
            </button>
        </div>
        <table class="table datatable-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ACTION</th>
                    <th>NAMA</th>
                    <th>HARGA</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> <button type="button" title="EDIT" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                data-bs-target="#updateData" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                data-harga="{{ $item->harga }}"
                                data-url="{{ route('orders.update', ['id' => $item->id]) }}">
                                <i class="bi bi-pen"></i>
                                UP
                            </button>
                            <form id="deleteForm" action="{{ route('orders.destroy', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="DELETE" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                    DEL
                                </button>
                            </form>
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- Modal -->
        <div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="updateDataLabel" aria-hidden="true">
            <div class="modal-dialog" id="updateDialog">
                <div id="modal-content" class="modal-content">
                    <div class="modal-body">
                        Loading..
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createDataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div id="modal-content" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Quote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kalimat">nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-require" id="nama" name="nama"
                                    placeholder="Masukan nama" required>
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="harga">harga</label>
                                <input type="text" class="form-control form-require" id="harga" name="harga"
                                    placeholder="Masukan harga" required>
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        $(function() {
            var table = $('#datatable-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },

                ]
            });
        });

        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="post">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama">nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-require" id="nama" name="nama"
                            placeholder="Masukan nama" value="${$(e.relatedTarget).data('nama')}" required>
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />

                    </div>
                    <div class="mb-3">
                        <label for="harga">harga</label>
                        <input type="text" class="form-control form-require" id="harga" name="harga"
                            placeholder="Masukan harga" value="${$(e.relatedTarget).data('harga')}" required>
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        `;
            $('#modal-content').html(html);
        });
    </script>
@endsection
