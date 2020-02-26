@extends('templates.master')

@section('additional-style')
    <style>
        .category-list li{ list-style: none;}
    </style>
@stop

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Expenses
            </h1>
			<ol class="breadcrumb">
				<li class="active">Dashboard</li>
			</ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row category-list">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Categories</h2>
                            @foreach($expenses as $expense)
                                <li>
                                    <h4>{{ $expense['category'] }}</h4>
                                </li>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h2>Total</h2>
                            @foreach($expenses as $expense)
                                <li>
                                    <h4>{{ $expense['amount'] }}</h4>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <canvas id="myExpensesChart"></canvas>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop

@section('additional-scripts')
    <script src="{{ asset('chartjs/chart.js') }}"></script>
    <script>

        var ctx = document.getElementById('myExpensesChart');

        data = {
            datasets: [{
                data: JSON.parse("{{ $expenses_amount }}".replace(/&quot;/ig,'"')),
                backgroundColor: '#f55d5d'
            }],
            labels: JSON.parse("{{ $expenses_category }}".replace(/&quot;/ig,'"'))
        };

        $(function(){

            new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    legend: {
                        display: false
                    }
                }
            });

        });
    </script>
@stop
