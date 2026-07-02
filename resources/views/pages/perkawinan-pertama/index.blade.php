@extends('layouts.app')
@section('title', 'Perkawinan Pertama')
@section('content')
<x-layanan-content :persyaratan="$persyaratan" :dokumen="$dokumen" title="Perkawinan Pertama" />
@endsection
