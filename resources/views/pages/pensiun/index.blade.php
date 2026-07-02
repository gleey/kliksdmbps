@extends('layouts.app')
@section('title', 'Pensiun')
@section('content')
<x-layanan-content :persyaratan="$persyaratan" :dokumen="$dokumen" title="Pensiun" />
@endsection
