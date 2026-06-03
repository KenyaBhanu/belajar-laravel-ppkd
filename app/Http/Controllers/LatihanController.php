<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        return view('latihan');
    }

    public function tambah()
    {
        $hasil = 0;
        $title = 'Penjumlahan';
        return view('tambah', compact('hasil', 'title'));
    }

    public function actionTambah(Request $request)
    {
        $angka1 = $request->angka_1;
        $angka2 = $request->input('angka_2');
        $hasil = $angka1 + $angka2;

        return view('tambah', compact('hasil'));
    }

    public function kurang()
    {
        $hasil = 0;
        $title = 'Pengurangan';
        return view('kurang', compact('hasil', 'title'));
    }

    public function actionKurang(Request $request)
    {
        $angka1 = $request->angka_1;
        $angka2 = $request->input('angka_2');
        $hasil = $angka1 - $angka2;

        return view('kurang', compact('hasil'));
    }

    public function kali()
    {
        $hasil = 0;
        $title = 'Perkalian';
        return view('kali', compact('hasil', 'title'));
    }

    public function actionKali(Request $request)
    {
        $angka1 = $request->angka_1;
        $angka2 = $request->input('angka_2');
        $hasil = $angka1 * $angka2;

        return view('kali', compact('hasil'));
    }

    public function bagi()
    {
        $hasil = 0;
        $title = 'Pembagian';
        return view('bagi', compact('hasil', 'title'));
    }

    public function actionBagi(Request $request)
    {
        $angka1 = $request->angka_1;
        $angka2 = $request->input('angka_2');
        $hasil = $angka1 / $angka2;

        return view('bagi', compact('hasil'));
    }
}
