@extends('layouts.backoffice.admin.main-admin')
@section('title', 'Listes des Agences')
@section('content')

    <!-- Select -->
    <section class="content">
        <div class="body_scroll">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2> <strong>Ajouter Un Trajet</strong></h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                            data-toggle="dropdown" role="button" aria-haspopup="true"
                                            aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0);">Ajouter</a></li>
                                            <li><a href="javascript:void(0);">Lister</a></li>
                                            <li><a href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <p>Veuillez renseigner le point de depart et d'arrivé</p>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <select class="form-control show-tick">
                                            <option value="">Point de Depart</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" disabled>
                                            <option value="">Point d'Arrivé</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
