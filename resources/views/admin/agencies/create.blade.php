

@extends('layouts.backoffice.admin.main-admin')

@section('title', 'Ajouter une agence')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ajouter une agence</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Ajout agence</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="header">

                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="POST" action="{{ route('admin.agencies.store') }}" enctype="multipart/form-data">
                                @csrf
                                <label for="name">Nom Agence</label>
                                <div class="form-group">
                                    <input type="text" id="email_address" class="form-control" name="name" placeholder="Entrez le nom de l' agence ici">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                <label for="email">Email</label>
                                <div class="form-group">
                                    <input type="email" id="password" class="form-control" name="email" placeholder="Email de l'Agence">
                                </div>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                <label for="phone">Phone number</label>
                                <div class="form-group">
                                    <input type="text" id="number" class="form-control" name="phone_number" placeholder="Phone number Agence">
                                </div>
                                @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                <label for="phone">Quartier General</label>
                                <div class="form-group">
                                    <input type="text" id="headquarters" class="form-control" name="headquarters" placeholder="Quartier General Agence">
                                </div>
                                <label for="phone">Password</label>
                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="">
                                </div>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label for="state">Etat</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="state">
                                <option value="1">Publié</option>
                                <option value="0">Non publié</option>
                            </select>
                                @error('state')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                <div class="card">
                                    <div class="header">
                                        <h2>Custom <strong>messages</strong> for default</h2>
                                    </div>
                                    <div class="body">
                                        <p>replace, remove and error</p>
                                        <input type="file" class="dropify-fr" name="logo">
                                    </div>
                                    @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
