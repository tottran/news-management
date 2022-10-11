@extends('admin.layouts.layoutEdit') @stack('head')
<link rel="stylesheet" href="{{ asset('css/pages/edit.css') }}" />

@section('editContent')
<div class="row">
    @if(count($errors) > 0)
    <div class="card-panel deep-orange lighten-2">
        @foreach($errors->all() as $err)
        {{ $err }}<br />
        @endforeach
    </div>
    @endif @if(session('thongbao'))
    <div class="card-panel teal lighten-2">
        {{ session("thongbao") }}
    </div>
    @endif
    <form
        class="col s12"
        action="add"
        method="POST"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">title</i>
                <input
                    id="name"
                    type="text"
                    class="validate"
                    minlength="3"
                    data-length="100"
                    name="name"
                />
                <label for="name">Tên</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">title</i>
                <input
                    id="email"
                    type="email"
                    class="validate"
                    minlength="3"
                    data-length="100"
                    name="email"
                />
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">title</i>
                <input
                    id="password"
                    type="password"
                    class="validate"
                    minlength="3"
                    data-length="100"
                    name="password"
                />
                <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">title</i>
                <input
                    id="confirmPassword"
                    type="password"
                    class="validate"
                    minlength="3"
                    data-length="100"
                    name="confirmPassword"
                />
                <label for="confirmPassword">Confirm Password</label>
                <span
                    class="helper-text confirmPasswordHelpText"
                    data-error=""
                    data-success=""
                ></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="dsLevel" name="level">
                    <option value="-1">Chọn level</option>
                    <option value="1">Admin</option>
                    <option value="0">User</option>
                </select>
                <label>Level</label>
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Avatar</label>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Chọn hình</span>
                    <input type="file" name="avatar" />
                </div>
                <div class="file-path-wrapper">
                    <input
                        class="file-path validate"
                        type="text"
                        placeholder="Chọn hình"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Cover</label>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Chọn hình</span>
                    <input type="file" name="cover" />
                </div>
                <div class="file-path-wrapper">
                    <input
                        class="file-path validate"
                        type="text"
                        placeholder="Chọn hình"
                    />
                </div>
            </div>
        </div>
        <button
            class="btn waves-effect waves-light"
            type="submit"
            name="action"
        >
            Lưu
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>

@endsection @section('script')
<script>
    $(document).ready(function () {
        $("select").material_select();
        $("#confirmPassword").keyup(function () {
            if ($(this).val() !== $("#password").val()) {
                $(this).addClass("invalid");
                $(".confirmPasswordHelpText").text("Mật khẩu không khớp❗️");
            } else {
                $(this).removeClass("invalid").addClass("valid");
                $(".confirmPasswordHelpText").text("Mật khẩu đã khớp ✅");
            }
        });
    });
</script>
@endsection
