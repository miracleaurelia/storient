@extends('layouts.app')

@section('title', 'Unban List')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>Banned User List</h1>
        </div>
        @if ($bannedUsers->isEmpty())
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no Banned Users</h2>
        </div>
        @else
        <div>
            <div class="row">
                <div class="col">
                    <div class="table-list">
                        <div class="table-list-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 250px">User Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Member Since</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($bannedUsers as $user )                                                                    
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phone}}
                                            </td>
                                            <td>
                                                {{$user->address}}
                                            </td>
                                            
                                            <td>
                                                {{$user->created_at}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmVerifyModal{{ 1 }}">Unban</a>
                                                <div class="modal fade" id="confirmVerifyModal{{ 1 }}"
                                                    tabindex="-1" aria-labelledby="confirmVerifyModalLabel{{ 1 }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="confirmVerifyModalLabel{{ 1 }}">Unban
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Are you sure you want to Unban this account?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form action={{route('unbanUser',$user->id)}} method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-primary"
                                                                        data-bs-dismiss="modal">Unban</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row py-3">
            <h1>Active User List</h1>
        </div>
        @if ($activeUsers->isEmpty())
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no Active Users</h2>
        </div>
        @else
        <div>
            <div class="row">
                <div class="col">
                    <div class="table-list">
                        <div class="table-list-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 250px">User Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Member Since</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($activeUsers as $user )                                                                    
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phone}}
                                            </td>
                                            <td>
                                                {{$user->address}}
                                            </td>
                                            
                                            <td>
                                                {{$user->created_at}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmVerifyModal{{ 1 }}">Ban</a>
                                                <div class="modal fade" id="confirmVerifyModal{{ 1 }}"
                                                    tabindex="-1" aria-labelledby="confirmVerifyModalLabel{{ 1 }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="confirmVerifyModalLabel{{ 1 }}">Ban this user
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Are you sure you want to ban this account?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form action={{route('banUsers',$user->id)}} method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-primary"
                                                                        data-bs-dismiss="modal">ban</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </section>





    <style>
        .w-15 {
            width: 15%;
        }

        .mt-100 {
            margin-top: 100px;
        }

        .card {
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .card:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #E1BEE7;
            transform: scaleY(1);
            transition: all 0.5s;
            transform-origin: bottom;
        }

        .card:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #8E24AA;
            transform: scaleY(0);
            transition: all 0.5s;
            transform-origin: bottom;
        }

        .card:hover::after {
            transform: scaleY(1);
        }

        .fonts {
            font-size: 11px;
        }

        .role {
            background-color: #8E24AA;
        }

        .contact {
            text-decoration: none;
            color: #8E24AA;
        }

        .button a {
            border: 1px solid #8E24AA !important;
            color: #8E24AA;
            height: 40px;
        }

        .button a:hover {
            border: 1px solid #8E24AA !important;
            height: 40px;
            background-color: #8E24AA;
            color: white;
        }
    </style>

    <script>
        if (document.getElementById('userModal') != null) {
            document.getElementById('userModal').addEventListener('show.bs.modal', (e) => {
                let role;
                if (e.relatedTarget.getAttribute('data-role') == 1) {
                    role = "Admin";
                } else {
                    role = "User"
                }
                document.getElementById('user-role').innerHTML = e.relatedTarget.getAttribute('data-status') + " " +
                    role
                document.getElementById('user-name').innerHTML = e.relatedTarget.getAttribute('data-name')
                document.getElementById('user-email').innerHTML = e.relatedTarget.getAttribute('data-email')
                document.getElementById('user-address').innerHTML = e.relatedTarget.getAttribute('data-address')
                document.getElementById('user-phone').innerHTML = e.relatedTarget.getAttribute('data-phone')
                document.getElementById('user-ktp').innerHTML = e.relatedTarget.getAttribute('data-ktp')
                document.getElementById('user-contact').href = "https://wa.me/" + e.relatedTarget.getAttribute(
                    'data-phone')
            })
        }

        if (document.getElementById('confirmBanModal') != null) {
            document.getElementById('confirmBanModal').addEventListener('show.bs.modal', (e) => {
                document.getElementById('formBan').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
            })
        }
    </script>

@endsection
