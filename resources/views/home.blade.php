@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Panou control
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}" >
                            <div class="card text-white bg-primary" style="border-color: #59bac0;">
                                <div class="card-body pb-0" style="background-color: #59bac0; ">
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <div>Clienți</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-primary" style="border-color: #e590b5;">
                                <div class="card-body pb-0" style="background-color: #e590b5; ">
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <div>Proiecte</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-primary" style="border-color: #faab9f;">
                                <div class="card-body pb-0" style="background-color: #faab9f; ">
                                    <div class="text-value">{{ number_format($settings3['total_number']) }}</div>
                                    <div>Utilizatori</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="card text-white bg-primary" style="border-color: #b48484;">
                                <div class="card-body pb-0" style="background-color: #b48484; ">
                                    <div class="text-value">{{ number_format($settings4['total_number']) }}</div>
                                    <div>Angajați</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart5->options['column_class'] }}">
                            <h3>Ore lucrate</h3>
                            {!! $chart5->renderHtml() !!}
                        </div>
                        <div class="{{ $chart6->options['column_class'] }}">
                            <h3>Programări</h3>
                            {!! $chart6->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart5->renderJs() !!}{!! $chart6->renderJs() !!}
@endsection