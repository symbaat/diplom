@extends('layouts.app')

@section('content')

    <div class="page-wrapper"> <!-- content -->
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                        <h5 class="text-uppercase">Добавить ученика</h5>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <ul class="list-inline breadcrumb float-right">
                            <li class="list-inline-item"><a href="/">Главная</a></li>
                            <li class="list-inline-item"><a href="{{ route('admin.users.index', ['role' => 3]) }}">Ученики</a></li>
                            <li class="list-inline-item">Добавить пользователя</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-6 offset-md-5">
                                        <h4 class="card-title">Фотография акаунта</h4><br>
                                        <div class="form-group row">
                                            <img src="{{ asset('img/user.jpg') }}" class="avatar-big" id="myimage">
                                            <div class="col-lg-9">
                                                <input type="file" onchange="onFileSelected(event)" name="image">
                                                @if ($errors->has('image'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Персональные данные</h4><br>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Имя:</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="name" required>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Имена:</label>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="Фамилия" class="form-control" name="surname" required>
                                                        @if ($errors->has('surname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('surname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="Отчества" class="form-control" name="lastname">
                                                        @if ($errors->has('lastname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('lastname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">День рождения:</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="datetimepicker form-control" class="form-control" name="birthday">
                                                @if ($errors->has('birthday'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('birthday') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($role->id == 3)
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Имя родителя:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="parent_name">
                                                    @if ($errors->has('parent_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('parent_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Пол</label>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                                    <label class="form-check-label" for="gender">
                                                        Парень
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="0">
                                                    <label class="form-check-label" for="gender">
                                                        Девушка
                                                    </label>
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Телефонный номер:</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="phone_number">
                                                @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Адрес:</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control m-b-20" name="address" required>
                                                @if ($errors->has('address'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($role->id == 3)
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Группа:</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" id="group" name="group">
                                                        <option value=""></option>
                                                        @foreach(Dict::groups() as $group)
                                                            <option {{ (old('group') == $group->id) ? "selected" : "" }} value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('parent_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('parent_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="card-title">Personal details</h4><br>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Email:</label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control" name="email" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Пароль:</label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Подтверждение пароля:</label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        function onFileSelected(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("myimage");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
        }
        $(document).ready(function() {
            $('input[name="phone_number"]').mask('0 (000) 000 00-00');
        });
    </script>
@endsection