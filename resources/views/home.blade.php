@extends('app')

@section('content')
<header class="header container-fluid">
        <div class="header-img row">
        <form>
                <div class="form-row align-items-center">
                    <div class="col-auto home-form">
                        
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-code"></i>
                                </div>
                                <input class="form-control g-font-size-16 border-0 g-height-60 rounded-0" name="te" id="te" maxlength="45" placeholder="Buscar por Tecnología"
                            aria-label="Buscar por Tecnología" tabindex="1" autocomplete="off" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto home-form">
                        
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <select name="pr" id="pr" class="custom-select g-font-size-16 rounded-0 g-height-60 g-min-width-100x border-0" style="" tabindex="2">
                                
                            </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-auto home-form">
                        <button class="btn btn-primary mb-2" type="submit" tabindex="3">
                                Buscar Trabajo </button>
                    </div>
                </div>
            </form>
        </div>
    </header>
@endsection
