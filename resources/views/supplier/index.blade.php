@extends('template')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Supplier</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @auth
        @if (Auth::user()->role != 3)
        <div class="card-header py-3">
            <a href="{{ route('create-supplier') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
        </div>
        @endif
        @endauth
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr {!! $loop->odd ? 'style="background: #F0F5F9;" ' : '' !!}>
                            <td class="wrap-all">{{ $loop->index + 1 }}</td>
                            <td>{{ $row['nama_supplier'] }}</td>
                            <td>{{ $row['alamat'] }}</td>
                            <td>{{ $row['statusName'] }}</td>
                            <td>
                                @auth
                                @if (Auth::user()->role != 3)
                                <form action="{{ route('delete-supplier', $row->id) }}" method="POST">
                                    <a href="{{ route('edit-supplier', $row->id) }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

