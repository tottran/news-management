@extends('admin.layouts.layoutAdd') @stack('head')
<link rel="stylesheet" href="{{ asset('css/pages/add.css') }}" />

@section('addContent')
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
                <select id="dsTheLoai">
                    <option value="">Chọn thể loại</option>
                    @foreach($theloai as $tl)
                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                    @endforeach
                </select>
                <label>Thể loại</label>
            </div>
            <div class="input-field col s6">
                <select id="dsLoaiTin" name="LoaiTin"></select>
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
                />
                <label for="TieuDe">Tiêu đề</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">insert_link</i>
                <input
                    id="TieuDeKhongDau"
                    type="text"
                    readonly
                    value="tieu-de-khog"
                    name="TieuDeKhongDau"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Tóm tắt</label>
            <div class="input-field col s12">
                <div id="toolbar-container-tom-tat"></div>
                <div class="editor" id="editorTomTat"></div>
                <input
                    id="txtTomTat"
                    type="text"
                    name="TomTat"
                    style="display: none"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Nội dung</label>
            <div class="input-field col s12">
                <div id="toolbar-container-noi-dung"></div>
                <div class="editor" id="editorNoiDung"></div>
                <input
                    id="txtNoiDung"
                    type="text"
                    name="NoiDung"
                    style="display: none"
                />
            </div>
        </div>
        <div class="row">
            <label style="padding-left: 0.57rem">Hình ảnh</label>
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
                    <label>
                        Không
                        <input type="checkbox" name="NoiBat" />
                        <span class="lever"></span>
                        Nổi bật
                    </label>
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
