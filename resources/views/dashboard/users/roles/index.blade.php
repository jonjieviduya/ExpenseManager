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
    <div class="content-wrapper" id="roleContainer">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Roles
            </h1>
			<ol class="breadcrumb">
                <li>User Management</li>
				<li class="active">Roles</li>
			</ol>
        </section>

        <section class="content">
            @if($roles)
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
                            <tr v-for="role in roles" @click="openEditRoleModal(role)" class="pointer">
                                <td class="hidden" v-text="role.id"></td>
                                <td v-text="role.display_name"></td>
                                <td v-text="role.description"></td>
                                <td v-text="format_date(role.created_at)"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <br><br>
                <div class="text-center text-muted">No roles available.</div>
            @endif

            <button class="btn btn-default pull-right" @click="openAddRoleModal">Add Role</button>
        </section>

        @include('dashboard.partials.modals.role-modal')
    </div>

    
@stop

@section('additional-scripts')
    <script src="{{ asset('vuejs/vue.min.js') }}"></script>
    <script src="{{ asset('moment/moment.js') }}"></script>
    <script src="{{ asset('axios/axios.js') }}"></script>
    <script>

        var global_roles = JSON.parse("{{ $roles }}".replace(/&quot;/ig,'"'));

        var app = new Vue({
            el: '#roleContainer',
            data() {
                return {
                    isEditMode: true,
                    roles: global_roles,
                    id: '',
                    display_name: '',
                    description: '',
                    created_at: ''
                }
            },

            methods: {

                actionForRole(){
                    if(this.isEditMode){
                        
                        axios.post('{{ route('role.update') }}', {
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
                        axios.post('{{ route('role.add') }}', {
                            display_name: this.display_name,
                            description: this.description,
                            _token: $('input[name=_token]').val()
                        })
                        .then((response) => {
                            var newRole = {
                                id: response.data.id,
                                display_name: response.data.display_name,
                                description: response.data.description,
                                created_at: response.data.created_at,
                                updated_at: response.data.updated_at
                            };
                            global_roles.push(newRole);
                            
                            $('#roleModal').modal('hide');
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    }
                },

                deleteRole(){
                    window.location.replace("delete-role/" + this.id);
                },

                openEditRoleModal(role){
                    this.id = role.id;
                    this.display_name = role.display_name;
                    this.description = role.description;
                    this.isEditMode = true;
                    $('#roleModal').modal('show');
                },

                openAddRoleModal(){
                    this.display_name = '';
                    this.description = '';
                    this.isEditMode = false;
                    $('#roleModal').modal('show');
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