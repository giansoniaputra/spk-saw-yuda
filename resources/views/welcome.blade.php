@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <h1>Menu</h1>
    </div>
</div>
<div class="row">
    <div class="col-6 col-sm-4 col-xl-3" style="cursor: pointer" onclick="return document.location.href = '/kriteria' ">
        <div class="card mb-5">
            <div class="card-body text-center align-items-center d-flex flex-column justify-content-between">
                <div class="d-flex rounded-xl bg-gradient-light sw-6 sh-6 mb-3 justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-pepper text-white">
                        <path d="M13 11.3333C13 15.0152 11.125 18 10 18C8.875 18 7 15.0152 7 11.3333C7 7.65144 7.29167 6 10 6C12.7083 6 13 7.65144 13 11.3333Z"></path>
                        <path d="M11 17.5C12.4471 17.4093 16.1356 16.6825 16.7696 13.3675 17.4035 10.0525 18.6096 7.29223 14.9118 6.58509 13.5768 6.3298 13.119 6.7133 12.4304 7.00002M9 17.5C7.5529 17.4093 3.86436 16.6825 3.23041 13.3675 2.59647 10.0525 1.39044 7.29223 5.08821 6.58509 6.42318 6.3298 6.881 6.7133 7.56958 7.00002"></path>
                        <path d="M10 6L9.37873 3.51493C9.15615 2.62459 8.35618 2 7.43845 2H7"></path>
                    </svg>
                </div>
                <p class="card-text mb-2 d-flex">Kriiteria</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-4 col-xl-3" style="cursor: pointer" onclick="return document.location.href = '/alternatif' ">
        <div class="card mb-5">
            <div class="card-body text-center align-items-center d-flex flex-column justify-content-between">
                <div class="d-flex rounded-xl bg-gradient-light sw-6 sh-6 mb-3 justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-pepper text-white">
                        <path d="M13 11.3333C13 15.0152 11.125 18 10 18C8.875 18 7 15.0152 7 11.3333C7 7.65144 7.29167 6 10 6C12.7083 6 13 7.65144 13 11.3333Z"></path>
                        <path d="M11 17.5C12.4471 17.4093 16.1356 16.6825 16.7696 13.3675 17.4035 10.0525 18.6096 7.29223 14.9118 6.58509 13.5768 6.3298 13.119 6.7133 12.4304 7.00002M9 17.5C7.5529 17.4093 3.86436 16.6825 3.23041 13.3675 2.59647 10.0525 1.39044 7.29223 5.08821 6.58509 6.42318 6.3298 6.881 6.7133 7.56958 7.00002"></path>
                        <path d="M10 6L9.37873 3.51493C9.15615 2.62459 8.35618 2 7.43845 2H7"></path>
                    </svg>
                </div>
                <p class="card-text mb-2 d-flex">Alternatif</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-4 col-xl-3" style="cursor: pointer" onclick="return document.location.href = '/perhitungan' ">
        <div class="card mb-5">
            <div class="card-body text-center align-items-center d-flex flex-column justify-content-between">
                <div class="d-flex rounded-xl bg-gradient-light sw-6 sh-6 mb-3 justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-pepper text-white">
                        <path d="M13 11.3333C13 15.0152 11.125 18 10 18C8.875 18 7 15.0152 7 11.3333C7 7.65144 7.29167 6 10 6C12.7083 6 13 7.65144 13 11.3333Z"></path>
                        <path d="M11 17.5C12.4471 17.4093 16.1356 16.6825 16.7696 13.3675 17.4035 10.0525 18.6096 7.29223 14.9118 6.58509 13.5768 6.3298 13.119 6.7133 12.4304 7.00002M9 17.5C7.5529 17.4093 3.86436 16.6825 3.23041 13.3675 2.59647 10.0525 1.39044 7.29223 5.08821 6.58509 6.42318 6.3298 6.881 6.7133 7.56958 7.00002"></path>
                        <path d="M10 6L9.37873 3.51493C9.15615 2.62459 8.35618 2 7.43845 2H7"></path>
                    </svg>
                </div>
                <p class="card-text mb-2 d-flex">Perhitungan</p>
            </div>
        </div>
    </div>
</div>
@endsection
