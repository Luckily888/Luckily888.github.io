@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Currency</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ ($action === 'edit') ? 'Edit' : 'Add' }} Currency</h6>
                <a href="{{ route('admin.currencies.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-list fa-sm"></i> All Currency</a>
            </div>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{ ($action === 'edit') ? route('admin.currencies.update',["id" => $results->id]):route('admin.currencies.store')}}">
                @csrf
                @if($action === 'edit')
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name',isset($results->name)) ? ($results->name) : '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="symbol">Symbol</label>
                        <input type="text" class="form-control" id="symbol" name="symbol" value="{{ old('symbol',isset($results->symbol)) ? ($results->symbol) : '' }}">
                    </div>
                    <div class="form-group col-6">
                        <p>Devvio?</p>
                        <label class="form-check-label">
                            <input type="radio" class="form-check-inline" onclick="document.getElementById('devID').classList.remove('d-none');" {{ old('isDevvio',isset($results->isDevvio) && $results->isDevvio == 1) ? 'checked' : '' }} id="isDevvio" name="isDevvio" value="1"> yes
                            <input type="radio" class="form-check-inline" onclick="document.getElementById('devID').classList.add('d-none');" {{ old('isDevvio',isset($results->isDevvio) && $results->isDevvio == 0) ? 'checked' : '' }} id="isDevvio" name="isDevvio" value="0"> no
                        </label>
                    </div>
                    <div class="form-group col-6 {{ old('isDevvio',isset($results->isDevvio) && $results->isDevvio == 1) ? '' : 'd-none' }}" id="devID">
                        <label>Coin ID</label>
                        <input type="text" class="form-control" name="devID" value="{{ old('symbol',isset($results->devID)) ? ($results->devID) : null }}">
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection