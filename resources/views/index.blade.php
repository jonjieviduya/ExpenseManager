<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expense Manager</title>

        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            .title { font-size: 84px; font-family: Raleway; margin-bottom: 50px; }

            .m-top-50{ margin-top: 50px; }
        </style>
    </head>
    <body>

        <div class="container m-top-50">
            <div class="title text-center text-muted">Expense Manager</div>
            
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    
                    @if(session()->has('login-error'))
                        <p class="text-danger text-center">{{ session()->get('login-error') }}</p>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            Log in
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('login') }}" method="POST">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                </div>
                                <div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
                                    <label class="control-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @if($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Log in</button>
                                </div>

                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
