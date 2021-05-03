@extends('layouts.admin')
@section('content')


<h3 class="page-title">Payment to: {{$employees->employee}}</h3>


<div class="card">
    <div class="card-body">
    
        <form method="POST" action="{{ url('admin/payment_post') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="card_no">{{ trans('card_no') }}</label>
                <input class="form-control integer {{ $errors->has('card_no') ? 'is-invalid' : '' }}" type="text" name="card_no" id="card_no" value="{{ old('card_no') }}" required>
                @if($errors->has('card_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('card_no') }}
                    </div>
                @endif
            </div>
            <div class="row">
            <div class="form-group col">
                <label class="required" for="exp_month">{{ trans('exp_month') }}</label>
                <input class="form-control integer {{ $errors->has('exp_month') ? 'is-invalid' : '' }}" type="text" name="exp_month" id="exp_month" value="{{ old('exp_month') }}" required>
                @if($errors->has('exp_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exp_month') }}
                    </div>
                @endif
            </div>
            <div class="form-group col">
                <label class="required" for="exp_year">{{ trans('exp_year') }}</label>
                <input class="form-control integer {{ $errors->has('exp_year') ? 'is-invalid' : '' }}" type="text" name="exp_year" id="exp_year" value="{{ old('exp_year') }}" required>
                @if($errors->has('exp_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exp_year') }}
                    </div>
                @endif
            </div>
            </div>
            <div class="form-group">
                <label class="required" for="cvv_no">{{ trans('cvv_no') }}</label>
                <input class="form-control integer {{ $errors->has('cvv_no') ? 'is-invalid' : '' }}" type="text" name="cvv_no" id="cvv_no" value="{{ old('cvv_no') }}" required>
                @if($errors->has('cvv_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cvv_no') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('amount') }}</label>
                <input class="form-control integer {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ $employees->salary }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
            </div>
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Plătește
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection