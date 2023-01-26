@extends('layouts.app')

@section('title', 'Unban List')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>Banned User List</h1>
        </div>
        {{-- @if ($returnedLoan->count() > 0) --}}
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
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            USERNAME
                                        </td>
                                        <td>
                                            EMAIL
                                        </td>
                                        <td>
                                            PHONE
                                        </td>
                                        <td>
                                            ADDRESS
                                        </td>
                                        <td>
                                            MEMBER SINCE
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
                                                            Are you sure you want to unban this account?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <form action="" method="POST">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @else
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no Banned Users</h2>
        </div>
        @endif --}}
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
