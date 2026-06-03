@extends('main')
@section('content')
    <br>

    <form action="{{ route('action-kali') }}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="number" placeholder="Masukkan Angka" name="angka_1">
        *
        <label for="">Angka 2</label>
        <input type="number" placeholder="Masukkan Angka" name="angka_2"><br>
        <button type="submit">Kalikan</button>
    </form>

    <h1>Hasilnya: {{ $hasil }}</h1>
@endsection
