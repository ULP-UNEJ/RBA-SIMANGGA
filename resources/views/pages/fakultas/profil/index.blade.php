@extends('layouts.app')

@section('content')
    <h4 class="fw-semibold mb-4">{{ $title }}</h4>
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Visi</h5>
                <button class="btn btn-sm btn-icon">
                    <i class="ti ti-pencil"></i>
                </button>
            </div>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Misi</h5>
                <button class="btn btn-sm btn-icon">
                    <i class="ti ti-pencil"></i>
                </button>
            </div>
            <p class="card-text">
                @if ()
                    
                @endif
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Kelompok Diferensiasi</h5>
                <button class="btn btn-sm btn-icon">
                    <i class="ti ti-pencil"></i>
                </button>
            </div>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
        </div>
    </div>
@endsection
