@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Peserta PPDB</h1>
  </div>

  <div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Siswa</th>
          <th scope="col">Asal Sekolah</th>
          <th scope="col">Alamat</th>
          <th scope="col">Email</th>
          <th scope="col">No Telepon/WhatsApp</th>
          <th scope="col">Tanggal Pendaftaran</th>
        </tr>
      </thead>
      <tbody>
        @if ($ppdb->count())
          @foreach ($ppdb as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->nama_siswa }}</td>
            <td>{{ $data->asal_sekolah }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->email }}</td>
            <td>
              <a href="http://wa.me/{{ $data->no_tlp }}" target="_blank" rel="noopener noreferrer">
                {{ $data->no_tlp }}
              </a>
            </td>
            <td>{{ $data->created_at }}</td>
          </tr>
          @endforeach
        @else
        
          <tr>
            <td colspan="7" class="text-center">Belum ada Siswa yang mendaftar</td>
          </tr>

        @endif

      </tbody>
    </table>
  </div>

@endsection