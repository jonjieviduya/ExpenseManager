@extends('templates.master')

@section('additional-style')
    <style>
        .category-list li{ list-style: none;}

        .with-border, .with-border tr, .with-border td, .with-border th{ border: solid 1px #aaa !important; }

        .pointer{ cursor: pointer; }

        tr.pointer:hover{ background: #d6ebf7 !important; }
    </style>
@stop

@section('content')
    <div class="content-wrapper" id="expenseCategoryContainer">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Expense Categories
            </h1>
			<ol class="breadcrumb">
                <li>Expense Management</li>
				<li class="active">Expense Categories</li>
			</ol>
        </section>

        <section class="content">
            @if($expense_categories)
                <div class="table-responsive">
                    <table class="table table-striped with-border">
                        <thead>
                            <tr>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="expense_category in expense_categories" @click="openEditExpenseCategoryModal(expense_category)" class="pointer">
                                <td class="hidden" v-text="expense_category.id"></td>
                                <td v-text="expense_category.display_name"></td>
                                <td v-text="expense_category.description"></td>
                                <td v-text="format_date(expense_category.created_at)"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <br><br>
                <div class="text-center text-muted">No expense category available.</div>
            @endif

            <button class="btn btn-default pull-right" @click="openAddExpenseCategoryModal">Add Category</button>
        </section>

        @include('dashboard.partials.modals.expense-category-modal')
    </div>

    
@stop

@section('additional-scripts')
    <script src="{{ asset('vuejs/vue.min.js') }}"></script>
    <script src="{{ asset('moment/moment.js') }}"></script>
    <script src="{{ asset('axios/axios.js') }}"></script>
    <script>

        var global_expense_categories = JSON.parse("{{ $expense_categories }}".replace(/&quot;/ig,'"'));

        var app = new Vue({
            el: '#expenseCategoryContainer',
            data() {
                return {
                    isEditMode: true,
                    expense_categories: global_expense_categories,
                    id: '',
                    display_name: '',
                    description: '',
                    created_at: ''
                }
            },

            methods: {

                actionForExpenseCategory(){
                    if(this.isEditMode){
                        
                        axios.post('{{ route('expense-category.update') }}', {
                            id: this.id,
                            display_name: this.display_name,
                            description: this.description,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            location.reload();
                        })
                        .catch((err) => {
                            console.log(err);
                        });

                    } else{
                        axios.post('{{ route('expense-category.add') }}', {
                            display_name: this.display_name,
                            description: this.description,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            var newExpenseCategory = {
                                id: response.data.id,
                                display_name: response.data.display_name,
                                description: response.data.description,
                                created_at: response.data.created_at,
                                updated_at: response.data.updated_at
                            };
                            global_expense_categories.push(newExpenseCategory);
                            
                            $('#expenseCategoryModal').modal('hide');
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    }
                },

                deleteExpenseCategory(){
                    window.location.replace("delete-expense-category/" + this.id);
                },

                openEditExpenseCategoryModal(expense_category){
                    this.id = expense_category.id;
                    this.display_name = expense_category.display_name;
                    this.description = expense_category.description;
                    this.isEditMode = true;
                    $('#expenseCategoryModal').modal('show');
                },

                openAddExpenseCategoryModal(){
                    this.display_name = '';
                    this.description = '';
                    this.isEditMode = false;
                    $('#expenseCategoryModal').modal('show');
                },

                format_date(value){
                    if (value) {
                        return moment(String(value)).format('YYYY-MM-DD')
                    }
                }

            }
        })

    </script>
@stop