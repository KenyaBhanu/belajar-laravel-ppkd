@extends('main')
@section('content')
    <br>

    <form action="{{ route('action-bagi') }}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="number" placeholder="Masukkan Angka" name="angka_1">
        /
        <label for="">Angka 2</label>
        <input type="number" placeholder="Masukkan Angka" name="angka_2"><br>
        <button type="submit">Bagikan</button>
    </form>

    <h1>Hasilnya: {{ $hasil }}</h1>
@endsection
