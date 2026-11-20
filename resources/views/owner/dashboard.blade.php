@extends('owner.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview')

@section('content')

    <div>
        <h2 class="text-2xl font-bold text-slate-900">
            Welcome back, {{ auth()->user()->username }} 👋
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Manage your restaurants, menu and orders from here.
        </p>
    </div>

@endsection