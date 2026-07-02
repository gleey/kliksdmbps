@extends('layouts.app')
@section('title', 'Tugas Belajar')
@section('content')
<x-layanan-content :persyaratan="$persyaratan" :dokumen="$dokumen" title="Tugas Belajar" />
@endsection
