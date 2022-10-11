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
        action="{{$tintuc->id}}"
        method="POST"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="row">
            <div class="input-field col s6">
                <select id="dsTheLoai">
                    <option value="">Chọn thể loại</option>
                    @foreach($theloai as $tl)
                    <option @if($tintuc->
                        loaitin->theloai->id == $tl->id)
                        {{ "selected" }}
                        @endif value="{{$tl->id}}">{{$tl->Ten}}
                    </option>
                    @endforeach
                </select>
                <label>Thể loại</label>
            </div>
            <div class="input-field col s6">
                <select id="dsLoaiTin" name="LoaiTin">
                    <option value="">Chọn loại tin</option>
                    @foreach($loaitin as $lt)
                    <option value="{{$lt->id}}" @if($tintuc->
                        loaitin->id == $lt->id)
                        {{ "selected" }}
                        @endif>{{$lt->Ten}}
                    </option>
                    @endforeach
                </select>
                <label>Loại tin</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">title</i>
                <input
                    id="TieuDe"
                    type="text"
                    class="validate"
                    minlength="3"
                    data-length="100"
                    name="TieuDe"
                    value="{{ $tintuc->TieuDe }}"
                />
                <label for="TieuDe">Tiêu đề</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">insert_link</i>
                <input
                    id="TieuDeKhongDau"
                    type="text"
                    readonly
                    value="{{ $tintuc->TieuDeKhongDau }}"
                    name="TieuDeKhongDau"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Tóm tắt</label>
            <div class="input-field col s12">
                <div id="toolbar-container-tom-tat"></div>
                <div class="editor" id="editorTomTat">
                    {!! $tintuc->TomTat !!}
                </div>
                <input
                    id="txtTomTat"
                    type="text"
                    name="TomTat"
                    value="{{ $tintuc->TomTat }}"
                    style="display: none"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Nội dung</label>
            <div class="input-field col s12">
                <div id="toolbar-container-noi-dung"></div>
                <div class="editor" id="editorNoiDung">
                    {!! $tintuc->NoiDung !!}
                </div>
                <input
                    id="txtNoiDung"
                    type="text"
                    name="NoiDung"
                    value="{{ $tintuc->NoiDung }}"
                    style="display: none"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Hình ảnh</label>
            @if($tintuc->Hinh)
            <img
                class="materialboxed"
                width="100"
                src="{{ asset('upload/tintuc/'.$tintuc->Hinh) }}"
                alt="{{$tintuc->TieuDe}}"
            />
            @endif
            <div class="file-field input-field">
                <div class="btn">
                    <span>Chọn hình</span>
                    <input type="file" name="Hinh" />
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
            <div class="col s12">
                <div class="switch">
                    <!-- prettier-ignore  -->
                    <label>
                        Không
                        <input type="checkbox" name="NoiBat"
                            @if($tintuc->NoiBat == 1)
                            {{"checked"}}
                            @endif
                        />
                        <span class="lever"></span>
                        Nổi bật
                    </label>
                </div>
            </div>
        </div>

        @if($tintuc->comment)
        <div class="row">
            <label style="padding-left: 0.57rem">Bình luận</label>
            <div class="col s12">
                <ul class="collapsible expandable" data-collapsible="accordion">
                    @foreach($tintuc->comment as $key => $cm)
                    <li>
                        <!-- prettier-ignore  -->
                        <div class="collapsible-header">
                            <i class="material-icons">chat</i>
                            User
                            {{$cm->user->name}}{{$cm->created_at ? ' - Ngày '.$cm->created_at : ''}}
                            <span class="badge">
                                <a
                                    style="top: -8px"
                                    class="
                                        btn-floating
                                        waves-effect waves-light
                                        red
                                        darken-3
                                    "
                                    href="{{url('/admin/comment/delete/'. $cm->id . '/' . $tintuc->id)}}"
                                    ><i
                                        class="material-icons"
                                        style="margin-right: 0"
                                        >delete_forever</i
                                    ></a
                                >
                            </span>
                        </div>
                        <div class="collapsible-body">
                            <p>{{$cm->NoiDung}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

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
<script src="{{
        asset('admin/libraries_frameworks/ckeditor5-build-decoupled-document/ckeditor.js')
    }}"></script>
<!-- <link href="{{ asset('admin/libraries_frameworks/jcrop/jquery.Jcrop.min.css') }}"></link>
<script src="{{ asset('admin/libraries_frameworks/jcrop/jquery.Jcrop.min.js') }}"></script> -->
<script src="{{ asset('admin/libraries_frameworks/functions/text.js') }}"></script>
<script>
    $(document).ready(function () {
        $("select").material_select();
        $("#dsTheLoai").change(function () {
            const idTheLoai = $(this).val();
            $.get(
                `{{ url('admin/ajax/loaitin/${idTheLoai}') }}`,
                function (data) {
                    $("#dsLoaiTin").html(data).material_select();
                }
            );
        });
        $("#TieuDe").keyup(function () {
            $("#TieuDeKhongDau").val(convert_name($(this).val()));
        });

        // editorTomTat
        DecoupledEditor.create(document.querySelector("#editorTomTat"))
            .then((editor) => {
                const toolbarContainer = document.querySelector(
                    "#toolbar-container-tom-tat"
                );
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                editor.model.document.on("change:data", () => {
                    const data = editor.getData();
                    console.log("TomTat", { data });
                    $("#txtTomTat").val(data);
                });
            })
            .catch((error) => {
                console.error(error);
            });
        // editorNoiDung
        DecoupledEditor.create(document.querySelector("#editorNoiDung"))
            .then((editor) => {
                const toolbarContainer = document.querySelector(
                    "#toolbar-container-noi-dung"
                );
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                editor.model.document.on("change:data", () => {
                    const data = editor.getData();
                    console.log("NoiDung", { data });
                    $("#txtNoiDung").val(data);
                });
            })
            .catch((error) => {
                console.error(error);
            });
    });
</script>
@endsection
