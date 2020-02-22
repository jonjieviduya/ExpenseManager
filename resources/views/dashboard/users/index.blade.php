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
    <div class="content-wrapper" id="userContainer">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
			<ol class="breadcrumb">
                <li>User Management</li>
				<li class="active">Users</li>
			</ol>
        </section>

        <section class="content">
            <div class="table-responsive">
                <table class="table table-striped with-border">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" @click="openEditUserModal(user)" class="pointer">
                            <td class="hidden" v-text="user.id"></td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                            <td v-text="user.role"></td>
                            <td v-text="format_date(user.created_at.date)"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button class="btn btn-default pull-right" @click="openAddUserModal">Add User</button>
        </section>

        @include('dashboard.partials.modals.user-modal')
    </div>

    
@stop

@section('additional-scripts')
    <script src="{{ asset('vuejs/vue.min.js') }}"></script>
    <script src="{{ asset('moment/moment.js') }}"></script>
    <script src="{{ asset('axios/axios.js') }}"></script>
    <script>

        var global_users = JSON.parse("{{ $users }}".replace(/&quot;/ig,'"'));
        var global_roles = JSON.parse("{{ $roles }}".replace(/&quot;/ig,'"'));

        var app = new Vue({
            el: '#userContainer',
            data() {
                return {
                    isEditMode: true,
                    users: global_users,
                    id: '',
                    name: '',
                    email: '',
                    role: '',
                    roles: global_roles,
                    created_at: ''
                }
            },

            methods: {

                actionForUser(){
                    if(this.isEditMode){
                        
                        axios.post('{{ route('user.update') }}', {
                            id: this.id,
                            name: this.name,
                            email: this.email,
                            role: this.role,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            location.reload();
                        })
                        .catch((err) => {
                            console.log(err);
                        });

                    } else{
                        axios.post('{{ route('user.add') }}', {
                            id: this.id,
                            name: this.name,
                            email: this.email,
                            role: this.role,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            var newUser = {
                                id: response.data.id,
                                name: response.data.name,
                                email: response.data.email,
                                role: response.data.role,
                                created_at: response.data.created_at,
                                updated_at: response.data.updated_at
                            };
                            global_users.push(newUser);
                            
                            $('#userModal').modal('hide');
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    }
                },

                deleteUser(){
                    window.location.replace("delete-user/" + this.id);
                },

                openEditUserModal(user){
                    this.id = user.id;
                    this.name = user.name;
                    this.email = user.email;
                    this.role = user.role;
                    this.isEditMode = true;
                    $('#userModal').modal('show');
                },

                openAddUserModal(){
                    this.name = '';
                    this.email = '';
                    this.role = '';
                    this.isEditMode = false;
                    $('#userModal').modal('show');
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