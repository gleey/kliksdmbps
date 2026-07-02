@extends('layouts.app')
@section('title', 'KARIS/KARSU')
@section('content')
<x-layanan-content :persyaratan="$persyaratan" :dokumen="$dokumen" title="KARIS/KARSU" />
@endsection
