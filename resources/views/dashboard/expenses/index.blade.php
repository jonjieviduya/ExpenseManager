@extends('templates.master')

@section('additional-style')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
    <style>
        .category-list li{ list-style: none;}

        .with-border, .with-border tr, .with-border td, .with-border th{ border: solid 1px #aaa !important; }

        .pointer{ cursor: pointer; }

        .datepicker{ z-index: 1600 !important; }

        tr.pointer:hover{ background: #d6ebf7 !important; }
    </style>
@stop

@section('content')
    <div class="content-wrapper" id="expenseContainer">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Expenses
            </h1>
			<ol class="breadcrumb">
                <li>Expense Management</li>
				<li class="active">Expenses</li>
			</ol>
        </section>

        <section class="content">
            @if($expenses)
                <div class="table-responsive">
                    <table class="table table-striped with-border">
                        <thead>
                            <tr>
                                <th>Expense Category</th>
                                <th>Amount</th>
                                <th>Entry Date</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="expense in expenses" @click="openEditExpenseModal(expense)" class="pointer">
                                <td class="hidden" v-text="expense.id"></td>
                                <td v-text="expense.expense_category"></td>
                                <td v-text="expense.amount"></td>
                                <td v-text="format_date(expense.entry_date)"></td>
                                <td v-text="format_date(expense.created_at.date)"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <br><br>
                <div class="text-center text-muted">No expenses available.</div>
            @endif

            <button class="btn btn-default pull-right" @click="openAddExpenseModal">Add Expense</button>
        </section>

        @include('dashboard.partials.modals.expense-modal')
    </div>

    
@stop

@section('additional-scripts')
    <script src="{{ asset('vuejs/vue.min.js') }}"></script>
    <script src="{{ asset('moment/moment.js') }}"></script>
    <script src="{{ asset('axios/axios.js') }}"></script>
    <script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>

        var global_expenses = JSON.parse("{{ $expenses }}".replace(/&quot;/ig,'"'));
        var global_expense_categories = JSON.parse("{{ $expense_categories }}".replace(/&quot;/ig,'"'));

        var app = new Vue({
            el: '#expenseContainer',
            data() {
                return {
                    isEditMode: true,
                    expenses: global_expenses,
                    id: '',
                    expense_category: '',
                    amount: '',
                    entry_date: '',
                    expense_categories: global_expense_categories,
                    created_at: ''
                }
            },

            mounted(){
                $('.datepicker').datepicker().on(
                    "changeDate", () => {this.entry_date = $('.datepicker').val()}
                );
            },

            methods: {

                numberOnly(event){
                    event = event.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
                },

                actionForExpense(){
                    if(this.isEditMode){
                        
                        axios.post('{{ route('expense.update') }}', {
                            id: this.id,
                            expense_category: this.expense_category,
                            amount: this.amount,
                            entry_date: this.entry_date,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            location.reload();
                        })
                        .catch((err) => {
                            console.log(err);
                        });

                    } else{
                        axios.post('{{ route('expense.add') }}', {
                            id: this.id,
                            expense_category: this.expense_category,
                            amount: this.amount,
                            entry_date: this.entry_date,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            var newExpense = {
                                id: response.data.id,
                                expense_category: response.data.expense_category,
                                amount: response.data.amount,
                                entry_date: response.data.entry_date,
                                created_at: response.data.created_at,
                                updated_at: response.data.updated_at
                            };
                            global_expenses.push(newExpense);
                            
                            $('#expenseModal').modal('hide');
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    }
                },

                deleteExpense(){
                    window.location.replace("delete-expense/" + this.id);
                },

                openEditExpenseModal(expense){
                    this.id = expense.id;
                    this.expense_category = expense.expense_category;
                    this.amount = expense.amount;
                    this.entry_date = expense.entry_date;
                    this.isEditMode = true;
                    $('#expenseModal').modal('show');
                },

                openAddExpenseModal(){
                    this.expense_category = '';
                    this.amount = '';
                    this.entry_date = '';
                    this.isEditMode = false;
                    $('#expenseModal').modal('show');
                },

                format_date(value){
                    if (value) {
                        return moment(String(value)).format('YYYY-MM-DD')
                    }
                },

                format_date2(value){
                    if (value) {
                        return moment(String(value)).format('MM/DD/YYYY')
                    }
                }

            }
        })
        
        $('#pureNumber').on('input', function(){
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });

    </script>

@stop