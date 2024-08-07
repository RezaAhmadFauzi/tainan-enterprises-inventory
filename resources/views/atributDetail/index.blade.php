@extends('template')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Atribut Detail</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            @auth
            @if (Auth::user()->role != 3)
            <a href="{{ route('create-atributDetail', $idAtribut) }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
            @endif
            @endauth
            <a href="{{ route('index-atribut') }}" class="btn btn-warning btn-icon-split">
                <span class="text">Kembali</span>
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Atribut Detail</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr {!! $loop->odd ? 'style="background: #F0F5F9;" ' : '' !!}>
                            <td class="wrap-all">{{ $loop->index + 1 }}</td>
                            <td>{{ $row['value'] }}</td>
                            <td>{{ $row['statusName'] }}</td>
                            <td>
                                @auth
                                @if (Auth::user()->role != 3)
                                <form action="{{ route('delete-atributDetail', $row->id) }}" method="POST">
                                    <a href="{{ route('edit-atributDetail', $row->id) }}" class="btn btn-primary btn-circle btn-sm">
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

